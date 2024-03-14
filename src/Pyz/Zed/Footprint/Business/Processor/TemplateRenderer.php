<?php

namespace Pyz\Zed\Footprint\Business\Processor;

use Generated\Shared\Transfer\FootprintTemplatePathTransfer;
use Generated\Shared\Transfer\FootprintTemplateTransfer;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\Printer;

class TemplateRenderer implements TemplateRenderInterface
{
    const TEMPLATE_MODULE_NAME = 'Example';

    public function renderTemplate(
        FootprintTemplateTransfer $footprintTemplateTransfer,
        FootprintTemplatePathTransfer $footprintTemplatePathTransfer,
    ): string {
        $originPath = $footprintTemplatePathTransfer->getOrigin();

        $templateContents = file_get_contents($originPath);

        if (!$templateContents) {
            throw new \InvalidArgumentException('Invalid path ' . $originPath);
        }

        $templateContents = str_replace(self::TEMPLATE_MODULE_NAME, $footprintTemplateTransfer->getModuleName(), $templateContents);

        $file = PhpFile::fromCode($templateContents);

        // later some manipulations with file are possible

        $printer = new Printer();

        $fileContents = $printer->printFile($file);

        return $fileContents;
    }
}