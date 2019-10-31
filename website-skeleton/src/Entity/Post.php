<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraint as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("user_get")
     * @Groups("post_get")
     * @Groups("category_get")
     * @Groups("wearCondition_get")
     * @Groups("postStatus_get")
     * @Groups("visibility_get")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     * @Groups("post_get")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Groups("post_get")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * @Groups("post_get")
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=128)
     * @Groups("post_get")
     */
    private $addressLabel;

    /**
     * @ORM\Column(type="float")
     * @Groups("post_get")
     */
    private $lat;

    /**
     * @ORM\Column(type="float")
     * @Groups("post_get")
     */
    private $lng;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("post_get")
     */
    private $nbLikes;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("post_get")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups("post_get")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("post_get")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PostStatus", inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("post_get")
     */
    private $postStatus;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Visibility", inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("post_get")
     */
    private $visibility;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\WearCondition", inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("post_get")
     */
    private $wearCondition;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("post_get")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentary", mappedBy="post", orphanRemoval=true)
     * @Groups("post_get")
     */
    private $commentaries;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = null;
        $this->commentaries = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getAddressLabel(): ?string
    {
        return $this->addressLabel;
    }

    public function setAddressLabel(string $addressLabel): self
    {
        $this->addressLabel = $addressLabel;

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?float
    {
        return $this->lng;
    }

    public function setLng(float $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function getNbLikes(): ?int
    {
        return $this->nbLikes;
    }

    public function setNbLikes(int $nbLikes): self
    {
        $this->nbLikes = $nbLikes;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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

    public function getPostStatus(): ?PostStatus
    {
        return $this->postStatus;
    }

    public function setPostStatus(?PostStatus $postStatus): self
    {
        $this->postStatus = $postStatus;

        return $this;
    }

    public function getVisibility(): ?Visibility
    {
        return $this->visibility;
    }

    public function setVisibility(?Visibility $visibility): self
    {
        $this->visibility = $visibility;

        return $this;
    }

    public function getWearCondition(): ?WearCondition
    {
        return $this->wearCondition;
    }

    public function setWearCondition(?WearCondition $wearCondition): self
    {
        $this->wearCondition = $wearCondition;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTime();
    }
    public function __toString()
    {
        return $this->title;
    }

    /**
     * @return Collection|Commentary[]
     */
    public function getCommentaries(): Collection
    {
        return $this->commentaries;
    }

    public function addCommentary(Commentary $commentary): self
    {
        if (!$this->commentaries->contains($commentary)) {
            $this->commentaries[] = $commentary;
            $commentary->setPost($this);
        }

        return $this;
    }

    public function removeCommentary(Commentary $commentary): self
    {
        if ($this->commentaries->contains($commentary)) {
            $this->commentaries->removeElement($commentary);
            // set the owning side to null (unless already changed)
            if ($commentary->getPost() === $this) {
                $commentary->setPost(null);
            }
        }

        return $this;
    }
    
}
