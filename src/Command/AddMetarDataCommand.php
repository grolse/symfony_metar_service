<?php

namespace App\Command;

use App\Service\MetarServiceInterface;
use MetarDecoder\MetarDecoder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AddMetarDataCommand extends Command
{
    protected static $defaultName = 'add:metar:data';

    private $metarService;

    public function __construct(MetarServiceInterface $metarService, string $name = null)
    {
        $this->metarService = $metarService;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription('Add and parse new raw METAR data')
            ->addArgument('metar', InputArgument::OPTIONAL, 'METAR string')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $metar = $input->getArgument('metar');

        $decoder = new MetarDecoder();
        $weather = $decoder->parse($metar);

        if (!$weather->isValid()) {
            $io->error('METAR is invalid');
            return 1;
        }
        $this->metarService->addWeather($weather);
        $io->success('METAR was parsed and stored.');

        return 0;
    }
}
