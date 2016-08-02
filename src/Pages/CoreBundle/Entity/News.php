<?php

namespace Pages\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="slider")
 * @ORM\Entity(repositoryClass="Pages\CoreBundle\Repository\NewsRepository")
 * @ORM\HasLifecycleCallbacks
 */
class News
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
     * @ORM\Column(name="slide_image", type="string", length=255)
     */
    private $slideImage;

    /**
     * @var string
     *
     * @ORM\Column(name="slide_titre", type="string", length=255)
     */
    private $slideTitre;

    /**
     * @var string
     *
     * @ORM\Column(name="slide_news", type="text")
     */
    private $slideNews;

    /**
     * @var \DateTime
     * 
     * @ORM\COlumn(name="updated_at",type="datetime", nullable=true) 
     */
    private $updateAt;
    
    /**
     * @ORM\PostLoad()
     */
    public function postLoad()
    {
        $this->updateAt = new \DateTime();
    }

    public $file;

    public function __construct()
    {
        $this->slideImage = '';
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
     * Set slideImage
     *
     * @param string $slideImage
     * @return News
     */
    public function setSlideImage($slideImage)
    {
        $this->slideImage = $slideImage;

        return $this;
    }

    /**
     * Set slideTitre
     *
     * @param string $slideTitre
     * @return News
     */
    public function setSlideTitre($slideTitre)
    {
        $this->slideTitre = $slideTitre;

        return $this;
    }

    /**
     * Set slideNews
     *
     * @param string $slideNews
     * @return News
     */
    public function setSlideNews($slideNews)
    {
        $this->slideNews = $slideNews;

        return $this;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return News
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getUploadRootDir()
    {
        return __dir__.'/../../../../web/media/slider';
    }
    
    public function getAbsolutePath()
    {
        return null === $this->slideImage ? null : $this->getUploadRootDir().'/'.$this->slideImage;
    }
    
    public function getAssetPath()
    {
        return 'media/slider/'.$this->slideImage;
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate() 
     */
    public function preUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->getSlideImage();
        $this->updateAt = new \DateTime();
        
        if (null !== $this->file) 
            $this->slideImage = sha1(uniqid(mt_rand(),true)).'.'.$this->file->guessExtension();
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate() 
     */
    public function upload()
    {
        if (null !== $this->file) {
            $this->file->move($this->getUploadRootDir(),$this->slideImage);
            unset($this->file);
            
            if ($this->oldFile != null) unlink($this->tempFile);
        }
    }
    
    /**
     * @ORM\PreRemove() 
     */
    public function preRemoveUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
    }
    
    /**
     * @ORM\PostRemove() 
     */
    public function removeUpload()
    {
        if (file_exists($this->tempFile)) unlink($this->tempFile);
    }

    /**
     * Get slideImage
     *
     * @return string 
     */
    public function getSlideImage()
    {
        return $this->slideImage;
    }

    /**
     * Get slideTitre
     *
     * @return string 
     */
    public function getSlideTitre()
    {
        return $this->slideTitre;
    }

    /**
     * Get slideNews
     *
     * @return string 
     */
    public function getSlideNews()
    {
        return $this->slideNews;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime 
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }
}