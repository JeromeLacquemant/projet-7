<?php

namespace App\Output\Outputs;


class UserOutput
{
    private $id;

    private $username;

    private $password;

    private $email;

    private $_links;

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
}