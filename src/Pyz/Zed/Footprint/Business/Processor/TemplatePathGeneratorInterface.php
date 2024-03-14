<?php declare(strict_types = 1);

namespace Pyz\Zed\Footprint\Business\Processor;

use Generated\Shared\Transfer\FootprintTemplateTransfer;

interface TemplatePathGeneratorInterface
{
    /**
     * @return array<\Generated\Shared\Transfer\FootprintTemplatePathTransfer>
     */
    public function generateTemplatePaths(
        FootprintTemplateTransfer $footprintTemplateTransfer
    ): array;
}
