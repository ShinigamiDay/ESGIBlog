<?php

namespace ESGI\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * User
 *
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected  $id;

    /**
     * @var Article
     * @ORM\OneToMany(targetEntity="ESGI\BlogBundle\Entity\Article", mappedBy="user")
     */
    private $articles;

    /**
     * @var Category
     * @ORM\ManyToMany(targetEntity="ESGI\BlogBundle\Entity\Category", mappedBy="user")
     */
    private $categories;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add articles
     *
     * @param \ESGI\BlogBundle\Entity\Article $articles
     * @return User
     */
    public function addArticle(\ESGI\BlogBundle\Entity\Article $articles)
    {
        $this->articles[] = $articles;

        return $this;
    }

    /**
     * Remove articles
     *
     * @param \ESGI\BlogBundle\Entity\Article $articles
     */
    public function removeArticle(\ESGI\BlogBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Add categories
     *
     * @param \ESGI\BlogBundle\Entity\Category $categories
     * @return User
     */
    public function addCategory(\ESGI\BlogBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \ESGI\BlogBundle\Entity\Category $categories
     */
    public function removeCategory(\ESGI\BlogBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
