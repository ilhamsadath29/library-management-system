<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
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
            'id'                             => $this->id,
            'lib_name'                       => $this->lib_name,
            'lib_address'                    => $this->lib_address,
            'lib_contact_number'             => $this->lib_contact_number,
            'lib_total_book_issue_day'       => $this->lib_total_book_issue_day,
            'lib_one_day_fine'               => $this->lib_one_day_fine,
            'lib_issue_total_book_per_user'  => $this->lib_issue_total_book_per_user,
            'lib_currency'                   => $this->lib_currency,
            'lib_timezone'                   => $this->lib_timezone,
            'status'                         => $this->status,
            'created_at'                     => (new DateTime($this->created_at))->format('Y-m-d H:i:s'),
            'updated_at'                     => (new DateTime($this->updated_at))->format('Y-m-d H:i:s'),
        ];
    }
}
