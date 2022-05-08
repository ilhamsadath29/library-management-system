<?php

namespace App\Http\Resources;

use DateTime;
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
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'address'     => $this->address,
            'contact'     => $this->contact,
            'email'       => $this->email,
            'created_at'  => (new DateTime($this->created_at))->format('Y-m-d H:i:s'),
            'updated_at'  => (new DateTime($this->updated_at))->format('Y-m-d H:i:s'),
        ];
    }
}
