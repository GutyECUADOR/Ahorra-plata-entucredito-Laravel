<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Packages;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('usuarios.index', compact('users'));
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('usuarios.edit', compact('user'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:191'],
            'dni' => ['required', 'string', 'max:191', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'phone' => ['required', 'string', 'max:15'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'dni' => $request->dni,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $request->validate([
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191']
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->ranking = $request->ranking;
        $user->save();
        return redirect()->route('register')->with('status', 'El usuario '.$request->name.' actualizado con éxito!');
    }


    public function asignar(Request $request, User $user) {

        if ($user->location) {
            return redirect()->back()->withErrors(['El usuario: '.$user->nickname.' ya tiene registrado una ubicacion, no se puede asignar una nueva ubicación.']);
        }

        /* Obtnemos la ubicacion (id) del arbol de su patrocinador */
        $resulset = DB::select('
            SELECT location FROM users WHERE nickname = (SELECT nickname_promoter FROM users WHERE nickname = :nickname)',
            array('nickname' => $user->nickname));


        if (!$resulset) {
            return redirect()->back()->withErrors(['El usuario: '.$user->nickname.' no tiene un nickname de promotor, no se puede asignar ubicación.']);
        }

        // EL GRUPO EMPIEZA DESDE ESTE ID
        $cabezaArbol = $resulset[0]->location;

        // 7 niveles de profundidad
        //Empieza en 2 nodos sube hasta 64 en nivel 7

        /* EQUIPO 1 */
        $nodos = 2;
        $cantidad_EQ1 = 0;
        $array_rango_EQ1 = [];
        for ($nivel=1; $nivel < 7; $nivel++) {
            $primero = $nodos * $cabezaArbol; // Formula n*a
            $ultimo =  $cabezaArbol * $nodos + $nodos / 2 - 1; // Formula a*n+n/2-1
            $nodos = $nodos*2;

            $current_rango = range($primero,$ultimo);
            $array_rango_EQ1 = array_merge($array_rango_EQ1, $current_rango);

        }

        //Consultamos si hay una ubicacion con ese rango
        $cantidad_EQ1 = DB::table('users')->select('location')->whereIn('location', $array_rango_EQ1)->count();

        $ubicacion_libre_EQ1 = null;
        foreach ($array_rango_EQ1 as $index) {
            $ubicacion = DB::table('users')->select('location')->where('location', $index)->first();

            if ($ubicacion == NULL) {
                $ubicacion_libre_EQ1 = $index;
                break;

            }
        }

        /* EQUIPO 2 */
        $nodos = 2;
        $cantidad_EQ2 = 0;
        $array_rango_EQ2 = [];
        for ($nivel=1; $nivel < 7; $nivel++) {
            $primero =  $cabezaArbol * $nodos + $nodos / 2 ; // a*n+n/2
            $ultimo =  $cabezaArbol * $nodos + $nodos - 1 ; // a*n+n-1
            $nodos = $nodos*2;

            $current_rango = range($primero,$ultimo);
            $array_rango_EQ2 = array_merge($array_rango_EQ2, $current_rango);

            //Consultamos si hay una ubicacion con ese rango
        }

        //Consultamos si hay una ubicacion con ese rango
        $cantidad_EQ2 = DB::table('users')->select('location')->whereIn('location', $array_rango_EQ2)->count();

        $ubicacion_libre_EQ2 = null;
        foreach ($array_rango_EQ2 as $index) {
            $ubicacion = DB::table('users')->select('location')->where('location', $index)->first();

            if ($ubicacion == NULL) {
                $ubicacion_libre_EQ2 = $index;
                break;

            }
        }
        echo 'Cantidad1:'.$cantidad_EQ1. '</br>';
        echo 'Cantidad2:'.$cantidad_EQ2. '</br>';

        echo 'Libre1:'.$ubicacion_libre_EQ1. '</br>';
        echo 'Libre2:'.$ubicacion_libre_EQ2. '</br>';


        // Comprobar cuando la matriz este llena
        if ($cantidad_EQ1 == 63 && $cantidad_EQ2 == 63) {
            return redirect()->back()->withErrors(['Tu patrocinador alcanzo el limite de sus equipos, consulta su nuevo nickname']);
        }

        // Trabajamos en el equipo con menor numero de ubicaciones asignadas
        if ($cantidad_EQ1 < $cantidad_EQ2) {
            $user_DB = User::findOrFail($user->id);
            $user_DB->is_payed = 1;
            $user_DB->location = $ubicacion_libre_EQ1;
            $user_DB->save();
            return redirect()->back()->with('status', 'Registrado en ubicación.'. $ubicacion_libre_EQ1);

        }else{
            $user_DB = User::findOrFail($user->id);
            $user_DB->is_payed = 1;
            $user_DB->location = $ubicacion_libre_EQ2;
            $user_DB->save();
            return redirect()->back()->with('status', 'Registrado en ubicación.'. $ubicacion_libre_EQ2);

        }


    }
}
