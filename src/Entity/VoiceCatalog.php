<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoiceCatalogRepository")
 */
class VoiceCatalog
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $voiceList = [];

    public function __construct()
    {
        $this->setVoiceList(['key0'=>'val0','key1'=>'val1','key2'=>'val2']);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVoiceList(): ?array
    {
        return $this->voiceList;
    }

    public function setVoiceList(?array $voiceList): self
    {
        $this->voiceList = $voiceList;

        return $this;
    }
}
