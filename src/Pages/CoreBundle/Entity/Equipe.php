<?php

namespace Pages\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipe
 *
 * @ORM\Table(name="equipes")
 * @ORM\Entity(repositoryClass="Pages\CoreBundle\Repository\EquipeRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Equipe
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
     * @ORM\Column(name="eq_ava", type="string", length=255)
     */
    private $eqAva;

    /**
     * @var string
     *
     * @ORM\Column(name="eq_nom", type="string", length=255)
     */
    private $eqNom;

    /**
     * @var string
     *
     * @ORM\Column(name="eq_prenom", type="string", length=255)
     */
    private $eqPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="eq_poste", type="string", length=255)
     */
    private $eqPoste;

    /**
     * @var string
     *
     * @ORM\Column(name="eq_bio", type="text")
     */
    private $eqBio;

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
        $this->eqAva = '';
    }    

    /**
     * Set eqAva
     *
     * @param string $eqAva
     *
     * @return Equipe
     */
    public function setEqAva($eqAva)
    {
        $this->eqAva = $eqAva;

        return $this;
    }    

    /**
     * Set eqNom
     *
     * @param string $eqNom
     *
     * @return Equipe
     */
    public function setEqNom($eqNom)
    {
        $this->eqNom = $eqNom;

        return $this;
    }   

    /**
     * Set eqPrenom
     *
     * @param string $eqPrenom
     *
     * @return Equipe
     */
    public function setEqPrenom($eqPrenom)
    {
        $this->eqPrenom = $eqPrenom;

        return $this;
    }    

    /**
     * Set eqPoste
     *
     * @param string $eqPoste
     *
     * @return Equipe
     */
    public function setEqPoste($eqPoste)
    {
        $this->eqPoste = $eqPoste;

        return $this;
    } 

    /**
     * Set eqBio
     *
     * @param string $eqBio
     *
     * @return Equipe
     */
    public function setEqBio($eqBio)
    {
        $this->eqBio = $eqBio;

        return $this;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return Equipe
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getUploadRootDir()
    {
        return __dir__.'/../../../../web/media/comm/eq';
    }
    
    public function getAbsolutePath()
    {
        return null === $this->eqAva ? null : $this->getUploadRootDir().'/'.$this->eqAva;
    }
    
    public function getAssetPath()
    {
        return 'media/comm/eq/'.$this->eqAva;
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate() 
     */
    public function preUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->geteqAva();
        $this->updateAt = new \DateTime();
        
        if (null !== $this->file) 
            $this->eqAva = sha1(uniqid(mt_rand(),true)).'.'.$this->file->guessExtension();
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate() 
     */
    public function upload()
    {
        if (null !== $this->file) {
            $this->file->move($this->getUploadRootDir(),$this->eqAva);
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
     * Get eqAva
     *
     * @return string
     */
    public function getEqAva()
    {
        return $this->eqAva;
    }
    
    /**
     * Get eqNom
     *
     * @return string
     */
    public function getEqNom()
    {
        return $this->eqNom;
    }
    
    /**
     * Get eqPrenom
     *
     * @return string
     */
    public function getEqPrenom()
    {
        return $this->eqPrenom;
    }
    
    /**
     * Get eqPoste
     *
     * @return string
     */
    public function getEqPoste()
    {
        return $this->eqPoste;
    }
    
    /**
     * Get eqBio
     *
     * @return string
     */
    public function getEqBio()
    {
        return $this->eqBio;
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

