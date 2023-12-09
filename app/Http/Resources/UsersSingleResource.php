<?php

namespace App\Http\Resources;

use App\Enums\UserEnums;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersSingleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'type' => UserEnums::UserType[$this->type] ,
            'created_at' => \Carbon\Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans(),
            'avatar' => $this->file,
        ];
    }
}
