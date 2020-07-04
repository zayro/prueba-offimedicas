<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class informacionSeeder extends Seeder
{

    public function create($count)
    {

        $faker = Factory::create();

        //Clean Table
        DB::delete('delete from informacion');


        //Add Table
        //DB::insert('insert into informacion (id, nombre) values (?, ?)', [1, 'Inicio']);
        //Str::random(10)
        for ($i = 0; $i <= $count; $i++){

            DB::table('informacion')->insert([
                'identificacion' => $faker->numberBetween(100, 200),
                'edad' => $faker->numberBetween(20, 40),
                'nombre' => $faker->name
            ]);

        }


    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(30);

    }


}
