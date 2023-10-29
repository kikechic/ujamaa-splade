<?php

namespace App\Models;

use App\Traits\HasUserTrait;
use App\Traits\HasUpdaterTrait;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model implements HasMedia
{
    use HasFactory,
        HasUserTrait,
        HasUpdaterTrait,
        InteractsWithMedia;

    protected $fillable = [
        'name',
        'timezone',
        'email',
        'start_date',
        'end_date',
        'status',
    ];
}
