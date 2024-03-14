<?php declare(strict_types = 1);

namespace Pyz\Zed\Footprint\Business\Processor;

use Generated\Shared\Transfer\FootprintProcessorResultTransfer;
use Generated\Shared\Transfer\FootprintTemplateTransfer;

interface FootprintProcessorInterface
{
    /**
     * @param \Generated\Shared\Transfer\FootprintTemplateTransfer $footprintTemplateTransfer
     *
     * @return \Generated\Shared\Transfer\FootprintProcessorResultTransfer
     */
    public function makeFromFootprint(
        FootprintTemplateTransfer $footprintTemplateTransfer
    ): FootprintProcessorResultTransfer;
}
