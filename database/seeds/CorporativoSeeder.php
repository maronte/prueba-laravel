<?php

use App\Corporativo;
use Illuminate\Database\Seeder;

class CorporativoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Corporativo::truncate();
        Corporativo::flushEventListeners();
        $cantidadCorporativos = 10;
        factory(Corporativo::class, $cantidadCorporativos)->create();
    }
}
