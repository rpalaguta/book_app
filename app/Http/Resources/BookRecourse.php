<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'id' => $this->id,
            'sku' => $this->sku,
            'category_name' => $this->category ? $this->category->name : null,
            'language' => $this->language,
            'authors' => AuthorResource::collection($this->authors),
            'created_at' => $this->created_at,
        ];
    }
}
