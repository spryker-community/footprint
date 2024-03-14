<?php declare(strict_types = 1);

namespace Pyz\Zed\Footprint\Business\Processor;

use Generated\Shared\Transfer\FootprintProcessorResultTransfer;
use Generated\Shared\Transfer\FootprintTemplateTransfer;

interface FootprintProcessorInterface
{
    public function makeFromFootprint(
        FootprintTemplateTransfer $footprintTemplateTransfer
    ): FootprintProcessorResultTransfer;
}
