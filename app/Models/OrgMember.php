<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgMember extends Model
{
    use HasFactory;

    protected $table = 'org_member';
    protected $primaryKey = null;
    public $timestamps  = false;
    public $incrementing = false;
    protected $fillable = [
        'org_id',
        'position_id',
        'member_id'
    ];
    
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
