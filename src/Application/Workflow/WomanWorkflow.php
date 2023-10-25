<?php declare(strict_types=1);

namespace App\Application\Workflow;

use App\Application\Workflow\Activity\WomanCreationActivityInterface;
use App\Application\Workflow\Activity\WomanSpeakActivityInterface;
use Carbon\CarbonInterval;
use Ramsey\Uuid\Uuid;
use Temporal\Activity\ActivityOptions;
use Temporal\Internal\Workflow\ActivityProxy;
use Temporal\Workflow;
use Temporal\Workflow\WorkflowMethod;

class WomanWorkflow implements WomanWorkflowInterface
{
    private WomanCreationActivityInterface|ActivityProxy $womanCreationActivity;
    private WomanSpeakActivityInterface|ActivityProxy $womanSpeakActivity;

    public function __construct()
    {
        $this->womanCreationActivity = Workflow::newActivityStub(
            WomanCreationActivityInterface::class,
            ActivityOptions::new()
                ->withStartToCloseTimeout(CarbonInterval::seconds(2))
        );
        $this->womanSpeakActivity = Workflow::newActivityStub(
            WomanSpeakActivityInterface::class,
            ActivityOptions::new()
                ->withStartToCloseTimeout(CarbonInterval::years(2))
        );
    }

    #[WorkflowMethod(name: "SimpleActivity.womanize")]
    public function womanize(string $name) : \Generator
    {
        $woman = yield $this->womanCreationActivity->createWoman(
            Uuid::uuid4(),
            $name,
        );

        return yield $this->womanSpeakActivity->speak(
            $woman,
            'I have so much to say today.',
        );
    }
}
