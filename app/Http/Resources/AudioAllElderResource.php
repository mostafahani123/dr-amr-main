<?php

namespace App\Http\Resources;

use App\Http\Resources\ElderResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AudioAllElderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [
            'id' => $this->id,
            'title' => $this->title,
            'image' => asset('uploads/' . $this->image),
            'audio' => asset('uploads/' . $this->audio),
            'status' => $this->status,
            'elder' => ElderResource::make($this->whenLoaded('elder')),
        ];
    }
}
