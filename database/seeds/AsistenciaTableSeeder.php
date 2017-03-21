<?php

use Illuminate\Database\Seeder;
use App\Cliente;
use App\Asistencia;

class AsistenciaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Asistencia::truncate();

        $faker = Faker\Factory::create();
        $cliente_id = Cliente::pluck('id')->All();

        for($i=1; $i<=500; $i++) {
            factory(App\Asistencia::class)->create([
                'cliente_id' => $faker->randomElement($cliente_id),
            ]);
        }
    }
}
