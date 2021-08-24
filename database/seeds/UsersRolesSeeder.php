<?php

use Illuminate\Database\Seeder;
use App\Models\UsersRoles;

class UsersRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users_roles = [
            [1, 1]
        ];

        foreach ($users_roles as $key => $row) {
            UsersRoles::create([
                'user_id' => $row[0],
                'role_id' => $row[1]
            ]);
        }
    }
}
