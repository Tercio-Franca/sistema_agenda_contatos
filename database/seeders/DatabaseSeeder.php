<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(array(
            CategoriaSeeder::class,
            TipoTelefoneSeeder::class,

            EnderecoSeeder::class,
            ContatoSeeder::class,
            TelefoneSeeder::class,
            ContatoHasCategoriaSeeder::class,
        ));
    }
}
