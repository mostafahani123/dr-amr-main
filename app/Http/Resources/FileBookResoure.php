<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileBookResoure extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' =>asset('uploads/'. $this->image),
            'file' => asset('uploads/'. $this->file),
            'status' => $this->status,
            'elder' => BookElderResource::collection($this->whenLoaded('elder')),
        ];
    }
}
