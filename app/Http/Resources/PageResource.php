<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
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
            'name' => $this->name,
            'about' => $this->about,
            'website' => $this->website,
            'phone' => $this->phone,
            'location' => $this->location,
            'category_id' => $this->when($this->category()->exists(), $this->category) ? $this->category : null,
            'cover' => $this->cover,
            'logo' => $this->logo,
//            'cover' => new MediaResource($this->medias),
//            'logo' => new MediaResource($this->medias),
        ];
    }
}
