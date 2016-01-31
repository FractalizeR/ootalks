<?php

namespace FractalizeR\LibrarianBundle\Logic\Infrastructure\MarkupCompiler;

/**
 * Class MarkupCompilerFactory
 *
 * @package FractalizeR\LibrarianBundle\Logic\Infrastructure\MarkupCompiler
 */
class MarkupCompilerFactory
{
    /**
     * @return MarkupCompilerInterface
     */
    public static function getCompiler(): MarkupCompilerInterface
    {
        return new ParseDownMarkupCompiler();
    }
}
