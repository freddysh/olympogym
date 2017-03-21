<?php

use App\Promocion;
use Illuminate\Database\Seeder;

class PromocionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        Promocion::truncate();
        factory(App\Promocion::class, 8)->create();
    }
}
