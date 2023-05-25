<?php

namespace App\Http\Resources;

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
        // return $this->whenLoaded('dataTutorial') ? $this->dataTutorial->tutorials->dataTutorial : false;
        return [
            'id' => $this->id,
            'author' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'username' => $this->user->username,
                'email' => $this->user->email,
            ],
            'title' => $this->title,
            'slug' => $this->slug,
            'meta_desc' => $this->meta_desc,
            'tag' =>$this->tag,
            'category' => null,
            'image_cover' => $this->image_cover,
            'body'=> $this->body,
            'tutorial' => $this->whenLoaded('dataTutorial') ? [
                'title' => $this->dataTutorial->tutorials->title,
                'list' => $this->mappingListTutorial($this->dataTutorial->tutorials->dataTutorial, $this->slug)
            ] : null,
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),

        ];
    }
    public function mappingListTutorial($data, $slug)
    {
        $result = [];

        foreach($data as $item){
            $result[] = [
                'title' => $item->post->title,
                'slug' => $item->post->slug,
                'current_post' => $item->post->slug == $slug ? 'active' : ''
            ];
        }

        return $result;
    }
}
