<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class UserResource extends JsonResource
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
            'user_name' => $this->user_name,
            'email' => $this->email,
            'role' => $this->role,
        ];
    }

    public function withPreserveKeys() {
        $user = User::all();

        $resourceWithKeys = UserResource::collection($user)->preserveKeys(false);
        return response()->json(['data' => $resourceWithKeys]);
    }
}
