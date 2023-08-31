<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nickname',
        'is_payed',
        'package_id',
        'nickname_promoter',
        'email',
        'phone',
        'password',
        'imagen_recibo'
    ];

    public function getEstadoPagoAttribute() {
        if ($this->is_payed == 1) {
            return 'Pagado'; 
        }

        return 'Sin pagar';
    }

    public function getCantidadInvitadosPagadosAttribute () {
        $data = DB::table('users')->where([
                'nickname_promoter' => $this->nickname,
                'is_payed' => 1
        ])->get();
        
        return $data;
    }

    public function getCantidadInvesionPagadaAttribute () {
        $data = DB::table('users')
        ->select('usdt')
        ->join('packages', 'packages.id', '=', 'users.package_id')
            ->where([
                'nickname_promoter' => $this->nickname,
                'is_payed' => 1
            ])->sum('usdt');
        
        return $data;
    }

    public function getComisionGanadaAttribute () {
        $data = $this->getCantidadInvesionPagadaAttribute();
        return $data*0.20;
    }

    public function getListaEquipoAAttribute () {
        /* EQUIPO 1 */
        $cabezaArbol = $this->location;
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
        
        $cantidad_EQ1 = DB::table('users')->select('*')
                        ->join('packages', 'packages.id', '=', 'users.package_id')
                        ->where([
                            'is_payed' => 1
                        ])
                        ->whereIn('location', $array_rango_EQ1)->get();
        return $cantidad_EQ1;
    }

    public function getListaEquipoBAttribute () {
        /* EQUIPO 2 */
        $cabezaArbol = $this->location;
        $nodos = 2; 
        $cantidad_EQ2 = 0;
        $array_rango_EQ2 = [];
        for ($nivel=1; $nivel < 7; $nivel++) { 
            $primero =  $cabezaArbol * $nodos + $nodos / 2 ; // a*n+n/2
            $ultimo =  $cabezaArbol * $nodos + $nodos - 1 ; // a*n+n-1
            $nodos = $nodos*2;
            
            $current_rango = range($primero,$ultimo);
            $array_rango_EQ2 = array_merge($array_rango_EQ2, $current_rango);
        }
        
        //Consultamos si hay una ubicacion con ese rango
        $cantidad_EQ2 = DB::table('users')->select('*')
                        ->join('packages', 'packages.id', '=', 'users.package_id')
                        ->where([
                            'is_payed' => 1                     
                        ])
                        ->whereIn('location', $array_rango_EQ2)->get();
        return $cantidad_EQ2;
    }

    public function getPagosRecibidosAttribute () {
        $data = DB::table('users')
        ->select('*')
        ->join('pagos', 'pagos.user_id', '=', 'users.id')
        ->where([
            'users.id' => $this->id
        ])
        ->get();
       
        return $data;
    }

    public function getComisionGanadaMenorEquipoAttribute () {
        $total_EQ1 = $this->ListaEquipoA->sum('usdt');
        $total_EQ2 = $this->ListaEquipoB->sum('usdt');

        if ($total_EQ1 > $total_EQ2) {
            return $total_EQ2 * 0.10;
        }
        return $total_EQ1 * 0.10;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
