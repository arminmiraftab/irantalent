<?php

namespace App\Http\Resources;

use App\Models\skill_user;
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
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'country' => $this->country,
            'skill' => $this->whenLoaded('skill', function () {
                foreach ($this->skill as $a) {
                    return['id'=>$a->id,
                        'title'=>$a->title,
                        'created_at'=>$a->created_at];
                };
            }) ,
            'level' => $this->whenLoaded('level_user', function () {
                foreach ($this->level_user as $a) {
                    return  $a->level;
                };
            }) ,
            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
        ];
    }
}
