<?php

namespace App\Entity;

use App\Repository\FamiliaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FamiliaRepository::class)]
class Familia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToMany(targetEntity: JuegoDeTronos::class, inversedBy: 'familias')]
    private $personajes;

    public function __construct()
    {
        $this->personajes = new ArrayCollection();
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

    /**
     * @return Collection<int, JuegoDeTronos>
     */
    public function getPersonajes(): Collection
    {
        return $this->personajes;
    }

    public function addPersonaje(JuegoDeTronos $personaje): self
    {
        if (!$this->personajes->contains($personaje)) {
            $this->personajes[] = $personaje;
        }

        return $this;
    }

    public function removePersonaje(JuegoDeTronos $personaje): self
    {
        $this->personajes->removeElement($personaje);

        return $this;
    }
}
