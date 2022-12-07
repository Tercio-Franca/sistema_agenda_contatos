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

        DB::table('telefones')->insert([
            'numero' => "(32)3261-4453",
            'contato_id' => 1,
            'tipo_telefone_id' => 2,
        ]);

        DB::table('telefones')->insert([
            'numero' => "(21)9847-2074",
            'contato_id' => 2,
            'tipo_telefone_id' => 1,
        ]);
    }
}
