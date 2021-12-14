<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
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
            'user' =>  $this->user,
//            'user_id' => $this->user->id,
            'skill' => $this->skill ,
//            'skill_title' => $this->skill->title ,
            'level' => $this->level ,
        ];
    }
}
