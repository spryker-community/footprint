<?php declare(strict_types = 1);

namespace Pyz\Zed\Footprint\Business;

use Generated\Shared\Transfer\FootprintProcessorResultTransfer;
use Generated\Shared\Transfer\FootprintTemplateTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\Footprint\Business\FootprintBusinessFactory getFactory()
 */
class FootprintFacade extends AbstractFacade implements FootprintFacadeInterface
{
    public function makeFromFootprint(FootprintTemplateTransfer $footprintTemplateTransfer): FootprintProcessorResultTransfer
    {
        return $this->getFactory()
            ->createFootprintProcessor()
            ->makeFromFootprint($footprintTemplateTransfer);
    }
}
