<?php

namespace Pages\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partner
 *
 * @ORM\Table(name="partners")
 * @ORM\Entity(repositoryClass="Pages\CoreBundle\Repository\PartnerRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Partner
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
     * @ORM\Column(name="pa_logo", type="string", length=255)
     */
    private $paLogo;

    /**
     * @var string
     *
     * @ORM\Column(name="pa_partner", type="string", length=255)
     */
    private $paPartner;

    /**
     * @var string
     *
     * @ORM\Column(name="pa_lien", type="string", length=255)
     */
    private $paLien;

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
        $this->paLogo = '';
    }    

    /**
     * Set paLogo
     *
     * @param string $paLogo
     *
     * @return Partner
     */
    public function setPaLogo($paLogo)
    {
        $this->paLogo = $paLogo;

        return $this;
    }    

    /**
     * Set paPartner
     *
     * @param string $paPartner
     *
     * @return Partner
     */
    public function setPaPartner($paPartner)
    {
        $this->paPartner = $paPartner;

        return $this;
    }    

    /**
     * Set paLien
     *
     * @param string $paLien
     *
     * @return Partner
     */
    public function setPaLien($paLien)
    {
        $this->paLien = $paLien;

        return $this;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return Partner
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getUploadRootDir()
    {
        return __dir__.'/../../../../web/media/comm/pa';
    }
    
    public function getAbsolutePath()
    {
        return null === $this->paLogo ? null : $this->getUploadRootDir().'/'.$this->paLogo;
    }
    
    public function getAssetPath()
    {
        return 'media/comm/pa/'.$this->paLogo;
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate() 
     */
    public function preUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->getpaLogo();
        $this->updateAt = new \DateTime();
        
        if (null !== $this->file) 
            $this->paLogo = sha1(uniqid(mt_rand(),true)).'.'.$this->file->guessExtension();
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate() 
     */
    public function upload()
    {
        if (null !== $this->file) {
            $this->file->move($this->getUploadRootDir(),$this->paLogo);
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
     * Get paLogo
     *
     * @return string
     */
    public function getPaLogo()
    {
        return $this->paLogo;
    }
    
    /**
     * Get paPartner
     *
     * @return string
     */
    public function getPaPartner()
    {
        return $this->paPartner;
    }
    
    /**
     * Get paLien
     *
     * @return string
     */
    public function getPaLien()
    {
        return $this->paLien;
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

