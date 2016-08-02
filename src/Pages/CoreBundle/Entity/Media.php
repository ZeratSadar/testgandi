<?php

namespace Pages\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Media
 *
 * @ORM\Table(name="medias")
 * @ORM\Entity(repositoryClass="Pages\CoreBundle\Repository\MediaRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Media
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
     * @ORM\Column(name="media_titre", type="string", length=255)
     */
    private $mediaTitre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dates", type="datetime")
     */
    private $dates;

    /**
     * @var string
     *
     * @ORM\Column(name="media_describ", type="text")
     */
    private $mediaDescrib;

    /**
     * @var string
     *
     * @ORM\Column(name="media_file", type="string", length=255)
     */
    private $mediaFile;

    /**
     * @var string
     *
     * @ORM\Column(name="media_img", type="string", length=255)
     */
    private $mediaImg;

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

    public $fili;

    public function __construct()
    {
        $this->mediaFile = '';
        $this->mediaImg = '';
    }

    /**
     * Set mediaTitre
     *
     * @param string $mediaTitre
     *
     * @return Media
     */
    public function setMediaTitre($mediaTitre)
    {
        $this->mediaTitre = $mediaTitre;

        return $this;
    }

    /**
     * Set dates
     *
     * @param \DateTime $dates
     *
     * @return Media
     */
    public function setDates($dates)
    {
        $this->dates = $dates;

        return $this;
    }

    /**
     * Set mediaDescrib
     *
     * @param string $mediaDescrib
     *
     * @return Media
     */
    public function setMediaDescrib($mediaDescrib)
    {
        $this->mediaDescrib = $mediaDescrib;

        return $this;
    }

    /**
     * Set mediaFile
     *
     * @param string $mediaFile
     *
     * @return Media
     */
    public function setMediaFile($mediaFile)
    {
        $this->mediaFile = $mediaFile;

        return $this;
    }

    /**
     * Set mediaImg
     *
     * @param string $mediaImg
     *
     * @return Media
     */
    public function setMediaImg($mediaImg)
    {
        $this->mediaImg = $mediaImg;

        return $this;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return Media
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getUploadRootDir()
    {
        return __dir__.'/../../../../web/media/media';
    }
    
    public function getAbsolutePath()
    {
        return null === $this->mediaFile ? null : $this->getUploadRootDir().'/'.$this->mediaFile;
    }
    
    public function getAssetPath()
    {
        return 'media/media/'.$this->mediaFile;
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate() 
     */
    public function preUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->getmediaFile();
        $this->updateAt = new \DateTime();
        
        if (null !== $this->file) 
            $this->mediaFile = sha1(uniqid(mt_rand(),true)).'.'.$this->file->guessExtension();
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate() 
     */
    public function upload()
    {
        if (null !== $this->file) {
            $this->file->move($this->getUploadRootDir(),$this->mediaFile);
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

    public function getAbsolutePathI()
    {
        return null === $this->mediaImg ? null : $this->getUploadRootDir().'/'.$this->mediaImg;
    }
    
    public function getAssetPathI()
    {
        return 'media/infog/'.$this->mediaImg;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate() 
     */
    public function preUploadI()
    {
        $this->tempFili = $this->getAbsolutePathI();
        $this->oldFili = $this->getmediaImg();
        $this->updateAt = new \DateTime();
        
        if (null !== $this->fili) 
            $this->mediaImg = sha1(uniqid(mt_rand(),true)).'.'.$this->fili->guessExtension();
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate() 
     */
    public function uploadI()
    {
        if (null !== $this->fili) {
            $this->fili->move($this->getUploadRootDir(),$this->mediaImg);
            unset($this->fili);
            
            if ($this->oldFili != null) unlink($this->tempFili);
        }
    }
    
    /**
     * @ORM\PreRemove() 
     */
    public function preRemoveUploadI()
    {
        $this->tempFili = $this->getAbsolutePathI();
    }
    
    /**
     * @ORM\PostRemove() 
     */
    public function removeUploadI()
    {
        if (file_exists($this->tempFili)) unlink($this->tempFili);
    }

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
     * Get mediaTitre
     *
     * @return string
     */
    public function getMediaTitre()
    {
        return $this->mediaTitre;
    }

    /**
     * Get dates
     *
     * @return \DateTime
     */
    public function getDates()
    {
        return $this->dates;
    }

    /**
     * Get mediaDescrib
     *
     * @return string
     */
    public function getMediaDescrib()
    {
        return $this->mediaDescrib;
    }

    /**
     * Get mediaFile
     *
     * @return string
     */
    public function getMediaFile()
    {
        return $this->mediaFile;
    }

    /**
     * Get mediaImg
     *
     * @return string
     */
    public function getMediaImg()
    {
        return $this->mediaImg;
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

