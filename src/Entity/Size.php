<?php

namespace App\Entity;

use App\Repository\SizeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SizeRepository::class)
 */
class Size
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Size;

    /**
     * @ORM\OneToMany(targetEntity=Model::class, mappedBy="Size")
     */
    private $Model_Size;

    public function __construct()
    {
        $this->Model_Size = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSize(): ?string
    {
        return $this->Size;
    }

    public function setSize(string $Size): self
    {
        $this->Size = $Size;

        return $this;
    }

    /**
     * @return Collection|Model[]
     */
    public function getModelSize(): Collection
    {
        return $this->Model_Size;
    }

    public function addModelSize(Model $modelSize): self
    {
        if (!$this->Model_Size->contains($modelSize)) {
            $this->Model_Size[] = $modelSize;
            $modelSize->setSize($this);
        }

        return $this;
    }

    public function removeModelSize(Model $modelSize): self
    {
        if ($this->Model_Size->removeElement($modelSize)) {
            // set the owning side to null (unless already changed)
            if ($modelSize->getSize() === $this) {
                $modelSize->setSize($this);
            }
        }

        return $this;
    }

    public function __toString() 
    {
        return (string) $this->Size; 
    }
}
