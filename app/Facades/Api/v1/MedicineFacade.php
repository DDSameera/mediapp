<?php

namespace App\Facades\Api\v1;

use App\Services\Api\v1\MedicineService;
use Illuminate\Support\Facades\Facade;

class MedicineFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return MedicineService::class;
    }
}
