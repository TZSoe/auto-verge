<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use App\Http\Resources\ServiceResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'date' => Carbon::parse($this->date)->format("d/m/Y"),
            'customer_id' => $this->customer_id,
            'customer_name' => $this->customer->name,
            'customer_email' => $this->customer->email,
            'car_number' => $this->car_number,
            'services' => ServiceResource::collection($this->services),
            'duration' => $this->duration > 1 ? $this->duration." days" : $this->duration." day",
            'notes' => $this->notes,
            'is_taken_back' => $this->is_taken_back ? true : false,
            'created_at' => $this->created_at->format("Y-m-d h:i:s"),
            'updated_at' => $this->updated_at->format("Y-m-d h:i:s"),
        ];
    }
}
