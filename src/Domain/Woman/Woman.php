<?php declare(strict_types=1);

namespace App\Domain\Woman;

use Ramsey\Uuid\UuidInterface;

class Woman
{
    private array $talkedAbout = [];

    private function __construct(
        private UuidInterface $id,
        private string        $name,
    ) {
    }

    public static function create(
        UuidInterface $id,
        string        $name,
    ): self {
        return new self($id, $name);
    }

    public function talk(string $anything): string
    {
        $this->talkedAbout[] = $anything;

        // TODO: find a way to stop this somehow

        return $anything;
    }
}
