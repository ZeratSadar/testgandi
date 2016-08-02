<?php

namespace Pages\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="events")
 * @ORM\Entity(repositoryClass="Pages\CoreBundle\Repository\EventRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Event
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
     * @ORM\Column(name="event_img", type="string", length=255)
     */
    private $eventImg;

    /**
     * @var string
     *
     * @ORM\Column(name="event_titre", type="string", length=255)
     */
    private $eventTitre;

    /**
     * @var string
     *
     * @ORM\Column(name="event_contenu", type="text")
     */
    private $eventContenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dates", type="datetime")
     */
    private $dates;

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
        $this->eventImg = '';
    }

    /**
     * Set eventImg
     *
     * @param string $eventImg
     * @return Event
     */
    public function setEventImg($eventImg)
    {
        $this->eventImg = $eventImg;

        return $this;
    }

    /**
     * Set eventTitre
     *
     * @param string $eventTitre
     * @return Event
     */
    public function setEventTitre($eventTitre)
    {
        $this->eventTitre = $eventTitre;

        return $this;
    }

    /**
     * Set eventContenu
     *
     * @param string $eventContenu
     * @return Event
     */
    public function setEventContenu($eventContenu)
    {
        $this->eventContenu = $eventContenu;

        return $this;
    }

    /**
     * Set dates
     *
     * @param \DateTime $dates
     * @return Event
     */
    public function setDates($dates)
    {
        $this->dates = $dates;

        return $this;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return Event
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getUploadRootDir()
    {
        return __dir__.'/../../../../web/media/event';
    }
    
    public function getAbsolutePath()
    {
        return null === $this->eventImg ? null : $this->getUploadRootDir().'/'.$this->eventImg;
    }
    
    public function getAssetPath()
    {
        return 'media/event/'.$this->eventImg;
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate() 
     */
    public function preUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->geteventImg();
        $this->updateAt = new \DateTime();
        
        if (null !== $this->file) 
            $this->eventImg = sha1(uniqid(mt_rand(),true)).'.'.$this->file->guessExtension();
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate() 
     */
    public function upload()
    {
        if (null !== $this->file) {
            $this->file->move($this->getUploadRootDir(),$this->eventImg);
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
     * Get eventImg
     *
     * @return string 
     */
    public function getEventImg()
    {
        return $this->eventImg;
    }

    /**
     * Get eventTitre
     *
     * @return string 
     */
    public function getEventTitre()
    {
        return $this->eventTitre;
    }

    /**
     * Get eventContenu
     *
     * @return string 
     */
    public function getEventContenu()
    {
        return $this->eventContenu;
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
     * Get updateAt
     *
     * @return \DateTime 
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }
}
