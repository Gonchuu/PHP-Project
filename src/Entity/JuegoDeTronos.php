<?php

namespace App\Entity;

use App\Repository\JuegoDeTronosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JuegoDeTronosRepository::class)]
class JuegoDeTronos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $number;

    #[ORM\ManyToMany(targetEntity: Familia::class, mappedBy: 'personajes')]
    private $familias;

    public function __construct()
    {
        $this->familias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return Collection<int, Familia>
     */
    public function getFamilias(): Collection
    {
        return $this->familias;
    }

    public function addFamilia(Familia $familia): self
    {
        if (!$this->familias->contains($familia)) {
            $this->familias[] = $familia;
            $familia->addPersonaje($this);
        }

        return $this;
    }

    public function removeFamilia(Familia $familia): self
    {
        if ($this->familias->removeElement($familia)) {
            $familia->removePersonaje($this);
        }

        return $this;
    }
}
