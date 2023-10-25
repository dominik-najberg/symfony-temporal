<?php declare(strict_types=1);

namespace App\Domain\Woman\Activity;

use App\Application\Workflow\Activity\WomanCreationActivityInterface;
use App\Domain\Woman\Woman;
use Ramsey\Uuid\UuidInterface;

class WomanCreationActivity implements WomanCreationActivityInterface
{
    public function createWoman(UuidInterface $id, string $name): Woman
    {
        return Woman::create($id, $name);
    }
}
