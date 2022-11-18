<?php

namespace App\Entity;

use App\Repository\HobbiesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HobbiesRepository::class)
 */
class Hobbies
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $loisir;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="hobbies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pays;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="hobbies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $photo;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLoisir(): ?string
    {
        return $this->loisir;
    }

    public function setLoisir(string $loisir): self
    {
        $this->loisir = $loisir;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

}
