<?php

namespace App\Models;

use App\Traits\HasCompanyTrait;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Scopes\CompanyScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Workday extends Model
{
    use HasFactory,
        HasCompanyTrait,
        CompanyScopeTrait;
}
