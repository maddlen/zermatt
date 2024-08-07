<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Zermatt\Console\Command;

use Maddlen\Zermatt\App\Build as AppBuild;
use Maddlen\Zermatt\App\Install as AppInstall;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Build extends Command
{
    const TARGET_THEME_CODE = 'targetThemeCode';

    public function __construct(
        protected readonly AppBuild $build,
        ?string                     $name = null
    )
    {
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('zermatt:build');
        $this->setDescription('Build Zermatt frontend app in Zermatt-enabled themes.');
        $this->addArgument(self::TARGET_THEME_CODE, InputArgument::OPTIONAL, 'The theme code for which to build Zermatt. If ignored, all themes are built');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->build->themes($input->getArgument(self::TARGET_THEME_CODE));
        $output->writeln('<info>Builds were done in Zermatt-enabled themes.</info>');

        return Command::SUCCESS;
    }
}
