<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class UserResource extends JsonResource
{
    #[ArrayShape(['id' => "mixed", 'name' => "mixed", 'email' => "mixed", 'created_at' => "mixed", 'updated_at' => "mixed", 'token' => "mixed"])]
    public function toArray($request): array|\JsonSerializable|\Illuminate\Contracts\Support\Arrayable
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'token' => $this->createToken('taling-externship-Kyungseo-Park')->accessToken,
        ];
    }
}
