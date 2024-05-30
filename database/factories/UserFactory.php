<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'username' => $this->faker->userName,
            'password' => Hash::make('password'), // Puedes usar una contraseña estática o generar una aleatoria
            'fecha_nacimiento' => $this->faker->date(),
            'imagen_perfil' => 'default.jpg', // Puedes cambiar esto según sea necesario
            'biografia' => $this->faker->paragraph,
            'created_at' => now(),
            'updated_at' => now(),
            'profile_picture' => 'default.jpg', // Puedes cambiar esto según sea necesario
        ];
    }
}
