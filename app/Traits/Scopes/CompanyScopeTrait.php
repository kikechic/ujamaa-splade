<?php

namespace App\Traits\Scopes;

use App\Models\Scopes\CompanyScope;

trait CompanyScopeTrait
{
    protected static function bootCompanyScopeTrait()
    {
        return static::addGlobalScope(new CompanyScope);
    }
}
