<?php

namespace App\Facades\Api\v1;

use App\Services\Api\v1\CustomerService;
use Illuminate\Support\Facades\Facade;

class CustomerFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return CustomerService::class;
    }
}
