<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AvatarController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'avatar' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'errors' => $validator->errors(),
                'message' => 'Uno o más campos requeridos no pasaron la validación'
            ], 400);
        }

        $filename_unique = Str::random(40);
        $filename = Storage::put('public/avatars/'.$filename_unique.'.jpg', base64_decode($data['avatar']));
        
        $currentuser = Auth::user();
        $user = User::findOrFail($currentuser->id);
        $user->avatar = $filename_unique.'.jpg';
        $user->save();

        return response([
            'avatar' => $filename_unique.'.jpg',
            'message' => 'Avatar actualizado.'
        ], 200);
    }
}
