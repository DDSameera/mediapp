<?php

namespace App\Http\Controllers\Api\v1;

use App\Facades\Api\v1\CustomerFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\CustomerRequest;
use App\Http\Resources\Api\v1\CustomerCollection;
use App\Http\Resources\Api\v1\CustomerResource;
use App\Models\Api\v1\Customer;
use App\Services\Api\v1\ResponseService;


class CustomerController extends Controller
{
    /**
     * Display a list of customer records
     */
    public function index()
    {

        $customers = CustomerFacade::getAll();
        return ResponseService::successResponse('List of Customer Records', new CustomerCollection($customers));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {



        $customer = CustomerFacade::create($request);
        return ResponseService::successResponse('Customer Record has been created', new CustomerResource($customer));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return ResponseService::successResponse('Customer Record', new CustomerResource($customer));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Customer $customer)
    {

        CustomerFacade::update($customer, $request);


        return ResponseService::successResponse('Customer Record has been updated', new CustomerResource($customer));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        CustomerFacade::delete($customer);
        return  ResponseService::successResponse('Customer Record has been softly deleted');
    }

    /**
     * Restore Soft Deleted  specified resource from storage.
     */

    public function restore($id)
    {

        $customer =  CustomerFacade::getTrash($id);

        if ($customer) {
            return  ResponseService::successResponse(' Customer Record has been restored ', new CustomerResource($customer));
        } else {
            return  ResponseService::errorResponse(' Customer Record cannot be restored or not found');
        }
    }

    public function forceDelete($id)
    {

        $customer = CustomerFacade::forceDelete($id);

        if ($customer) {
            return  ResponseService::successResponse(' Customer Record has been permanently ', new CustomerResource($customer));
        } else {
            return  ResponseService::errorResponse(' Customer Record cannot be restored or not found');
        }
    }
}
