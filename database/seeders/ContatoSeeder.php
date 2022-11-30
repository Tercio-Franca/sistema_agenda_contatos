<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contatos')->insert([
            'nome' => "Luiza Silva",
            'endereco_id' => 1,
        ]);

        DB::table('contatos')->insert([
            'nome' => "Regina Cazé",
            'endereco_id' => 2,
        ]);
    }
}
