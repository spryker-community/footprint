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
 * @method \Pyz\Zed\Footprint\Communication\FootprintCommunicationFactory getFactory()
 */
class FootprintConsole extends Console
{
    public const COMMAND_NAME = 'footprint:make:module';

    public const DESCRIPTION = 'Generates module by footprint template';

    public const ARGUMENT_MODULE = 'module';

    public const ARGUMENT_TEMPLATE = 'template';

    protected const SUCCESS_MESSAGE = 'New module has been created based.';

    protected const ERROR_MESSAGE = 'Cannot create module.';

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName(static::COMMAND_NAME);
        $this->setDescription(static::DESCRIPTION);
        $this->addArgument(static::ARGUMENT_TEMPLATE, InputArgument::REQUIRED, 'Template base of which module is generated');
        $this->addArgument(static::ARGUMENT_MODULE, InputArgument::REQUIRED, 'Module name to generate based on template');

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $templateTransfer = $this->createFootprintTemplateTransfer($input, $output);
        $resultTransfer = $this->getFacade()->makeFromFootprint($templateTransfer);

        if (!$resultTransfer->getIsSuccessful()) {
            $errorMessage = $resultTransfer->getErrorMessage() ?: static::ERROR_MESSAGE;
            $this->error($errorMessage);

            return static::CODE_ERROR;
        }

        $this->success(static::SUCCESS_MESSAGE);

        return static::CODE_SUCCESS;
    }

    protected function createFootprintTemplateTransfer(
        InputInterface $input,
        OutputInterface $output
    ): FootprintTemplateTransfer {
        $templateName = $input->getArgument(static::ARGUMENT_TEMPLATE);
        $moduleName = $input->getArgument(static::ARGUMENT_MODULE);

        $templateTransfer = (new FootprintTemplateTransfer())
            ->setTemplateName($templateName)
            ->setModuleName($moduleName);

        $optionTransfers = $this->getFactory()
            ->createTemplateConfigParser()
            ->parseConfig($templateName);

        foreach ($optionTransfers as $optionTransfer) {
            $isApplicable = $this->askConfirmation(
                $optionTransfer->getLabel()
            );

            $optionTransfer->setIsApplicable((bool)$isApplicable);

            $templateTransfer->addOption($optionTransfer);
        }

        return $templateTransfer;
    }
}
