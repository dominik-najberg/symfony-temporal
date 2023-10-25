<?php

namespace App\Application\Workflow;

use Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[WorkflowInterface]
interface WomanWorkflowInterface
{
    /**
     * @param string $name
     * @return string
     */
    #[WorkflowMethod(name: "SimpleActivity.womanize")]
    public function womanize(
        string $name
    );
}
