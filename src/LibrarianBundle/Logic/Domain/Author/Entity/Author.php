<?php

namespace FractalizeR\LibrarianBundle\Logic\Domain\Author\Entity;

use Doctrine\ORM\Mapping as ORM;
use FractalizeR\LibrarianBundle\Logic\Infrastructure\MarkupCompiler\MarkupCompilerFactory;
use FractalizeR\LibrarianBundle\Logic\Util\PropertyTrait;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="FractalizeR\LibrarianBundle\Logic\Domain\Author\Repository\AuthorRepository")
 * @ORM\Table(schema="article", indexes={@ORM\Index(columns={"full_name"})})
 * @package FractalizeR\Librarian\Logic\Article\Model
 * @property-read int $id
 * @property string   $www
 * @property string   $fullName
 * @property string   $shortBio
 * @property string   $longBio
 * @property string   $longBioCompiled
 */
class Author
{
    use PropertyTrait;

    /**
     * @Groups({"list", "item"})
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @Groups({"list", "item"})
     * @ORM\Column(type="string", options={"comment": "The full name of the author"})
     * @Assert\Length(min="2", max="200")
     * @var string
     */
    protected $fullName;

    /**
     * @Groups({"list", "item"})
     * @ORM\Column(type="text", nullable=true, options={"comment":"Personal website of the author"})
     * @Assert\Length(min="12", max="500")
     * @var string
     */
    protected $www;

    /**
     * @Groups({"list", "item"})
     * @ORM\Column(type="text", nullable=true, options={"comment": "Plaintext one-sentence bio of the author"})
     * @Assert\Length(min="12", max="500")
     * @var string
     */
    protected $shortBio;

    /**
     * @Groups({"item"})
     * @ORM\Column(type="text", nullable=true, options={"comment": "Rich and long author bio"})
     * @Assert\Length(min="200")
     * @var string
     */
    protected $longBio;

    /**
     * @Groups({"item"})
     * @ORM\Column(type="text", nullable=true, options={"comment": "Compiled markup of the long author's bio"})
     * @Assert\Length(min="200")
     * @var string
     */
    protected $longBioCompiled;

    /**
     * Author constructor.
     *
     * @param $fullName
     */
    public function __construct($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    protected function getWww()
    {
        return $this->www;
    }

    /**
     * @param string $www

     *
*@return Author
     */
    protected function setWww($www)
    {
        $this->www = $www;

        return $this;
    }

    /**
     * @return string
     */
    protected function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    protected function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    protected function getShortBio()
    {
        return $this->shortBio;
    }

    /**
     * @param string $shortBio
     *
     * @return Author
     */
    protected function setShortBio($shortBio)
    {
        $this->shortBio = $shortBio;

        return $this;
    }

    /**
     * @return string
     */
    protected function getLongBio()
    {
        return $this->longBio;
    }

    /**
     * @param string $longBio
     *
     * @return Author
     */
    protected function setLongBio($longBio)
    {
        $compiler = MarkupCompilerFactory::getCompiler()->setMarkup($longBio);
        $contentsHtml = $compiler->getContentsHtml();

        $this->longBio = $longBio;
        $this->longBioCompiled = $contentsHtml;

        return $this;
    }

    /**
     * @return string
     */
    protected function getLongBioCompiled()
    {
        return $this->longBioCompiled;
    }

    /**
     * @return int
     */
    protected function getId() : int
    {
        return $this->id;
    }
}
