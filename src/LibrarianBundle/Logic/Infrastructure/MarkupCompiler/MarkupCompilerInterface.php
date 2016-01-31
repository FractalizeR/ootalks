<?php

namespace FractalizeR\LibrarianBundle\Logic\Infrastructure\MarkupCompiler;

/**
 * Interface for various markup compilers
 *
 * @package FractalizeR\LibrarianBundle\Logic\Infrastructure\MarkupCompiler
 */
interface MarkupCompilerInterface
{
    /**
     * @param string $code Code to be compiled
     *
     * @return $this
     * @throws MarkupCompilerException
     */
    public function setMarkup(string $code);

    /**
     * @return string The compiled HTML
     * @throws MarkupCompilerException
     */
    public function getContentsHtml() : string;

    /**
     * @return string The table of contents of the code that was compiled
     * @throws MarkupCompilerException
     */
    public function getTocHtml() : string;
}
