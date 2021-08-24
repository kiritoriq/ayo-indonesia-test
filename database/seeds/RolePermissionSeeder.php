<?php

use App\Models\RolePermission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_permissions = [
            [1, 1, 1, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [2, 1, 2, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [3, 1, 3, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [4, 1, 4, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [5, 1, 5, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [6, 1, 6, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [7, 1, 7, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [8, 1, 8, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [9, 1, 9, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [10, 1, 10, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [11, 1, 11, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [12, 1, 12, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [13, 1, 13, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [14, 1, 14, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [15, 2, 1, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [16, 2, 2, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [17, 1, 3, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [18, 1, 4, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [19, 1, 7, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [20, 1, 8, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [21, 1, 11, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [22, 1, 12, null, null, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
        ];

        foreach($role_permissions as $key => $row) {
            RolePermission::create([
                'id' => $row[0],
                'role_id' => $row[1],
                'permission_id' => $row[2],
                'start_date' => $row[3],
                'end_date' => $row[4],
                'created_at' => $row[5],
                'updated_at' => $row[6]
            ]);
        }
    }
}