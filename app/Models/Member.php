<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'member';
    protected $guarded = [
        'id'
    ];

    public function org_member()
    {
        return $this->hasMany(OrgMember::class, 'member_id', 'id');
    }
}
