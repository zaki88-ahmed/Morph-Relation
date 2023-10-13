<?php

namespace App\Http\Resources;

use App\Http\Repositories\PageRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $url = [];
        foreach ($this->medias as $media){
            $url[] = new MediaResource($media);
        }

        return [
            'id' => $this->id,
            'content' => $this->content,
            'status' => $this->status,
            'page' => $this->pages,
            'media' => $url,
        ];
    }
}
