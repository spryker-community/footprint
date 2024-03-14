<?php declare(strict_types = 1);

namespace Pyz\Zed\Footprint\Business;

use Generated\Shared\Transfer\FootprintProcessorResultTransfer;
use Generated\Shared\Transfer\FootprintTemplateTransfer;

interface FootprintFacadeInterface
{
    /**
     * Specification:
     * - Generates module by footprint template
     */
    public function makeFromFootprint(
        FootprintTemplateTransfer $footprintTemplateTransfer
    ): FootprintProcessorResultTransfer;
}
