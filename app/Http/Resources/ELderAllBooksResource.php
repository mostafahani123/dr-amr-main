<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ELderAllBooksResource extends JsonResource
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
            'name'=>$this->name,
            'image'=> asset('uploads/' . $this-> image),
            'email'=>$this->email,
            'phone_number'=>$this->phone_number,
            'books' => FileBookResoure::collection($this->whenLoaded('books')), //this key books: [data]

        ];
    }
}
