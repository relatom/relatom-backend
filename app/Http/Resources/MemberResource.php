<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
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
            'fullname' => $this->fullname,
            'fullname_short' => $this->fullname_short,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'nickname' => $this->nickname,
            'email' => $this->email,
            'children' => MemberResource::collection($this->whenLoaded('children'))
        ];
    }
}
