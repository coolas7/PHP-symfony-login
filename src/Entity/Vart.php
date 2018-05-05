<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="vart")
 * @ORM\Entity(repositoryClass="App\Repository\VartRepository")
 * @UniqueEntity(
 *     fields={"username", "email"},
 *     errorPath="username",
 *     message="Toks vartotojas su tokiu el. pašto adresu registruotas!"
 * )
 * @UniqueEntity("email", message="Toks el.pašto adresas jau registruotas!")
 * @UniqueEntity("username", message="Toks vardas jau registruotas!")
 */
class Vart implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=90, unique=true)
     * @Assert\NotBlank(message="Neįvedėte vardo")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=90, unique=true)
     * @Assert\Email(message="Neteisingai įvestas pašto adresas")
     * @Assert\NotBlank(message="Neįvedėte pašto")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
    
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $usertype;

    public function getId()
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getUsertype(): ?string
    {
        return $this->usertype;
    }

    public function setUsertype(string $usertype): self
    {
        $this->usertype = $usertype;

        return $this;
    }

    public function setRole($role) {
        $this->role = $role;
        return $this;
    }
    public function getRole() {

        return $this->role;
    }
    public function getSalt() {
            return null;
    }
    public function getRoles() {

            return array('ROLE_USER');
          
    }

    public function eraseCredentials() {
          return null;
    }

    /** @see \Serializable::serialize() */
    public function serialize() {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized) {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized, ['allowed_classes' => false]);
    }

    public function __toString() {
        return $this->username;
    }
}
