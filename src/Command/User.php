<?php

declare(strict_types=1);

namespace App\Command;

use App\Repository\UserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class User extends Command
{
    public const OPTION_EMAIL = 'email';
    public const OPTION_PASSWORD = 'password';

    /** @var UserRepository */
    private $userRepository;

    public function __construct(
        UserRepository $userRepository,
        string $name = null
    ) {
        parent::__construct($name);
        $this->userRepository = $userRepository;
    }

    protected function configure()
    {
        $this
            ->addOption(self::OPTION_EMAIL, null, InputOption::VALUE_REQUIRED, 'user email addres')
            ->addOption(self::OPTION_PASSWORD, null, InputOption::VALUE_REQUIRED, 'user password')
            ->setName('data:user:add')
            ->setDescription('description')
            ->setHelp('help');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = $input->getOption(self::OPTION_EMAIL);
        $password = $input->getOption(self::OPTION_PASSWORD);

        $this->userRepository->add($email, $password);

        return 0;
    }
}
