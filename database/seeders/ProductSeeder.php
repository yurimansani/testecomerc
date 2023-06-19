<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name' =>               Str::random(10),
            'email' =>              Str::random(10).'@gmail.com',
            'birthDate' =>          Str::random(10),
            'address' =>            Str::random(10),
            'complement' =>         Str::random(10),
            'neighborhood' =>       Str::random(10),
            'zipcode' =>            Str::random(10),
            
        ]);
    }
}
