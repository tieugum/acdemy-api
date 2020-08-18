<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            $this->mergeWhen(! $this->parent_id, [
                'children' => self::collection($this->whenLoaded('children'))
            ]),
            'created_dates' => [
                'created_at' => $this->created_at,
                'created_at_human' => $this->created_at->diffForHumans()
            ],
            'updated_dates' => [
                'updated_at' => $this->updated_at,
                'updated_at_human' => $this->updated_at->diffForHumans()
            ],
        ];
    }
}
