<?php

namespace FractalizeR\LibrarianBundle\Logic\Domain\Article\Entity;

use Doctrine\ORM\Mapping as ORM;
use FractalizeR\LibrarianBundle\Logic\Infrastructure\MarkupCompiler\MarkupCompilerException;
use FractalizeR\LibrarianBundle\Logic\Infrastructure\MarkupCompiler\MarkupCompilerFactory;
use FractalizeR\LibrarianBundle\Logic\Util\PropertyTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="FractalizeR\LibrarianBundle\Logic\Domain\Article\Repository\ArticleRepository")
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
     * @Assert\NotBlank()
     * @Assert\Length(min="10", max="400")
     * @var string
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Length(min="500")
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
    protected function getId() : int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    protected function getTitle() : string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    protected function getContents() : string
    {
        return $this->contents;
    }

    /**
     * @param string $contents
     *
     * @return $this
     * @throws MarkupCompilerException
     */
    public function setContents(string $contents)
    {

        $compiler = MarkupCompilerFactory::getCompiler()->setMarkup($contents);
        $contentsHtml = $compiler->getContentsHtml();

        $this->contents = $contents;
        $this->contentsCompiled = $contentsHtml;

        return $this;
    }

    /**
     * @return string
     */
    protected function getContentsCompiled() : string
    {
        return $this->contentsCompiled;
    }
}
