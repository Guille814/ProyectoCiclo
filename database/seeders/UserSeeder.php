<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as FakerFactory;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = FakerFactory::create('es_ES');

        // Ahora puedes llamar a la factory y pasar $faker como argumento para que use el idioma español
        User::factory()->count(10)->create(['password' => bcrypt('password'), 'fecha_nacimiento' => $faker->date()]);
    }
}
