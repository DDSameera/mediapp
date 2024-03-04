<?php

namespace App\Services\Api\v1;

use App\Http\Requests\Api\v1\CustomerRequest;
use App\Models\Api\v1\Customer;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\UnauthorizedException;

class CustomerService
{

    public function getAll()
    {
        return Customer::all();
    }

    public function create(CustomerRequest $request)
    {

        //Check Authorization
        if (!Gate::allows('create', Customer::class)) {
            throw new UnauthorizedException('You are not authorized to create a customer.');
        }


        return  Customer::create([
            'name' => $request->name,
            'address' => $request->address,
            'contact_no' => $request->contact_no
        ]);
    }

    public function update(Customer $customer, CustomerRequest $request)
    {

        //Check Authorization
        if (!Gate::allows('update', $customer)) {
            throw new UnauthorizedException('You are not authorized to do permanent delete a customer.');
        }

        $customer->name = $request->name;
        $customer->address =  $request->address;
        $customer->contact_no =  $request->contact_no;

        $customer->save();
    }

    public function delete(Customer $customer)
    {

        //Check Authorization

        if (!Gate::allows('delete', $customer)) {
            throw new UnauthorizedException('You are not authorized to delete a customer.');
        }

        $customer->delete();
    }

    public function getTrash($id)
    {
        return  Customer::withTrashed()->find($id);
    }

    public function  forceDelete($id)
    {
        $customer = Customer::find($id);

        //Check Authorization
        if (!Gate::allows('forceDelete', $customer)) {
            throw new UnauthorizedException('You are not authorized to do permanent delete a customer.');
        }


        $customer = $this->getTrash($id);
        $customer->restore();
        return $customer;
    }
}
