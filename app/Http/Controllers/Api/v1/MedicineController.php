<?php

namespace App\Http\Controllers\Api\v1;

use App\Facades\Api\v1\MedicineFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\MedicineRequest;
use App\Http\Resources\Api\v1\MedicineCollection;
use App\Http\Resources\Api\v1\MedicineResource;
use App\Models\Api\v1\Medicine;
use App\Services\Api\v1\ResponseService;
use Illuminate\Support\Facades\Gate;

class MedicineController extends Controller
{

    /**
     * Display a list of medicines
     */
    public function index()
    {

        $medicines = MedicineFacade::getAll();

        return ResponseService::successResponse('List of Medicines', new MedicineCollection($medicines));
    }

    /**
     * Store a newly created medicine in storage.
     */
    public function store(MedicineRequest $request)
    {


        $medicine = MedicineFacade::create($request);

        return ResponseService::successResponse('Medicine Record has been created', new MedicineResource($medicine));
    }

    /**
     * Display the specified medicine.
     */
    public function show(Medicine $medicine)
    {

        return ResponseService::successResponse('Medicine Record', new MedicineResource($medicine));
    }


    /**
     * Update the specified medicine in storage.
     */
    public function update(MedicineRequest $request, Medicine $medicine)
    {

        MedicineFacade::update($medicine, $request);

        return ResponseService::successResponse('Medicine Record has been updated', new MedicineResource($medicine));
    }

    /**
     * Soft Delete the specified resource from storage.
     */
    public function destroy(Medicine $medicine)
    {
        MedicineFacade::delete($medicine);

        return  ResponseService::successResponse('Medicine Record has been softly deleted');
    }

    /**
     * Restore Soft Deleted  specified resource from storage.
     */

    public function restore($id)
    {


        $medicine = MedicineFacade::getTrash($id);

        if ($medicine) {

            return  ResponseService::successResponse(' Medicine Record has been restored ', new MedicineResource($medicine));
        } else {
            return  ResponseService::errorResponse(' Medicine Record cannot be restored or not found');
        }
    }

    public function forceDelete($id)
    {

        $medicine = MedicineFacade::forceDelete($id);

        if ($medicine) {
            return  ResponseService::successResponse(' Medicine Record has been permanently ', new MedicineResource($medicine));
        } else {
            return  ResponseService::errorResponse(' Medicine Record cannot be restored or not found');
        }
    }
}
