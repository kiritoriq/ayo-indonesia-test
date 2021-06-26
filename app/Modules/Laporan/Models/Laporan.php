<?php
namespace App\Modules\Laporan\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Laporan extends Model {

    protected $table = 'laporan';
    protected $fillable = [
        'nama_pelapor',
        'alamat_pelapor',
        'no_telp_pelapor',
        'kab_id',
        'kec_id',
        'kel_id',
        'isi_laporan',
        'instansi',
        'user_id',
        'role_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function petugas() {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

}