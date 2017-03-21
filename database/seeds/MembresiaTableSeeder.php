<?php
use App\Membresia;
use App\Cliente;
use App\User;
use App\Promocion;

use Illuminate\Database\Seeder;

class MembresiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Membresia::truncate();

        $faker = Faker\Factory::create();
        $cliente_id = Cliente::pluck('id')->All();
        $usuario_id = User::pluck('id')->All();
        $promocion_id = Promocion::pluck('id')->All();

        for($i=1; $i<=70; $i++) {
            factory(App\Membresia::class)->create([
                'user_id' => $faker->randomElement($usuario_id),
                'cliente_id' => $faker->randomElement($cliente_id),
                'promocion_id' => $faker->randomElement($promocion_id),
            ]);
        }
    }
}
