<?php

namespace App\Output\Outputs;

use Symfony\Component\Validator\Constraints as Assert;

class ProductOutput
{
    private $id;

    /**
     * @Assert\Length(min=5, max=100)
     */
    private $name;

    /**
     * @Assert\Length(min=5, max=255)
     */
    private $description;
    
    private $price;
    
    private $_links;
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
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
    
    public function getPrice(): ?string
    {
        return $this->price;
    }
    
    public function setPrice(string $price): self
    {
        $this->price = $price;
    
        return $this;
    }
    
    public function getLinks(): array
    {
        return $this->_links;
    }
    
    public function setLinks(array $_links): self
    {
        $this->_links = $_links;
    
        return $this;
    }
}