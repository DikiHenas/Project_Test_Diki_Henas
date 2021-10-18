<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pegawai')->insert([
            'nik'=>'12345678910',
            'full_name' => 'Diki Henas Satriawan',
            'email' =>'saytoreluis@gmail.com', 
            'mobile_number'=>'+6285285562651',
            'address'=>'jalan kaki saja biar sehat no 8'                       
        ]);
    }
}
