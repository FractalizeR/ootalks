<?php

namespace FractalizeR\LibrarianBundle\Logic\Article\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use FractalizeR\LibrarianBundle\LibrarianBundle\Logic\Article\Exception\ArticleMarkdownException;
use FractalizeR\LibrarianBundle\Logic\Util\PropertyTrait;
use Parsedown;

/**
 * @ORM\Entity
 * @ORM\Table(schema="article")
 * @package FractalizeR\Librarian\Logic\Article\Model
 * @property-read int $id
 * @property string   $title
 * @property string   $contents
 * @property-read int $contentsCompiled
 */
class Article
{
    use PropertyTrait;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $contents;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $contentsCompiled;

    /**
     * Article constructor.
     *
     * @param string $title
     * @param string $contents
     */
    public function __construct($title, $contents)
    {
        $this->setTitle($title);
        $this->setContents($contents);
    }

    /**
     * @return int
     */
    protected function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    protected function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    protected function getContents()
    {
        return $this->contents;
    }

    /**
     * @return string
     */
    protected function getContentsCompiled()
    {
        return $this->contentsCompiled;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param string $contents
     */
    public function setContents($contents)
    {
        $markdownCompiler = new Parsedown();
        try {
            $html = $markdownCompiler->parse($contents);
        } catch (Exception $e) {
            throw new ArticleMarkdownException($e->getMessage(), $e->getCode(), $e);
        }

        $this->contents = $contents;
        $this->contentsCompiled = $html;
    }
}
