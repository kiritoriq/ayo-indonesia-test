<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SportBranch extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sport_branch';
    protected $guarded = [
        'id'
    ];
}
