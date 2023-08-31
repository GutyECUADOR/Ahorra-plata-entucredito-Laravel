<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array([
            'location' => 1,
            'nickname' => 'administrador',
            'nickname_promoter' => '',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'role' => 'ADMIN_ROLE',
            'phone' => '+593',
            'wallet_usdt_tr20' => '',
            'wallet_alarab' => '',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'is_payed' => 1,
            ],
        ));

        foreach (range(1,31) as $index) {
            User::create([
                'location' => $index+1,
                'nickname' => 'partner'.$index,
                'is_payed' => true,
                'package_id' => 1,
                'nickname_promoter' => 'administrador',
                'email' => 'partner'.$index.'@clubalarab.com',
                'phone' => '+593',
                'password' => Hash::make('admin2023'),
                'imagen_recibo' => null
            ]);
        }
        
        
      
       /*  foreach (range(1,10) as $index) {
            User::create([
                'nickname' => 'test'.$index,
                'is_payed' => 0,
                'package_id' => 1,
                'nickname_promoter' => '',
                'email' => 'test'.$index.'@test.com',
                'phone' => '+593',
                'password' => Hash::make('12345678'),
                'imagen_recibo' => null
            ]);
        } */

       
    
    }
}
