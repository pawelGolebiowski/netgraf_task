<?php

namespace App\DataTransferObjects;

class PetData
{
    public function __construct(
        public int $id,
        public ?array $category,
        public string $name,
        public array $photoUrls,
        public array $tags,
        public string $status
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            category: [
                'id' => $data['category_id'] ?? 0,
                'name' => $data['category_name'] ?? ''
            ],
            name: $data['name'],
            photoUrls: explode(',', $data['photoUrls'] ?? ''),
            tags: array_map(
                fn($tag) => ['id' => 0, 'name' => trim($tag)],
                explode(',', $data['tags'] ?? '')
            ),
            status: $data['status']
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'category' => $this->category,
            'name' => $this->name,
            'photoUrls' => $this->photoUrls,
            'tags' => $this->tags,
            'status' => $this->status
        ];
    }
}
