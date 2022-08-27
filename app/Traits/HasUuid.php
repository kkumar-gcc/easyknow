<?php

namespace App\Traits;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
trait HasUuid
{
    public function uuid(): UuidInterface
    {
        return Uuid::fromString($this->uuid);
    }
    public static function findByUuidOrFail(UuidInterface $uuid): self
    {
        return static::where('uuid', $uuid->toString())->firstOrFail();
    }
}
