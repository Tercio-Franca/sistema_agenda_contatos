<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TelefoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('telefones')->insert([
            'numero' => "(79)98844-5237",
            'contato_id' => 1,
            'tipo_telefone_id' => 1,
        ]);
    }
}