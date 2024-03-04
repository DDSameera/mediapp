<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MedicineCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request)
    {
        $totalCount = $this->collection->count();

        $data =  $this->collection->map(function ($medicine) {

            return  new MedicineResource($medicine);
        });


        return [
            'tblData' => $data,
            'totalDataCount' => $totalCount
        ];
    }
}
