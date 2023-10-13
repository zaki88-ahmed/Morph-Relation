<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'content' => $this->content,
            'isHidden' => $this->isHidden,
            'parent_id' => $this->when($this->comment()->exists(), $this->comment) ? $this->comment : null,
            'post_id' => $this->when($this->post()->exists(), $this->post->content),
            'comments' => $this->when($this->comments()->exists(), $this->comments),
            'media' => $url,
        ];
    }
}
