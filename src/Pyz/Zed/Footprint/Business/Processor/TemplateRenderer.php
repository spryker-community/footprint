<?php

namespace Pyz\Zed\Footprint\Business\Processor;

use Generated\Shared\Transfer\FootprintTemplatePathTransfer;
use Generated\Shared\Transfer\FootprintTemplateTransfer;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\Printer;
use PhpParser\Lexer\Emulative;
use PhpParser\NodeDumper;
use PhpParser\ParserFactory;

class TemplateRenderer implements TemplateRenderInterface
{
    const TEMPLATE_MODULE_NAME = 'Example';

    public function renderTemplate(
        FootprintTemplateTransfer $footprintTemplateTransfer,
        FootprintTemplatePathTransfer $footprintTemplatePathTransfer,
    ): string {
        $originPath = $footprintTemplatePathTransfer->getOrigin();

        var_dump($originPath);

        $templateContents = file_get_contents($originPath);

        if (!$templateContents) {
            throw new \InvalidArgumentException('Invalid path ' . $originPath);
        }

        if (strpos($originPath, '.php') === false) {
            return $templateContents;
        }

        $templateContents = str_replace(self::TEMPLATE_MODULE_NAME, $footprintTemplateTransfer->getModuleName(), $templateContents);

        $file = PhpFile::fromCode($templateContents);

        foreach ($file->getClasses() as $class) {
            foreach ($class->getMethods() as $method) {
                $skipMethod = false;

                if ($method->getComment() && strpos($method->getComment(), '@_') !== false) {
                    $commentLines = explode("\n", $method->getComment());
                    $firstCommentLine = $commentLines[0];

                    foreach ($footprintTemplateTransfer->getOptions() as $optionTransfer) {
                        if ('@' . $optionTransfer->getName() === $firstCommentLine && !$optionTransfer->getIsApplicable()) {
                            $class->removeMethod($method->getName());

                            $skipMethod = true;

                            break;
                        }
                    }
                }

                if ($skipMethod) {
                    continue;
                }

                $linesToIgnore = [];

                $body = $method->getBody();

                $code = <<<PHP
                    <?php 
                    
                    $body
                PHP;

                $lexer = new Emulative();
                $parser = (new ParserFactory())->create(1, $lexer);

                $ast = $parser->parse($code);

                foreach ($lexer->getTokens() as $token) {
                    if (!is_array($token)) {
                        continue;
                    }

                    if (!str_starts_with($token[1], '/**')) {
                        continue;
                    }

                    $option = trim(str_replace(['/**', '*/'], '', $token[1]));

                    foreach ($footprintTemplateTransfer->getOptions() as $optionTransfer) {
                        if ('@' . $optionTransfer->getName() === $option && !$optionTransfer->getIsApplicable()) {
                            $linesToIgnore[] = $token[2] - 2;
                        }
                    }
                }

                $lines = explode("\n", $body);

                foreach ($lines as $index => $line) {
                    $lineNumber = $index + 1;

                    if (in_array($lineNumber, $linesToIgnore)) {
                        unset($lines[$index]);
                    }
                }

                $newBody = implode("\n", $lines);

                $method->setBody($newBody);
            }
        }

        $printer = new Printer();

        $fileContents = $printer->printFile($file);

        return $fileContents;
    }
}