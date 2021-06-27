<?php
namespace App\Modules\Laporan\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LaporanPasien extends Model {

    protected $table = 'laporan_pasien';
    protected $fillable = [
        'nama_lengkap',
        'prov_id',
        'kab_id',
        'kec_id',
        'kel_id',
        'alamat',
        'tgl_lahir',
        'golongan_darah',
        'updated_at',
        'laporan_id',
        'nik',
    ];
}