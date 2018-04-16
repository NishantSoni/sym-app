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

    /** @ORM\Column(name="github_id", type="string", length=255, nullable=true) */
    protected $github_id;

    /** @ORM\Column(name="github_access_token", type="string", length=255, nullable=true) */
    protected $github_access_token;

    /** @ORM\Column(name="facebook_id", type="string", length=255, nullable=true) */
    protected $facebook_id;

    /** @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true) */
    protected $facebook_access_token;

    /** @ORM\Column(name="googleplus_id", type="string", length=255, nullable=true) */
    protected $googleplus_id;

    /** @ORM\Column(name="googleplus_access_token", type="string", length=255, nullable=true) */
    protected $googleplus_access_token;

    /** @ORM\Column(name="stackexchange_id", type="string", length=255, nullable=true) */
    protected $stackexchange_id;

    /** @ORM\Column(name="stackexchange_access_token", type="string", length=255, nullable=true) */
    protected $stackexchange_access_token;
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function setGithubId($githubId)
    {
        
        $this->github_id = $githubId;

        return $this;
    }

    public function getGithubId() {
        return $this->github_id;
    }

    public function setGithubAccessToken($githubAccessToken)
    {
        
        $this->github_access_token = $githubAccessToken;

        return $this;
    }

    public function getGithubAccessToken()
    {
        return $this->github_access_token;
    }

    public function setFacebookId($facebookID) {
        $this->facebook_id = $facebookID;

        return $this;
    }

    public function getFacebookId() {
        return $this->facebook_id;
    }

    public function setFacebookAccessToken($facebookAccessToken) {
        $this->facebook_access_token = $facebookAccessToken;

        return $this;
    }

    public function getFacebookAccessToken() {
        return $this->facebook_access_token;
    }

    public function setGoogleplusId($googlePlusId) {
        $this->googleplus_id = $googlePlusId;

        return $this;
    }

    public function getGoogleplusId() {
        return $this->googleplus_id;
    }

    public function setGoogleplusAccessToken($googleplusAccessToken) {
        $this->googleplus_access_token = $googleplusAccessToken;

        return $this;
    }

    public function getGoogleplusAccessToken() {
        return $this->googleplus_access_token;
    }


    public function setStackexchangeId($stackExchangeId) {
        $this->stackexchange_id = $stackExchangeId;

        return $this;
    }

    public function getStackexchangeId() {
        return $this->stackexchange_id;
    }

    public function setStackexchangeAccessToken($stackExchangeAccessToken) {
        $this->stackexchange_access_token = $stackExchangeAccessToken;

        return $this;
    }

    public function getStackexchangeAccessToken() {
        return $this->stackexchange_access_token;
    }
}
