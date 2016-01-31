<?php

namespace FractalizeR\LibrarianBundle\Logic\Infrastructure\MarkupCompiler;

use Exception;
use Parsedown;

/**
 * Class ParseDownMarkupCompiler
 *
 * @package FractalizeR\LibrarianBundle\Logic\Infrastructure\MarkupCompiler\
 */
class ParseDownMarkupCompiler implements MarkupCompilerInterface
{
    /**
     * @var string Code to be compiled
     */
    private $markup;

    /**
     * @var string
     */
    private $contentsHtml;

    /**
     * @var string
     */
    private $tocHtml;

    /**
     * @param string $markup Code to be compiled
     *
     * @return $this
     */
    public function setMarkup(string $markup)
    {
        $this->markup = $markup;

        return $this;
    }

    /**
     * @return string
     * @throws MarkupCompilerException
     */
    public function getContentsHtml() : string
    {
        $this->assertHasMarkup();
        if (null == $this->contentsHtml) {
            $this->compile();
        }

        return $this->contentsHtml;
    }

    /**
     * @return string
     * @throws MarkupCompilerException
     */
    public function getTocHtml() : string
    {
        if (null == $this->tocHtml) {
            $this->compile();
        }

        return $this->tocHtml;
    }

    /**
     * Main compilation method
     *
     * @throws MarkupCompilerException
     */
    private function compile()
    {
        $markdownCompiler = new Parsedown();
        try {
            $this->contentsHtml = $markdownCompiler->parse($this->markup);
        } catch (Exception $e) {
            throw new MarkupCompilerException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * If we have markup to compile passed in
     *
     * @throws MarkupCompilerException
     */
    private function assertHasMarkup()
    {
        if (null === $this->markup) {
            throw new MarkupCompilerException("No markup to compile!");
        }
    }
}
