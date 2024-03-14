<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Footprint\Business;

use Pyz\Zed\Footprint\Business\Processor\FootprintProcessor;
use Pyz\Zed\Footprint\Business\Processor\FootprintProcessorInterface;
use Pyz\Zed\Footprint\Business\Processor\TemplatePathGenerator;
use Pyz\Zed\Footprint\Business\Processor\TemplatePathGeneratorInterface;
use Pyz\Zed\Footprint\Business\Processor\TemplateRenderer;
use Pyz\Zed\Footprint\Business\Processor\TemplateRenderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\Footprint\FootprintConfig getConfig()
 */
class FootprintBusinessFactory extends AbstractBusinessFactory
{
    public function createFootprintProcessor(): FootprintProcessorInterface
    {
        return new FootprintProcessor(
            $this->createTemplatePathGenerator(),
            $this->createTemplateRenderer()
        );
    }

    private function createTemplateRenderer(): TemplateRenderInterface
    {
        return new TemplateRenderer();
    }

    /**
     * @return \Pyz\Zed\Footprint\Business\Processor\TemplatePathGenerator
     */
    public function createTemplatePathGenerator(): TemplatePathGenerator
    {
        return new TemplatePathGenerator($this->getConfig());
    }
}
