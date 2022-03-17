<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'organization';
    protected $guarded = [
        'id'
    ];

    public function sports()
    {
        return $this->belongsTo(SportBranch::class, 'sport_branch_id');
    }

    public function org_member()
    {
        return $this->hasMany(OrgMember::class, 'org_id', 'id');
    }
}
