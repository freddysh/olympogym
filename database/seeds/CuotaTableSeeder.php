<?php

use App\Membresia;
use App\Cuota;
use App\User;
use Illuminate\Database\Seeder;

class CuotaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Cuota::truncate();

        $faker = Faker\Factory::create();
        $user_id = User::pluck('id')->All();
        $membresia_id = Membresia::pluck('id')->All();

        for($i=1; $i<=90; $i++) {
            factory(App\Cuota::class)->create([
                'membresia_id' => $faker->randomElement($membresia_id),
                'user_id' => $faker->randomElement($user_id),
            ]);
        }
    }
}
