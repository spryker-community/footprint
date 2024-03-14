<?php declare(strict_types = 1);

namespace Pyz\Zed\Footprint\Communication\Console;

use Generated\Shared\Transfer\FootprintTemplatePathTransfer;
use Generated\Shared\Transfer\FootprintTemplateTransfer;
use Pyz\Zed\Footprint\Business\Processor\TemplateRenderer;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \Pyz\Zed\Footprint\Business\FootprintFacadeInterface getFacade()
 */
class FootprintConsole extends Console
{
    public const COMMAND_NAME = 'footprint:make:module';

    public const DESCRIPTION = 'Generates module by footprint template';

    public const ARGUMENT_NAME_MODULE = 'module';

    public const ARGUMENT_NAME_TEMPLATE = 'template';


    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName(static::COMMAND_NAME);
        $this->setDescription(static::DESCRIPTION);
        $this->addArgument(static::ARGUMENT_NAME_MODULE, InputArgument::REQUIRED, 'Module to generate based on template');
        $this->addArgument(static::ARGUMENT_NAME_TEMPLATE, InputArgument::REQUIRED, 'Template base of which module is generated');

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
//        $templatePathTransfer = new FootprintTemplatePathTransfer();
//        $templatePathTransfer->setOrigin(APPLICATION_ROOT_DIR . '/templates/Example/Glue/ExampleGlueApi/_default/ExampleRestApiConfig.php');
//
//        $templateTransfer = new FootprintTemplateTransfer();
//        $templateTransfer->setTemplateName($input->getArgument(static::ARGUMENT_NAME_TEMPLATE));
//        $templateTransfer->setModuleName($input->getArgument(static::ARGUMENT_NAME_TEMPLATE));
//
//        $templateRenderer = new TemplateRenderer();
//        $template = $templateRenderer->renderTemplate($templateTransfer, $templatePathTransfer);
//
//        var_dump($template);
//
//        return 0;

        $templateTransfer = new FootprintTemplateTransfer();
        $resultTransfer = $this->getFacade()->makeFromFootprint($templateTransfer);

        return $resultTransfer->getIsSuccessful() ? static::CODE_SUCCESS : static::CODE_ERROR;
    }
}
