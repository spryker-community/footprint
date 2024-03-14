<?php

namespace Pyz\Zed\Footprint\Business\Processor;

use Generated\Shared\Transfer\FootprintTemplatePathTransfer;
use Generated\Shared\Transfer\FootprintTemplateTransfer;

class TemplatePathGenerator implements TemplatePathGeneratorInterface
{
    public function generateTemplatePaths(FootprintTemplateTransfer $footprintTemplateTransfer): array
    {
        return [
            (new FootprintTemplatePathTransfer())
                ->setOrigin(APPLICATION_ROOT_DIR . '/templates/Example/Glue/ExampleGlueApi/_default/ExampleRestApiConfig.php')
                ->setTarget(APPLICATION_ROOT_DIR . '/src/Pyz/Glue/MyModuleGlueApi/MyModuleRestApiConfig.php'),
        ];
    }
}