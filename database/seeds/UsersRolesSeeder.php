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
            [1, 1],
            [1, 2],
            [7, 2],
            [8, 2],
            [9, 2],
            [10, 2],
            [11, 2],
            [12, 2],
            [13, 2],
            [14, 2],
            [15, 2],
            [16, 2],
        ];

        foreach ($users_roles as $key => $row) {
            UsersRoles::create([
                'user_id' => $row[0],
                'role_id' => $row[1]
            ]);
        }
    }
}
