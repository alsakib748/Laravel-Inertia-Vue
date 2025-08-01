<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\SectionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "class" => ClassesResource::make($this->whenLoaded("class")),
            "section" => SectionResource::make($this->whenLoaded("section")),
            'created_at' => $this->created_at->toFormattedDateString(),
            // todo: whenLoaded use: this data will pass that's time when eager loading call by realtion using with.
        ];
    }
}