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

    private $pagination;
    public function __construct($resource)
    {
        $this->pagination = [
            'currentPage' => $resource->currentPage(),
            'totalItems' => $resource->total(),
            'itemsPerPage' => $resource->perPage(),
            'totalPages' => $resource->lastPage()
        ];

        $this->links = [
            'prev' => $resource->nextPageUrl(),
            'next' => $resource->previousPageUrl(),
            'self' => $resource->url($resource->currentPage())
        ];
    
        $resource = $resource->getCollection();
    
        parent::__construct($resource);
    }
    
    public function toArray($request)
    {
        return [
            'meta' => $this->pagination,
            'data' => $this->collection,
            'links' => $this->links
        ];
    }
    
}
