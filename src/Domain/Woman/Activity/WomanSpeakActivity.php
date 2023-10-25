<?php declare(strict_types=1);

namespace App\Domain\Woman\Activity;

use App\Application\Workflow\Activity\WomanSpeakActivityInterface;
use App\Domain\Woman\Woman;

class WomanSpeakActivity implements WomanSpeakActivityInterface
{
    public function speak(Woman $woman, string $sayWhat,): string
    {
        return $woman->talk($sayWhat);
    }
}
