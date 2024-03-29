<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $totalCount = $this->collection->count();

        $data =  $this->collection->map(function ($customer) {

            return  new CustomerResource($customer);
        });


        return [
            'tblData' => $data,
            'totalDataCount' => $totalCount
        ];
    }
}
