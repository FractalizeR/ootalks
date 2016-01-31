<?php

namespace FractalizeR\LibrarianBundle\Logic\Domain\Author\Entity;

use Doctrine\ORM\Mapping as ORM;
use FractalizeR\LibrarianBundle\Logic\Infrastructure\MarkupCompiler\MarkupCompilerFactory;
use FractalizeR\LibrarianBundle\Logic\Util\PropertyTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="FractalizeR\LibrarianBundle\Logic\Domain\Author\Repository\AuthorRepository")
 * @ORM\Table(schema="article")
 * @package FractalizeR\Librarian\Logic\Article\Model
 * @property-read int    $id
 * @property string      $firstName
 * @property string      $lastName
 * @property-read string $title
 * @property string      $shortBio
 * @property string      $longBio
 * @property string      $longBioCompiled
 */
class Author
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
     * @ORM\Column(type="string")
     * @Assert\Length(min="2", max="200")
     * @var string
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(min="2", max="200")
     * @var string
     */
    protected $lastName;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(min="12", max="500")
     * @var string
     */
    protected $www;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(min="12", max="500")
     * @var string
     */
    protected $shortBio;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(min="200")
     * @var string
     */
    protected $longBio;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(min="200")
     * @var string
     */
    protected $longBioCompiled;

    /**
     * Author constructor.
     *
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct($firstName, $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return Author
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return Author
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getTitle()
    {
        return $this->firstName.' '.$this->lastName;
    }

    /**
     * @return string
     */
    public function getWww()
    {
        return $this->www;
    }

    /**
     * @param string $www
     *
     * @return Author
     */
    public function setWww($www)
    {
        $this->www = $www;

        return $this;
    }

    /**
     * @return string
     */
    public function getShortBio()
    {
        return $this->shortBio;
    }

    /**
     * @param string $shortBio
     *
     * @return Author
     */
    public function setShortBio($shortBio)
    {
        $this->shortBio = $shortBio;

        return $this;
    }

    /**
     * @return string
     */
    public function getLongBio()
    {
        return $this->longBio;
    }

    /**
     * @param string $longBio
     *
     * @return Author
     */
    public function setLongBio($longBio)
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
    public function getLongBioCompiled()
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
