<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApiDataRepository")
 */
class ApiData
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champs ne peux pas être vide!")
     */
    private $voice;

    /**
     * @ORM\Column(type="string", length=7000, nullable=true)
     * @Assert\Length(max="7000", maxMessage="Le texte doit comporter au plus 7000 caractères")
     */
    private $text;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVoice(): ?string
    {
        return $this->voice;
    }

    public function setVoice(array $voice): self
    {
        $this->voice = $voice;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }
}
