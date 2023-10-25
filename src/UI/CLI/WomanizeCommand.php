<?php

namespace App\UI\CLI;

use App\Application\Workflow\WomanWorkflowInterface;
use Carbon\CarbonInterval;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Temporal\Api\Workflowservice\V1\WorkflowServiceClient;
use Temporal\Client\GRPC\ServiceClient;
use Temporal\Client\WorkflowClient;
use Temporal\Client\WorkflowOptions;

class WomanizeCommand extends Command
{
    protected static $defaultName        = 'app:womanize';
    protected static $defaultDescription = 'Start the Womanize Workflow';
    private WorkflowClient $workflowClient;

    public function __construct()
    {
        parent::__construct(self::$defaultName);

        $this->workflowClient = WorkflowClient::create(
            new ServiceClient(
                new WorkflowServiceClient('localhost:7233', [])
            )
        );
    }

    protected function configure(): void
    {
        $this->setDescription(self::$defaultDescription);
        $this->addArgument('name', InputArgument::REQUIRED, 'Your Woman Robot\'s name');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $workflow = $this->workflowClient->newWorkflowStub(
            class: WomanWorkflowInterface::class,
            options: WorkflowOptions::new()
                ->withWorkflowExecutionTimeout(CarbonInterval::minute())
        );

        $run = $this->workflowClient->start($workflow, 'Merry Poppins');

        $io->info('WorkflowID: ' . $run->getExecution()->getID());
        $io->success('You have created a new Woman Robot.');
        $io->writeln('She spoke the words: ' . $run->getResult());

        return Command::SUCCESS;
    }
}
