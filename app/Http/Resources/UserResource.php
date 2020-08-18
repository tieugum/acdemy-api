<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class UserResource extends JsonResource
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
            'slug' => Str::slug($this->name),
            'email' => $this->email,
            'tagline' => $this->tagline,
            'about' => $this->about,
            'socials' => [
                'facebook' => $this->facebook,
                'twitter' => $this->twitter,
                'youtube' => $this->youtube
            ],
            'created_dates' => [
                'created_at' => $this->created_at,
                'created_at_human' => $this->created_at->diffForHumans()
            ]
        ];
    }
}
