<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'current_balance' => $this->current_balance,
            'created_at' => Date('Y-m-d H:m:s', strtotime($this->created_at)),
            'updated_at' => Date('Y-m-d H:m:s', strtotime($this->updated_at)),
        ];
    }
}
