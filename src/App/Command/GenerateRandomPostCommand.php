<?php

namespace App\Command;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Post\PostManager;
use joshtronic\LoremIpsum;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GenerateRandomPostCommand extends Command
{
    protected static $defaultName = 'app:generate-random-post';
    protected static $defaultDescription = 'Run app:generate-random-post';

    private PostManager $postManager;
    private LoremIpsum $loremIpsum;

    public function __construct(PostManager $postManager, LoremIpsum $loremIpsum, string $name = null)
    {
        $this->postManager = $postManager;
        $this->loremIpsum = $loremIpsum;
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->addOption(
            'summary',
            null,
            InputOption::VALUE_OPTIONAL,
            'Set =1, if title has to have: Summary YYYY-MM-DD',
            false
        );
        $this->addOption(
            'paragraphs',
            null,
            InputOption::VALUE_OPTIONAL,
            'Number of generated paragraphs. Default: 2',
            2
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $title = $input->getOption('summary') ?
            sprintf("Summary %s", date('Y-m-d')) :
            $this->loremIpsum->words(mt_rand(4, 6));

        $content = $this->loremIpsum->paragraphs($input->getOption('paragraphs'));

        $this->postManager->addPost($title, $content);

        $output->writeln('A random post has been generated.');

        return Command::SUCCESS;
    }
}
