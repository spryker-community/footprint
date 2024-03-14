<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Footprint\Business\Processor;

use Generated\Shared\Transfer\FootprintTemplateTransfer;

interface TemplatePathGeneratorInterface
{
    /**
     * @param \Generated\Shared\Transfer\FootprintTemplateTransfer $footprintTemplateTransfer
     *
     * @return array
     */
    public function generateTemplatePaths(
        FootprintTemplateTransfer $footprintTemplateTransfer,
    ): array;
}
