<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RelationArticlsElderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
           'name' => $this->name,
           'image' => asset('uploads/' . $this->image),
           'email' => $this->email,
           'phone' => $this->phone_number,
            ' Articls' => ArticlsResource::collection($this->whenLoaded('Articls')),

        ];
    }
}
