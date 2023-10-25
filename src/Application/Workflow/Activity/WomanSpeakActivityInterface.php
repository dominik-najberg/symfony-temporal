<?php

namespace App\Application\Workflow\Activity;

use App\Domain\Woman\Woman;
use Ramsey\Uuid\UuidInterface;
use Temporal\Activity\ActivityInterface;

#[ActivityInterface(prefix: 'SimpleActivity.')]
interface WomanSpeakActivityInterface
{
    public function speak(
        Woman $woman,
        string $sayWhat,
    ): string;
}
