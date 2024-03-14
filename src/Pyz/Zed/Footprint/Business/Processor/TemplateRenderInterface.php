<?php declare(strict_types = 1);

namespace Pyz\Zed\Footprint\Business\Processor;

use Generated\Shared\Transfer\FootprintTemplatePathTransfer;
use Generated\Shared\Transfer\FootprintTemplateTransfer;

interface TemplateRenderInterface
{
    public function renderTemplate(
        FootprintTemplateTransfer $footprintTemplateTransfer,
        FootprintTemplatePathTransfer $footprintTemplatePathTransfer,
    ): string;
}
