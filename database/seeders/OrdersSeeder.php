<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            'product_id' =>   DB::table('products')->whereNull('deleted_at')->get()->first()->id,
            'client_id' =>    DB::table('clients')->whereNull('deleted_at')->get()->first()->id,
            'created_at' =>    Carbon::now()->toDateTimeString(),
            'updated_at' =>    Carbon::now()->toDateTimeString(),
        ]);
    }
}
