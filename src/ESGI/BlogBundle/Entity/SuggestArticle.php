<?php

namespace ESGI\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SuggestArticle.
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="ESGI\BlogBundle\Entity\SuggestArticleRepository")
 */
class SuggestArticle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="ESGI\BlogBundle\Entity\Category", cascade={"persist"}, inversedBy="articles")
     */
    private $category;

    /**
     * Get id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body.
     *
     * @param string $body
     *
     * @return Article
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body.
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set category.
     *
     * @param \ESGI\BlogBundle\Entity\Category $category
     *
     * @return Category
     */
    public function setCategory(Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category.
     *
     * @return \ESGI\BlogBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
