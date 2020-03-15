<?php

namespace App\Entity;
use DateTime;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\IngredientRepository")
 */
class Ingredient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $title;

    
    /**
     * @ORM\Column(type="date")
     */
    private $bestBefore;

    /**
     * @ORM\Column(type="date")
     */
    private $useBy;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    
    public function getBestBefore(): ?\DateTimeInterface
    {
        return $this->bestBefore;
    }

    public function setBestBefore(\DateTimeInterface $bestBefore): self
    {
        $this->bestBefore = $bestBefore;
        
        return $this;
    }

    public function getUseBy(): ?\DateTimeInterface
    {
        return $this->useBy;
    }

    public function setUseBy(\DateTimeInterface $useBy): self
    {
        $this->useBy = $useBy;

        return $this;
    }
}
