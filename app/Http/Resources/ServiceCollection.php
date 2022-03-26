<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ServiceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'services' => $this->collection,
            'total' => $this->total(),
            'current_page' => $this->currentPage(),
            'first_page_url' => $this->url(1),
            'from' => $this->firstItem(),
            "next_page_url" => $this->nextPageUrl(),
            "path" => $this->getOptions()['path'],
            "per_page" => $this->perPage(),
            "prev_page_url" => $this->previousPageUrl(),
            'to' => $this->lastItem(),
            'last_page_url' => $this->url($this->lastPage())
        ];
    }
}
