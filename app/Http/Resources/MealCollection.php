<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MealCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function __construct($resource)
    {
        $this->meta = [
            'currentPage' => $resource->currentPage(),
            'totalItems' => $resource->total(),
            'itemsPerPage' => $resource->perPage(),
            'totalPages' => $resource->lastPage()
        ];

        $this->links = [
            'prev' => $resource->previousPageUrl(),
            'next' => $resource->nextPageUrl(),
            'self' => $resource->url($resource->currentPage())
        ];
    
        $resource = $resource->getCollection();
    
        parent::__construct($resource);
    }
    
    public function toArray($request)
    {
        return [
            'meta' => $this->meta,
            'data' => $this->collection,
            'links' => $this->links
        ];
    }
    
}
