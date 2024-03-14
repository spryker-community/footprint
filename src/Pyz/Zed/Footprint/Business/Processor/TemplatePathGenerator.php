<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Footprint\Business\Processor;

use ArrayObject;
use Generated\Shared\Transfer\FootprintTemplatePathTransfer;
use Generated\Shared\Transfer\FootprintTemplateTransfer;
use Pyz\Zed\Footprint\FootprintConfig;

class TemplatePathGenerator implements TemplatePathGeneratorInterface
{
    /**
     * @param \Pyz\Zed\Footprint\FootprintConfig $footprintConfig
     */
    public function __construct(protected readonly FootprintConfig $footprintConfig)
    {
    }

    /**
     * @inheritDoc
     */
    public function generateTemplatePaths(FootprintTemplateTransfer $footprintTemplateTransfer): array
    {
        $templateRoot = $this->footprintConfig->getFootprintTemplatePath();

        $templateDirectoryPaths = $this->getFilePaths(
            $templateRoot . '/' . $footprintTemplateTransfer->getTemplateName(),
        );

        $footprintTemplatePaths = [];

        $footprintTemplateOptions = $footprintTemplateTransfer->getOptions();

        foreach ($templateDirectoryPaths as $path) {
            $footprintTemplatePathTransfer = new FootprintTemplatePathTransfer();

            $targetFilePath = $this->getTargetFilePath(
                $path,
                $footprintTemplateOptions,
                $footprintTemplateTransfer->getTemplateName(),
            );

            if ($targetFilePath === '') {
                continue;
            }

            $targetFilePath = str_replace(
                $footprintTemplateTransfer->getTemplateName(),
                $footprintTemplateTransfer->getModuleName(),
                $targetFilePath,
            );

            $footprintTemplatePathTransfer->setOrigin($path);
            $footprintTemplatePathTransfer->setTarget($targetFilePath);

            $footprintTemplatePaths[] = $footprintTemplatePathTransfer;
        }

        return $footprintTemplatePaths;
    }

    /**
     * @param string $path
     * @param \ArrayObject $footprintTemplateOptions
     * @param string $templateName
     *
     * @return string
     */
    protected function getTargetFilePath(
        string $path,
        ArrayObject $footprintTemplateOptions,
        string $templateName,
    ): string {
        $targetPath = '';

        if(str_contains($path, "config.yaml") )
        {
            return "";
        }
        foreach ($footprintTemplateOptions as $footprintOption) {
            $isTargetPathEffectedByOptions = false;
            if (str_contains($path, $footprintOption->getName())) {
                $isTargetPathEffectedByOptions = true;
                if ($footprintOption->getIsApplicable()) {
                    $targetPath = str_replace(
                        DIRECTORY_SEPARATOR . $footprintOption->getName() . DIRECTORY_SEPARATOR,
                        DIRECTORY_SEPARATOR,
                        $path,
                    );
                    $targetPath = $this->replaceDirectoryInTargetPath($targetPath, $templateName);
                }
            }
        }
        if(!$isTargetPathEffectedByOptions)
        {
            return $this->replaceDirectoryInTargetPath($path, $templateName);
        }

        return $targetPath;
    }

    /**
     * @param string $path
     * @param string $templateName
     *
     * @return array<string>|string
     */
    protected function replaceDirectoryInTargetPath(string $path, string $templateName): array|string
    {
        $pathToSearch = $this->footprintConfig->getFootprintTemplatePath() . DIRECTORY_SEPARATOR . $templateName;

        return str_replace($pathToSearch, $this->footprintConfig->getFootprintNamespaceDirectoryPath(), $path);
    }

    /**
     * @param $dir
     *
     * @return array
     */
    protected function getFilePaths($dir): array
    {
        $paths = [];
        if (is_dir($dir) && is_readable($dir)) {
            $files = scandir($dir);
            unset($files[0], $files[1]);

            foreach ($files as $file) {
                $filePath = realpath($dir . DIRECTORY_SEPARATOR . $file);

                // Check if it's a file (avoid following symlinks)
                if (is_file($filePath) && !is_link($filePath)) {
                    $paths[] = $filePath; // Add file path to the array
                } elseif (is_dir($filePath) && !is_link($filePath)) {
                    $paths = array_merge($paths, $this->getFilePaths($filePath));
                }
            }
        }

        return $paths;
    }
}
