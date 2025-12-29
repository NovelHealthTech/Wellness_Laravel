<?php

    namespace Database\Seeders;

    use App\Models\User;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use Spatie\Permission\Models\Role;

    class DatabaseSeeder extends Seeder
    {
        use WithoutModelEvents;

        /**
         * Seed the application's database.
         */
        public function run(): void
        {
            // User::factory(10)->create();
            $role = Role::firstOrCreate(['name' => 'Super Admin']);

            // Create user
            $user = User::firstOrCreate(
                ['email' => 'admin@example.com'],
                [
                    'firstname' => 'Super Admin',
                    'password' => bcrypt('password123')
                ]
            );

            // Assign Super Admin role
            $user->assignRole($role);

            // User::factory()->create([
            //     'firstname' => 'Test User',
            //     'email' => 'test@example.com',
            // ]);

        }
         
    }
