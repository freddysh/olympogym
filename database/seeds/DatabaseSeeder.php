<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ClienteTableSeeder::class);
        $this->call(PromocionTableSeeder::class);
        $this->call(AsistenciaTableSeeder::class);
        $this->call(MembresiaTableSeeder::class);
        $this->call(CuotaTableSeeder::class);
    }
}
