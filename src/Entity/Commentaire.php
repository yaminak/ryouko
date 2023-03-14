<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use App\Repository\CommentaireRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=CommentaireRepository::class)
 */
class Commentaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pays;


    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity=ComLike::class, mappedBy="commentaire")
     */
    private $likes;

     /**
     * @ORM\OneToMany(targetEntity=ComDislike::class, mappedBy="commentaire")
     */
    private $dislikes;

    public function __construct()
    {
        $this->likes = new ArrayCollection();
        $this->dislikes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, ComLike>
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(ComLike $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setCommentaire($this);
        }

        return $this;
    }

    public function removeLike(ComLike $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getCommentaire() === $this) {
                $like->setCommentaire(null);
            }
        }

        return $this;
    }
    
    /**
     *  Permet de savoir si cet article est "liké" par l'utilisateur
     * 
     * @param User $user
     * @return boolean
     */
    public function isLikedByUser(User $user) : bool 
    {
        foreach ($this->likes as $like) {
            if($like->getUser() === $user) return true;
        }
        return false;

    }

     /**
     * @return Collection<int, ComDislike>
     */
    public function getDislikes(): Collection
    {
        return $this->dislikes;
    }

    public function addDislike(ComDislike $dislike): self
    {
        if (!$this->dislikes->contains($dislike)) {
            $this->dislikes[] = $dislike;
            $dislike->setCommentaire($this);
        }

        return $this;
    }

    public function removeDislike(ComDislike $dislike): self
    {
        if ($this->dislikes->removeElement($dislike)) {
            // set the owning side to null (unless already changed)
            if ($dislike->getCommentaire() === $this) {
                $dislike->setCommentaire(null);
            }
        }

        return $this;
    }
    
    /**
     *  Permet de savoir si cet article est "disliké" par l'utilisateur
     * 
     * @param User $user
     * @return boolean
     */
    public function isDislikedByUser(User $user) : bool 
    {
        foreach ($this->dislikes as $dislike) {
            if($dislike->getUser() === $user) return true;
        }
        return false;

    }



}
