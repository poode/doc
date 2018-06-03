<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title'   => (string) $this->getTitle(),
            'slug'    => (string) $this->getSlug(),
            'content' => (string) $this->getContent(),
            'user'    => new UserResource($this->whenLoaded('user')),
        ];
    }
}
