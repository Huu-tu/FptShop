<?php

namespace App\Entity;

use App\Repository\ModelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModelRepository::class)
 */
class Model
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
     * @ORM\Column(type="string", length=10)
     */
    private $Description;

    /**
     * @ORM\Column(type="integer")
     */
    private $Price;

    /**
     * @ORM\Column(type="string", length=10, nullable = true)
     */
    private $MadeIn;

    /**
     * @ORM\Column(type="integer")
     */
    private $Amount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Image;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="Model_Category")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Category;

    /**
     * @ORM\ManyToOne(targetEntity=Size::class, inversedBy="Model_Size")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Size;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getSize()
    {
        return $this->Size;
    }

    public function setSize( $Size): self
    {
        $this->Size = $Size;

        return $this;
    }

    public function getCategory()
    {
        return $this->Category;
    }

    public function setCategory( $Category): self
    {
        $this->Category = $Category;

        return $this;
    }
    

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->Price;
    }

    public function setPrice(int $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getMadeIn(): ?string
    {
        return $this->MadeIn;
    }

    public function setMadeIn(string $MadeIn): self
    {
        $this->MadeIn = $MadeIn;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->Amount;
    }

    public function setAmount(int $Amount): self
    {
        $this->Amount = $Amount;

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
