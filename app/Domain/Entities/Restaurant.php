<?php

namespace Domain\Entities;

use Domain\Exceptions\DomainException;

class Restaurant
{
    private ?int $id;

    private string $name;

    private string $slug;

    private string $status;

    private ?string $openingTime;

    private ?string $closingTime;

    public function __construct(
        string $name,
        string $slug,
        ?string $openingTime = null,
        ?string $closingTime = null,
        string $status = 'active'
    ) {
        if ($name === '') {
            throw new DomainException('Restaurant name is required');
        }

        $this->id = null;
        $this->name = $name;
        $this->slug = $slug;
        $this->openingTime = $openingTime;
        $this->closingTime = $closingTime;
        $this->status = $status;
    }

    public function deactivate(): void
    {
        $this->status = 'inactive';
    }

    public function activate(): void
    {
        $this->status = 'active';
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'status' => $this->status,
            'opening_time' => $this->openingTime,
            'closing_time' => $this->closingTime,
        ];
    }
}
