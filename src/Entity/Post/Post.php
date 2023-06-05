<?php

namespace App\Entity\Post;

use Cocur\Slugify\Slugify;
use App\Repository\Post\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity(
    'slug', message: 'Ce slug existe déjà.')]
class Post
{

    const STATES = ['STATE_DRAFT','STATE_PUBLISHED','STATE_ARCHIVED'];
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string', length: 255,unique: true)]
    private string $title;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string',length: 255,unique: true)]
    private string $slug;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'text')]
    private string $content;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string',length: 255)]
    private string $state = Post::STATES[0];

    #[Assert\NotNull]
    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    #[Assert\NotNull]
    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $updatedAt;

    #[ORM\OneToOne(inversedBy:'post',targetEntity: Thumbnail::class, cascade: ['persist', 'remove'])]
    private ?Thumbnail $thumbnail = null;


    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();

    }

    #[ORM\PrePersist]
    public function prePersist()
    {
        $this->slug = (new Slugify())->slugify($this->title);
    }
    #[ORM\PreUpdate]
    public function preUpdate()
    {
        $this->updatedAt = new \DateTimeImmutable();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state): self
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeImmutable $createdAt
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeImmutable $updatedAt
     */
    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function __toString(): string
    {
        return $this->title;
    }

    /**
     * @return Thumbnail
     */
    public function getThumbnail(): ?Thumbnail
    {
        return $this->thumbnail;
    }

    /**
     * @param ?Thumbnail $thumbnail
     */
    public function setThumbnail(?Thumbnail $thumbnail): self
    {
        $this->thumbnail = $thumbnail;
        return $this;
    }
}
