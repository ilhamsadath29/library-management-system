<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'id'           => $this->id,
            'site_id'      => $this->site_id,
            'name'         => $this->name,
            'status'       => $this->status,
            'created_at'   => (new DateTime($this->created_at))->format('Y-m-d H:i:s'),
            'updated_at'   => (new DateTime($this->updated_at))->format('Y-m-d H:i:s'),
        ];
    }
}
