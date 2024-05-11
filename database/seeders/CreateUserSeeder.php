<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;

class CreateUserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [[
                'user_id' => '1',
                'username' => 'galang',
                'email' => 'galang@gmail.com',
                'namalengkap' => 'Galang',
                'password' => bcrypt('123456'),
                'role' => 'superadmin'
            ],
            [
                'user_id' => '2',
                'username' => 'budi',
                'email' => 'budi@gmail.com',
                'namalengkap' => 'Budi',
                'password' => bcrypt('123456'),
                'role' => 'admin'
            ],
            [
                'user_id' => '3',
                'username' => 'marisa',
                'email' => 'marisa@gmail.com',
                'namalengkap' => 'Marisa',
                'password' => bcrypt('123456'),
                'role' => 'staff'
            ]
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
?>