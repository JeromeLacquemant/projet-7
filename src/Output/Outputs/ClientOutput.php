<?php

namespace App\Output\Outputs;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;

class ClientOutput
{
        private $id;
    
        private $username;
    
        private $password;
    
        private $email;
    
        private $_links;
    
        public function __construct()
        {
            $this->user = new ArrayCollection();
        }
    
        public function getId(): ?int
        {
            return $this->id;
        }

        public function setId(int $id): self
        {
            $this->id = $id;
    
            return $this;
        }
    
        public function getName(): ?string
        {
            return $this->username;
        }
    
        public function getUsername(): ?string
        {
            return $this->email;
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