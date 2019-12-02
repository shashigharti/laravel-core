<?php

namespace Robust\RealEstate\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


/**
 * Class Agent
 * @package Robust\RealEstate\Resources
 */
class Agent extends JsonResource
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'user_name' => $this->user_name,
            'email' => $this->member->email ?? '',
            'user_name' => $this->member->user_name ?? '',
            'roles' =>$this->member ? $this->member->roles()->get()->pluck('id')->toArray() : [],
            'contact' => $this->contact,
            'address' => $this->address
        ];
    }
}
