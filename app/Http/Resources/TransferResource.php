<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;

class TransferResource extends JsonResource
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
            'user_from' => $this->user_from,
            'user_to' => $this->user_to,
            'amount' => $this->amount,
            'created_at' => Date('Y-m-d H:m:s', strtotime($this->created_at)),
            'updated_at' => Date('Y-m-d H:m:s', strtotime($this->updated_at)),
            'sender' => new UserResource($this->sender),
            'receiver' => new UserResource($this->receiver)
        ];
    }
}
