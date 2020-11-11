<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'message' => $this->message,
            'created_by' => $this->user->fullname,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
