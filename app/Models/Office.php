<?php

namespace App\Models;

use App\Traits\HasUserTrait;
use App\Traits\HasCompanyTrait;
use App\Traits\HasUpdaterTrait;
use Kirschbaum\PowerJoins\PowerJoins;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Scopes\CompanyScopeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Office extends Model
{
    use HasFactory,
        HasUserTrait,
        HasUpdaterTrait,
        HasCompanyTrait,
        CompanyScopeTrait,
        PowerJoins,
        SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'status',
    ];
}
