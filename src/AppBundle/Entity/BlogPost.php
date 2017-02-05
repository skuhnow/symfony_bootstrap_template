<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * BlogPost
 *
 * @ORM\Table(name="blog_post")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BlogPostRepository")
 * @Vich\Uploadable
 */
class BlogPost
{
    /**
     * @var int
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
     * @var bool
     *
     * @ORM\Column(name="draft", type="boolean")
     */
    private $draft = false;
    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="blogPosts")
     */
    private $category;

    /**
     * @var File
     * @Vich\UploadableField(mapping="upload_image", fileNameProperty="imageFilename")
     */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="image_filename", type="string", length=255, nullable=true)
     */
    private $imageFilename;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastchanged_at", type="datetime",  nullable=true)
     */
    private $lastchangedAt;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return BlogPost
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return BlogPost
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get draft
     *
     * @return bool
     */
    public function getDraft()
    {
        return $this->draft;
    }

    /**
     * Set draft
     *
     * @param boolean $draft
     *
     * @return BlogPost
     */
    public function setDraft($draft)
    {
        $this->draft = $draft;

        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory(Category $category)
    {
        $this->category = $category;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
     *
     * @return BlogPost
     */
    public function setImageFile(File $imageFile = null)
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            $this->setLastchangedAt(new \DateTime('now'));
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Get imageFilename
     *
     * @return string
     */
    public function getImageFilename()
    {
        return $this->imageFilename;
    }

    /**
     * Set imageFilename
     *
     * @param string $imageFilename
     *
     * @return BlogPost
     */
    public function setImageFilename($imageFilename)
    {
        $this->imageFilename = $imageFilename;

        return $this;
    }

    /**
     * Set lastchangedAt
     *
     * @param \DateTime $lastchangedAt
     *
     * @return BlogPost
     */
    public function setLastchangedAt($lastchangedAt)
    {
        $this->lastchangedAt = $lastchangedAt;

        return $this;
    }

    /**
     * Get lastchangedAt
     *
     * @return \DateTime
     */
    public function getLastchangedAt()
    {
        return $this->lastchangedAt;
    }
}

