<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $Description;

    /**
     * @ORM\OneToMany(targetEntity=Model::class, mappedBy="Category")
     */
    private $Model_Category;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Image;

    public function __construct()
    {
        $this->Model_Category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->Name;
    }

    public function setName( $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription()
    {
        return $this->Description;
    }

    public function setDescription( $Description): self
    {
        $this->Description = $Description;

        return $this;
    }
    

    /**
     * @return Collection|Model[]
     */
    public function getModelCategory(): Collection
    {
        return $this->Model_Category;
    }

    public function addModelCategory(Model $modelCategory): self
    {
        if (!$this->Model_Category->contains($modelCategory)) {
            $this->Model_Category[] = $modelCategory;
            $modelCategory->setCategory($this);
        }

        return $this;
    }

    public function removeModelCategory(Model $modelCategory): self
    {
        if ($this->Model_Category->removeElement($modelCategory)) {
            // set the owning side to null (unless already changed)
            if ($modelCategory->getCategory() === $this) {
                $modelCategory->setCategory($this);
            }
        }

        return $this;
    }

    public function __toString() 
    {
        return (string) $this->Name; 
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getImage()
    {
        return $this->Image;
    }

    public function setImage($Image): self
    {
        $this->Image = $Image;

        return $this;
    }
}
