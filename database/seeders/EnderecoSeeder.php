<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class EnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('enderecos')->insert([
            'logradouro' => "Rua 3",
            'numero' => "123",
            'cidade' => "São Cristóvão",
        ]);
    }
}
