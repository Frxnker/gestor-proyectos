<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Usuario fijo para entrar a probar (contraseña: password)
        $demo = User::factory()->create([
            'name' => 'Frank',
            'email' => 'test@example.com',
        ]);

        $users = User::factory(5)->create()->push($demo);
        $roles = ['Desarrollador', 'Diseñador', 'Tester'];

        Project::factory(8)
            ->state(fn () => ['user_id' => $users->random()->id])
            ->create()
            ->each(function (Project $project) use ($users, $roles) {
                // 2 participantes al azar que no sean el propietario
                $members = $users->where('id', '!=', $project->user_id)->random(2);

                foreach ($members as $member) {
                    $project->members()->attach($member->id, [
                        'role' => fake()->randomElement($roles),
                        'contribution_hours' => fake()->randomFloat(2, 1, 40),
                    ]);
                }
            });
    }
}
