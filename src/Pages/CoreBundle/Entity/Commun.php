<?php

namespace Pages\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commun
 *
 * @ORM\Table(name="communautes")
 * @ORM\Entity(repositoryClass="Pages\CoreBundle\Repository\CommunRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Commun
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
     * @ORM\Column(name="vp_img", type="string", length=255)
     */
    private $vpImg;

    /**
     * @var string
     *
     * @ORM\Column(name="vp_nom", type="string", length=255)
     */
    private $vpNom;

    /**
     * @var string
     *
     * @ORM\Column(name="vp_prenom", type="string", length=255)
     */
    private $vpPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="vp_fonc", type="string", length=255)
     */
    private $vpFonc;

    /**
     * @var string
     *
     * @ORM\Column(name="vp_describ", type="text")
     */
    private $vpDescrib;

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
        $this->vpImg = '';
    }   

    /**
     * Set vpImg
     *
     * @param string $vpImg
     *
     * @return Commun
     */
    public function setVpImg($vpImg)
    {
        $this->vpImg = $vpImg;

        return $this;
    }

    /**
     * Set vpNom
     *
     * @param string $vpNom
     *
     * @return Commun
     */
    public function setVpNom($vpNom)
    {
        $this->vpNom = $vpNom;

        return $this;
    }

    /**
     * Set vpPrenom
     *
     * @param string $vpPrenom
     *
     * @return Commun
     */
    public function setVpPrenom($vpPrenom)
    {
        $this->vpPrenom = $vpPrenom;

        return $this;
    }   

    /**
     * Set vpFonc
     *
     * @param string $vpFonc
     *
     * @return Commun
     */
    public function setVpFonc($vpFonc)
    {
        $this->vpFonc = $vpFonc;

        return $this;
    }

    /**
     * Set vpDescrib
     *
     * @param string $vpDescrib
     *
     * @return Commun
     */
    public function setVpDescrib($vpDescrib)
    {
        $this->vpDescrib = $vpDescrib;

        return $this;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return Commun
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getUploadRootDir()
    {
        return __dir__.'/../../../../web/media/comm/vp';
    }
    
    public function getAbsolutePath()
    {
        return null === $this->vpImg ? null : $this->getUploadRootDir().'/'.$this->vpImg;
    }
    
    public function getAssetPath()
    {
        return 'media/comm/vp/'.$this->vpImg;
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate() 
     */
    public function preUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->getvpImg();
        $this->updateAt = new \DateTime();
        
        if (null !== $this->file) 
            $this->vpImg = sha1(uniqid(mt_rand(),true)).'.'.$this->file->guessExtension();
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate() 
     */
    public function upload()
    {
        if (null !== $this->file) {
            $this->file->move($this->getUploadRootDir(),$this->vpImg);
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Get vpImg
     *
     * @return string
     */
    public function getVpImg()
    {
        return $this->vpImg;
    }
    
    /**
     * Get vpNom
     *
     * @return string
     */
    public function getVpNom()
    {
        return $this->vpNom;
    }
    
    /**
     * Get vpPrenom
     *
     * @return string
     */
    public function getVpPrenom()
    {
        return $this->vpPrenom;
    }
    
    /**
     * Get vpFonc
     *
     * @return string
     */
    public function getVpFonc()
    {
        return $this->vpFonc;
    }
    
    /**
     * Get vpDescrib
     *
     * @return string
     */
    public function getVpDescrib()
    {
        return $this->vpDescrib;
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

