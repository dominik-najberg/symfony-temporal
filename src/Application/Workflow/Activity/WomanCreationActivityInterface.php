<?php

namespace App\Application\Workflow\Activity;

use App\Domain\Woman\Woman;
use Ramsey\Uuid\UuidInterface;
use Temporal\Activity\ActivityInterface;

#[ActivityInterface(prefix: 'SimpleActivity.')]
interface WomanCreationActivityInterface
{
    public function createWoman(
        UuidInterface $id,
        string $name
    ): Woman;
}
