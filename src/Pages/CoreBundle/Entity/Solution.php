<?php

namespace Pages\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Solution
 *
 * @ORM\Table(name="solutions")
 * @ORM\Entity(repositoryClass="Pages\CoreBundle\Repository\SolutionRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Solution
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
     * @ORM\Column(name="sol_logo", type="string", length=255)
     */
    private $solLogo;

    /**
     * @var string
     *
     * @ORM\Column(name="sol_nom", type="string", length=255)
     */
    private $solNom;

    /**
     * @var string
     *
     * @ORM\Column(name="sol_fonc", type="string", length=255)
     */
    private $solFonc;

    /**
     * @var string
     *
     * @ORM\Column(name="sol_describ", type="text")
     */
    private $solDescrib;

    /**
     * @var string
     *
     * @ORM\Column(name="sol_link", type="string", length=255)
     */
    private $solLink;

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
        $this->solLogo = '';
    }

    /**
     * Set solLogo
     *
     * @param string $solLogo
     * @return Solution
     */
    public function setSolLogo($solLogo)
    {
        $this->solLogo = $solLogo;

        return $this;
    }

    /**
     * Set solNom
     *
     * @param string $solNom
     * @return Solution
     */
    public function setSolNom($solNom)
    {
        $this->solNom = $solNom;

        return $this;
    }

    /**
     * Set solFonc
     *
     * @param string $solFonc
     * @return Solution
     */
    public function setSolFonc($solFonc)
    {
        $this->solFonc = $solFonc;

        return $this;
    }

    /**
     * Set solDescrib
     *
     * @param string $solDescrib
     * @return Solution
     */
    public function setSolDescrib($solDescrib)
    {
        $this->solDescrib = $solDescrib;

        return $this;
    }

    /**
     * Set solLink
     *
     * @param string $solLink
     * @return Solution
     */
    public function setSolLink($solLink)
    {
        $this->solLink = $solLink;

        return $this;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return Solution
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getUploadRootDir()
    {
        return __dir__.'/../../../../web/media/solution';
    }
    
    public function getAbsolutePath()
    {
        return null === $this->solLogo ? null : $this->getUploadRootDir().'/'.$this->solLogo;
    }
    
    public function getAssetPath()
    {
        return 'media/solution/'.$this->solLogo;
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate() 
     */
    public function preUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->getsolLogo();
        $this->updateAt = new \DateTime();
        
        if (null !== $this->file) 
            $this->solLogo = sha1(uniqid(mt_rand(),true)).'.'.$this->file->guessExtension();
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate() 
     */
    public function upload()
    {
        if (null !== $this->file) {
            $this->file->move($this->getUploadRootDir(),$this->solLogo);
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
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get solLogo
     *
     * @return string 
     */
    public function getSolLogo()
    {
        return $this->solLogo;
    }

    /**
     * Get solNom
     *
     * @return string 
     */
    public function getSolNom()
    {
        return $this->solNom;
    }

    /**
     * Get solFonc
     *
     * @return string 
     */
    public function getSolFonc()
    {
        return $this->solFonc;
    }

    /**
     * Get solDescrib
     *
     * @return string 
     */
    public function getSolDescrib()
    {
        return $this->solDescrib;
    }

    /**
     * Get solLink
     *
     * @return string 
     */
    public function getSolLink()
    {
        return $this->solLink;
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
