<?php

namespace App\Output\Outputs;

class UserOutput
{
    private $id;

    private $username;

    private $password;

    private $email;

    private $_links;

    private $_embedded;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getEmbedded(): array
    {
        return $this->_embedded;
    }

    public function setEmbedded(array $_embedded): self
    {
        $this->_embedded = $_embedded;

        return $this;
    }
}