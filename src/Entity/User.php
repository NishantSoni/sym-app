<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /**
     *
     * @ORM\Column(name="firstname", type="string", length=255,nullable=true)
     */
    private $firstname;

    /**
     *
     * @ORM\Column(name="lastname", type="string", length=255,nullable=true)
     */
    protected $lastname;

    /**
     *
     * @ORM\Column(name="profileimage", type="text", nullable=true)
     */
    protected $profileimage;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get first name
     *
     * @return String
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set first name
     *
     * @param String $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get last name
     *
     * @return String
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set last name
     *
     * @param String $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get Profile image
     *
     * @return String
     */
    public function getProfileimage()
    {
        return $this->profileimage;
    }

    /**
     * Set last name
     *
     * @param String $profileimage
     * @return User
     */
    public function setProfileimage($profileimage)
    {
        $this->profileimage = $profileimage;

        return $this;
    }

}
