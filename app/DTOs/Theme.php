<?php

namespace App\DTOs;

class Theme
{
    public function __construct(
        public string $name,
        public string $slug,
        public string $version,
        public string $author,
        public string $description,
        public ?string $preview_image = null,
        public array $supported_features = [],
        public string $path = ''
    ) {}

    public static function fromArray(array $data, string $path): self
    {
        return new self(
            name: $data['name'] ?? 'Unknown Theme',
            slug: $data['slug'] ?? basename($path),
            version: $data['version'] ?? '1.0.0',
            author: $data['author'] ?? 'Unknown',
            description: $data['description'] ?? '',
            preview_image: $data['preview_image'] ?? null,
            supported_features: $data['supported_features'] ?? [],
            path: $path
        );
    }
}
