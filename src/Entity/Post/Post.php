<?php

namespace App\Entity\Post;

use Cocur\Slugify\Slugify;
use App\Repository\Post\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity(
    'slug', message: 'Ce slug existe déjà.')]
class Post
{
    const STATES = ['STATE_DRAFT', 'STATE_PUBLISHED', 'STATE_ARCHIVED'];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private string $title;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private string $slug;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'text')]
    private string $content;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string', length: 255)]
    private string $state = self::STATES[0];

    #[Assert\NotNull]
    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    #[Assert\NotNull]
    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $updatedAt;

    #[ORM\OneToOne(inversedBy: 'post', targetEntity: Thumbnail::class, cascade: ['persist', 'remove'])]
    private ?Thumbnail $thumbnail = null;

    #[ORM\ManyToMany(targetEntity: Category::class, mappedBy: 'posts')]
    private Collection $categories;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comments;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->categories = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    #[ORM\PrePersist]
    public function prePersist(): void
    {
        $this->slug = (new Slugify())->slugify($this->title);
    }

    #[ORM\PreUpdate]
    public function preUpdate(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }
    public function getSanitizedContent(): string
    {
        return strip_tags($this->content);
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getThumbnail(): ?Thumbnail
    {
        return $this->thumbnail;
    }

    public function setThumbnail(?Thumbnail $thumbnail): self
    {
        if ($thumbnail === null && $this->thumbnail !== null) {
            $this->thumbnail->setPost(null);
        }

        if ($thumbnail !== null && $thumbnail->getPost() !== $this) {
            $thumbnail->setPost($this);
        }

        $this->thumbnail = $thumbnail;
        return $this;
    }

    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addPost($this);
        }
        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->contains($category)) {
            $category->removePost($this);
        }
        return $this;
    }

    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setPost($this);
        }
        return $this;
    }
}
