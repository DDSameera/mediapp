<?php

namespace App\Services\Api\v1;

use App\Http\Requests\Api\v1\MedicineRequest;
use App\Models\Api\v1\Medicine;

use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\UnauthorizedException;

class MedicineService
{



    public function getAll()
    {
        return Medicine::all();
    }

    public function create(MedicineRequest $request)
    {
        //Check Authorization
        if (!Gate::allows('create', Medicine::class)) {
            throw new UnauthorizedException('You are not authorized to create a medicine.');
        }


        return  Medicine::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'qty' => $request->qty
        ]);
    }

    public function update(Medicine $medicine, MedicineRequest $request)
    {

        if (!Gate::allows('update', $medicine)) {
            throw new UnauthorizedException('You are not authorized to do permanent delete a medicine.');
        }

        $medicine->name = $request->name;
        $medicine->desc =  $request->desc;
        $medicine->qty =  $request->qty;

        $medicine->save();
    }

    public function delete(Medicine $medicine)
    {

        //Check Authorization
        if (!Gate::allows('delete', $medicine)) {
            throw new UnauthorizedException('You are not authorized to delete a medicine.');
        }

        $medicine->delete();
    }

    public function getTrash($id)
    {
        $medicine =  Medicine::withTrashed()->find($id);
        $medicine->restore();
        return $medicine;
    }

    public function  forceDelete($id)
    {
        $medicine = Medicine::find($id);
        if (!Gate::allows('forceDelete', $medicine)) {
            throw new UnauthorizedException('You are not authorized to do permanent delete a medicine.');
        }


        $medicine = $this->getTrash($id);
        $medicine->restore();
        return $medicine;
    }
}
