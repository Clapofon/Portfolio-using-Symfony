<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\OneToMany(targetEntity: Render::class, mappedBy: 'project')]
    private Collection $renders;

    public function __construct()
    {
        $this->renders = new ArrayCollection();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $video = null;

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

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(string $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getRenders(): Collection
    {
        return $this->renders;
    }

    public function addRender(Render $render): self
    {
        if (!$this->render->contains($render)) {
            $this->render[] = $render;
            $render->setCategory($this);
        }

        return $this;
    }

    public function removeRender(Render $render): self
    {
        if ($this->render->contains($render)) {
            $this->render->removeElement($render);
            // set the owning side to null (unless already changed)
            if ($render->getCategory() === $this) {
                $render->setCategory(null);
            }
        }

        return $this;
    }
}
