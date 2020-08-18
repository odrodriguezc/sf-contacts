<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ContactRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @ApiResource( 
 *      attributes={
 *          "normalization_context"={"groups"={"contact:read"}},
 *          "denormalization_context"={"groups"={"contact:write"}}
 *      }
 * )
 * @todo security control
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"contact:read", "contact:write"})
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"contact:read", "contact:write"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"contact:read", "contact:write"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"contact:read", "contact:write"})
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"contact:read", "contact:write"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"contact:read", "contact:write"})
     */
    private $address;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"contact:read"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="contacts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}
