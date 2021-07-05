<?php
namespace App\Modules\Laporan\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Laporan;

class JenisAduan extends Model {

    protected $table = 'jenis_aduan';
    protected $fillable = [
        'id',
        'jenis_aduan',
        'isAktif',
        'created_at',
        'updated_at',
        'user_id'
    ];

    public function laporan() {
        return $this->belongsTo(Laporan::class);
    }

}