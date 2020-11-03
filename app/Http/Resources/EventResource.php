<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'id' => $this->hashid(),
            'title' => is_null($this->title) ? trans('events.untitled') : $this->title,
            'is_all_day' => $this->is_all_day,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
            'notes' => $this->notes
        ];
    }
}
