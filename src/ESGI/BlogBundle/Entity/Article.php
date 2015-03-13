<?php

namespace ESGI\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ESGI\BlogBundle\Entity\ArticleRepository")
 * @ExclusionPolicy("all")
 */
class Article
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Expose
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     * @Expose
     */
    private $body;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isPublished", type="boolean")
     * @Expose
     */
    private $isPublished;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created", type="datetime")
     * @Expose
     */
    private $created;

    /**
     * @ORM\Column(name="updated", type="datetime")
     * @Gedmo\Timestampable(on="update")
     * @Expose
     */
    private $updated;

    /**
     * @ORM\ManyToOne(targetEntity="ESGI\UserBundle\Entity\User", cascade={"persist"}, inversedBy="articles")
     * @ORM\JoinColumn(nullable=true)
     * @Expose
     */
    private $user;

    /**
     * @var Image
     * @ORM\ManyToOne(targetEntity="ESGI\BlogBundle\Entity\Image", cascade={"persist", "remove"}, inversedBy="articles")
     * @Assert\Valid()
     * @Expose
     */
    private $image;

    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="ESGI\BlogBundle\Entity\Category", cascade={"persist"}, inversedBy="articles")
     * @Expose
     */
    private $category;

    /**
     * @Gedmo\Slug(fields={"title"}, updatable=false, separator="-")
     * @ORM\Column(name="slug", length=255, type="string")
     */
    private $slug;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isCommented", type="boolean")
     * @Expose
     */
    private $isCommented;

    /**
     * @ORM\OneToMany(targetEntity="ESGI\BlogBundle\Entity\Comment", cascade={"persist", "remove"}, mappedBy="article")
     * @Expose
     */
    private $comments;

    public function __construct()
    {
        $this->dateUpdate = new \Datetime();
        $this->isPublished = true;
        $this->isCommented = true;
    }


    /**
     * Get id
     *
     * @return integer
     * @VirtualProperty
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     * @VirtualProperty
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Article
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     * @VirtualProperty
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set isPublished
     *
     * @param boolean $isPublished
     * @return Article
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * Get isPublished
     *
     * @return boolean
     * @VirtualProperty
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * Set image
     *
     * @param \ESGI\BlogBundle\Entity\Image $image
     * @return Article
     */
    public function setImage(\ESGI\BlogBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \ESGI\BlogBundle\Entity\Image
     * @VirtualProperty
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set category
     *
     * @param \ESGI\BlogBundle\Entity\Category $category
     * @return Category
     */
    public function setCategory(\ESGI\BlogBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \ESGI\BlogBundle\Entity\Category
     * @VirtualProperty
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Article
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Article
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     * @VirtualProperty
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Article
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     * @VirtualProperty
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set user
     *
     * @param \ESGI\UserBundle\Entity\User $user
     * @return Article
     */
    public function setUser(\ESGI\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \ESGI\UserBundle\Entity\User
     * @VirtualProperty
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set isCommented
     *
     * @param boolean $isCommented
     * @return Article
     */
    public function setIsCommented($isCommented)
    {
        $this->isCommented = $isCommented;

        return $this;
    }

    /**
     * Get isCommented
     *
     * @return boolean
     * @VirtualProperty
     */
    public function getIsCommented()
    {
        return $this->isCommented;
    }

    /**
     * Add comments
     *
     * @param \ESGI\BlogBundle\Entity\Comment $comments
     * @return Article
     */
    public function addComment(\ESGI\BlogBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \ESGI\BlogBundle\Entity\Comment $comments
     */
    public function removeComment(\ESGI\BlogBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     * @VirtualProperty
     */
    public function getComments()
    {
        return $this->comments;
    }
}
