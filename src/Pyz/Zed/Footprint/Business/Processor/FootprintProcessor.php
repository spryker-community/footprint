<?php declare(strict_types = 1);

namespace Pyz\Zed\Footprint\Business\Processor;

use Generated\Shared\Transfer\FootprintProcessorResultTransfer;
use Generated\Shared\Transfer\FootprintTemplateTransfer;

class FootprintProcessor implements FootprintProcessorInterface
{
    public function __construct(
        private readonly TemplatePathGeneratorInterface $templatePathGenerator,
        private readonly TemplateRenderInterface $templateRenderer,
    ) {
    }

    public function makeFromFootprint(
        FootprintTemplateTransfer $footprintTemplateTransfer
    ): FootprintProcessorResultTransfer {
        $paths = $this->templatePathGenerator->generateTemplatePaths($footprintTemplateTransfer);

        foreach ($paths as $path) {
            $renderedTemplate = $this->templateRenderer->renderTemplate($footprintTemplateTransfer, $path);

            $directoryPath = dirname($path->getTarget());

            if (!is_dir($directoryPath)) {
                mkdir($directoryPath);
            }

            file_put_contents($path->getTarget(), $renderedTemplate);
        }

        return (new FootprintProcessorResultTransfer())->setIsSuccessful(true);
    }
}
