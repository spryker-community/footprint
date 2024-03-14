<?php declare(strict_types = 1);

namespace Pyz\Zed\Footprint\Business\Config;

interface TemplateConfigParserInterface
{
    /**
     * @throws \Pyz\Zed\Footprint\Business\Exception\ConfigParserException
     *
     * @return array<\Generated\Shared\Transfer\FootprintOptionTransfer>
     */
    public function parseConfig(string $templateName): array;
}
