<?php

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Menu Seeder
         * table = 'menu'
         * column = {
         *  id,
         *  section,
         *  is_active,
         *  created_at,
         *  updated_at,
         * }
         */
        $sections = [
            [1, 'Admin', 1, 1, '2021-08-10 14:19:26', '2021-08-10 14:19:26'],
        ];

        foreach ($sections as $key => $row) {
            Section::updateOrCreate([
                'id' => $row[0]
            ], [
                'section' => $row[1],
                'order' => $row[2],
                'is_active' => $row[3],
                'created_at' => $row[4],
                'updated_at' => $row[5],
            ]);
        }
    }
}
