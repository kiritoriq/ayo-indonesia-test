<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [2, 'admin', '$2y$10$ao/iDtHHpF.aFrCkOZz5n.F52sjQqtGMVWfrkU2bFGxNhipH8tr.K', '2021-06-25 21:34:26', '2021-06-25 21:34:26'],
            [7, 'callcenter01', '$2y$10$JfRujoUy5T.2yUf3DshnpevRMHj/15Lby9/ygCVlSd45Tvd6wwsVm', '2021-06-26 06:34:26', '2021-06-26 06:34:26'],
            [8, 'callcenter02', '$2y$10$TjpgLfeFEq9/B4igrhdGxeGpCE8cXHEKGsYuiBUSPs6oLAI8lS.dO', '2021-06-26 06:34:26', '2021-06-26 06:34:26'],
            [9, 'callcenter03', '$2y$10$6UBEEyhsrsL78.soGbFO9OC1i1NqjkZX3d5p9vu8si1DJ.ayDrR8O', '2021-06-26 06:34:26', '2021-06-26 06:34:26'],
            [10, 'callcenter04', '$2y$10$OozKxIZqGGv40PW2SSTpgetox7Bgo.U1jkAGHaUDikkSxqLz.PHIm', '2021-06-26 06:34:26', '2021-06-26 06:34:26'],
            [11, 'callcenter05', '$2y$10$rv3XZBv3yRe4UIXkUWAQ1e6jhEl3ahi7q43MEeds2wX62tZeLRM1y', '2021-06-26 06:34:26', '2021-06-26 06:34:26'],
            [12, 'callcenter06', '$2y$10$iFJKtCAmGwAN1sCMExE7qee3PQzKwQAvRW75zYZiVEJMnSxNRDdT.', '2021-06-26 06:34:26', '2021-06-26 06:34:26'],
            [13, 'callcenter07', '$2y$10$ww3SAWTV/wTLQ3znKvMVZu3rhpJB95BjCbTQcJRM52bH4LAjU/Nw.', '2021-06-26 06:34:26', '2021-06-26 06:34:26'],
            [14, 'callcenter08', '$2y$10$s6GYI1pypuPl1RPurXrUbeeC9lOGhjKbPX2L69SHUzic2Kqprgulq', '2021-06-26 06:34:26', '2021-06-26 06:34:26'],
            [15, 'callcenter09', '$2y$10$X2rmzYYwYbd2zZLGpYQpe.6/HAOP10zMH41dSGenr1TWL2Ghfg7Xm', '2021-06-26 06:34:26', '2021-06-26 06:34:26'],
            [16, 'callcenter10', '$2y$10$QitSg2BsziEb4OlP7rguHOd1s3LNnltThnIY/TLFDGfpc8KtMIRAq', '2021-06-26 06:34:26', '2021-06-26 06:34:26'],
        ];

        foreach($user as $key => $row) {
            User::create([
                'id' => $row[0],
                'username' => $row[1],
                'password' => $row[2],
                'created_at' => $row[3],
                'updated_at' => $row[4]
            ]);
        }
    }
}
