<?php

namespace ESGI\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category.
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ESGI\BlogBundle\Entity\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var Articles
     * @ORM\OneToMany(targetEntity="ESGI\BlogBundle\Entity\Article", cascade={"persist"}, mappedBy="category")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id", nullable=false)
     */
    private $articles;

    /**
     * @ORM\ManyToOne(targetEntity="ESGI\UserBundle\Entity\User", cascade={"persist"}, inversedBy="categories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

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
     * Set name.
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add articles.
     *
     * @param \ESGI\BlogBundle\Entity\Article $articles
     *
     * @return Category
     */
    public function addArticle(\ESGI\BlogBundle\Entity\Article $articles)
    {
        $this->articles[] = $articles;

        return $this;
    }

    /**
     * Remove articles.
     *
     * @param \ESGI\BlogBundle\Entity\Article $articles
     */
    public function removeArticle(\ESGI\BlogBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Set user.
     *
     * @param \ESGI\UserBundle\Entity\User $user
     *
     * @return Category
     */
    public function setUser(\ESGI\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \ESGI\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
