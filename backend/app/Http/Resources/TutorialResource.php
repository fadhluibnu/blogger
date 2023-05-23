<?php

namespace App\Http\Resources;

use App\Models\DataTutorial;
use Illuminate\Http\Resources\Json\JsonResource;

class TutorialResource extends JsonResource
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
            'title' => $this->title,
            'image' => $this->image,
            'slug' => $this->slug,
            'roadmap_id' => $this->roadmap_id,
            'description' => $this->description,
            'data_tutorial' => DataTutorialResource::collection($this->dataTutorial->load('post')),
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y')
        ];
    }
}
