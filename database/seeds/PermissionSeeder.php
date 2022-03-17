<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [1, 'menu-dashboard-show', 'Permission to show dashboard menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [2, 'section-admin-show', 'Permission to show admin section', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [3, 'menu-settings-show', 'Permission to show settings menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [4, 'menu-usermanagement-show', 'Permission to show usermanagement menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [5, 'menu-usermanagement-create', 'Permission to create in usermanagement menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [6, 'menu-usermanagement-edit', 'Permission to edit in usermanagement menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [7, 'menu-usermanagement-delete', 'Permission to delete in usermanagement menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [8, 'menu-section-show', 'Permission to show section menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [9, 'menu-section-create', 'Permission to create in section menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [10, 'menu-section-edit', 'Permission to edit in section menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [11, 'menu-section-delete', 'Permission to delete in section menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [12, 'menu-menu-show', 'Permission to show menu menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [13, 'menu-menu-create', 'Permission to create in menu menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [14, 'menu-menu-edit', 'Permission to edit in menu menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [15, 'menu-menu-delete', 'Permission to delete in menu menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [16, 'menu-roles-show', 'Permission to show roles menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [17, 'menu-roles-create', 'Permission to create in roles menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [18, 'menu-roles-edit', 'Permission to edit in roles menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [19, 'menu-roles-delete', 'Permission to delete in roles menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [20, 'section-mainmenu-show', 'Permission to show mainmenu section', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [21, 'menu-manajemenorganisasi-show', 'Permission to show manajemenorganisasi menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [22, 'menu-organisasi-show', 'Permission to show organisasi menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [23, 'menu-organisasi-create', 'Permission to create in organisasi menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [24, 'menu-organisasi-edit', 'Permission to edit in organisasi menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [25, 'menu-organisasi-delete', 'Permission to delete in organisasi menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [26, 'menu-manajemenanggota-show', 'Permission to show manajemenanggota menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [27, 'menu-manajemenanggota-create', 'Permission to create in manajemenanggota menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [28, 'menu-manajemenanggota-edit', 'Permission to edit in manajemenanggota menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [29, 'menu-manajemenanggota-delete', 'Permission to delete in manajemenanggota menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [30, 'menu-manajemenacara-show', 'Permission to show manajemenacara menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [31, 'menu-masteracara-show', 'Permission to show masteracara menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [32, 'menu-masteracara-create', 'Permission to create in masteracara menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [33, 'menu-masteracara-edit', 'Permission to edit in masteracara menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [34, 'menu-masteracara-delete', 'Permission to delete in masteracara menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [35, 'menu-laporanacara-show', 'Permission to show laporanacara menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [36, 'menu-laporanacara-create', 'Permission to create in laporanacara menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [37, 'menu-laporanacara-edit', 'Permission to edit in laporanacara menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
            [38, 'menu-laporanacara-delete', 'Permission to delete in laporanacara menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00'],
        ];

        foreach($permissions as $key => $row) {
            Permission::create([
                'permission_name' => $row[1],
                'description' => $row[2],
                'is_active' => $row[3],
                'created_at' => $row[4],
                'updated_at' => $row[5]
            ]);
        }
    }
}
