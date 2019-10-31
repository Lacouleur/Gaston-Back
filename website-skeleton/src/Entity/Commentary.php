<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaryRepository")
 */
class Commentary
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("post_get")
     * @Groups("commentary_get")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("commentary_get")
     */
    private $body;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("commentary_get")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Post", inversedBy="commentaries")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("commentary_get")
     */
    private $post;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="commentaries")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("commentary_get")
     */
    private $user;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

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

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

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
    public function __toString()
    {
        return $this->body;
    }
}
