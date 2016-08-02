<?php

namespace Pages\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Info
 *
 * @ORM\Table(name="ccmarche")
 * @ORM\Entity(repositoryClass="Pages\CoreBundle\Repository\InfoRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Info
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
     * @ORM\Column(name="sol_img", type="string", length=255)
     */
    private $solImg;

    /**
     * @var string
     *
     * @ORM\Column(name="bui_titre", type="string", length=255)
     */
    private $buiTitre;

    /**
     * @var string
     *
     * @ORM\Column(name="bui_text", type="text")
     */
    private $buiText;

    /**
     * @var string
     *
     * @ORM\Column(name="bui_img", type="string", length=255)
     */
    private $buiImg;

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
        $this->solImg = '';
        $this->buiImg = '';
    }    

    /**
     * Set solImg
     *
     * @param string $solImg
     * @return Info
     */
    public function setSolImg($solImg)
    {
        $this->solImg = $solImg;

        return $this;
    }

    /**
     * Set buiTitre
     *
     * @param string $buiTitre
     * @return Info
     */
    public function setBuiTitre($buiTitre)
    {
        $this->buiTitre = $buiTitre;

        return $this;
    }  

    /**
     * Set buiText
     *
     * @param string $buiText
     * @return Info
     */
    public function setBuiText($buiText)
    {
        $this->buiText = $buiText;

        return $this;
    }    

    /**
     * Set buiImg
     *
     * @param string $buiImg
     * @return Info
     */
    public function setBuiImg($buiImg)
    {
        $this->buiImg = $buiImg;

        return $this;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return Info
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getUploadRootDir()
    {
        return __dir__.'/../../../../web/media/infog';
    }
    
    public function getAbsolutePath()
    {
        return null === $this->solImg ? null : $this->getUploadRootDir().'/'.$this->solImg;
    }
    
    public function getAssetPath()
    {
        return 'media/infog/'.$this->solImg;
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate() 
     */
    public function preUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->getsolImg();
        $this->updateAt = new \DateTime();
        
        if (null !== $this->file) 
            $this->solImg = sha1(uniqid(mt_rand(),true)).'.'.$this->file->guessExtension();
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate() 
     */
    public function upload()
    {
        if (null !== $this->file) {
            $this->file->move($this->getUploadRootDir(),$this->solImg);
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
        return null === $this->buiImg ? null : $this->getUploadRootDir().'/'.$this->buiImg;
    }
    
    public function getAssetPathI()
    {
        return 'media/infog/'.$this->buiImg;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate() 
     */
    public function preUploadI()
    {
        $this->tempFili = $this->getAbsolutePathI();
        $this->oldFili = $this->getbuiImg();
        $this->updateAt = new \DateTime();
        
        if (null !== $this->fili) 
            $this->buiImg = sha1(uniqid(mt_rand(),true)).'.'.$this->fili->guessExtension();
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate() 
     */
    public function uploadI()
    {
        if (null !== $this->fili) {
            $this->fili->move($this->getUploadRootDir(),$this->buiImg);
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
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get solImg
     *
     * @return string 
     */
    public function getSolImg()
    {
        return $this->solImg;
    }

    /**
     * Get buiTitre
     *
     * @return string 
     */
    public function getBuiTitre()
    {
        return $this->buiTitre;
    }

    /**
     * Get buiText
     *
     * @return string 
     */
    public function getBuiText()
    {
        return $this->buiText;
    }

    /**
     * Get buiImg
     *
     * @return string 
     */
    public function getBuiImg()
    {
        return $this->buiImg;
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
