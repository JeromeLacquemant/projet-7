<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Repository\UserRepository;
use Symfony\Component\Serializer\Annotation\Groups;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message = "L'adresse email est déjà utilisé")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user:read")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user:read")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user:read")
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="user")
     */
    private $client;

    /**
     * @Groups({"user:read"})
     */
    private $_links;

    /**
     * @Groups({"user:read"})
     */
    private $_embedded;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

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

    public function eraseCredentials() {}

    public function getSalt() {}

    public function getRoles() {}
}
