<?php

namespace App\Command;

use App\MyLogger;
use App\Mysql;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SampleCommand extends Command
{
    public function __construct()
    {
        parent::__construct(true);
    }

    protected function configure(): void
    {
        $this
            ->setName('command:sample')
            ->setDescription('This is sample.')
            ->setHelp('This command allows you to create a user...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $mysql = new Mysql();
        try {
            $dbh = $mysql->ConnectDatabase(Mysql::TYPE_MASTER);
        } catch (Exception $e) {
            $logger = MyLogger::logger();
            $logger->error($e->getMessage());
            return Command::FAILURE;
        }
        return Command::SUCCESS;
    }
}