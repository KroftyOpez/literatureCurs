<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryResource extends JsonResource
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
            'content' => $this->content,
            'name' => $this->name,
            'photo' => $this->photo,
            'description' => $this->description,
            'read_time' => $this->read_time,
            'created_at' => $this->created_at,
            'user' => [
                'id' => $this->user->id,
                'nickname' => $this->user->nickname,
                'avatar' => $this->user->avatar,
            ],
            'categories' => $this->categories->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                ];
            }),

        ];
    }
}
