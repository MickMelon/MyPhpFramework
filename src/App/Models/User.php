<?php
namespace App\Models;

class User
{
    private $id;
    private $firstName;
    private $lastName;
    private $gender;
    private $email;
    private $password;
    private $cmgRating;
    private $handicap;
    private $created;
    private $lastModified;

    /**
     * Undocumented function
     *
     * @param integer $id
     * @param string $firstName
     * @param string $lastName
     * @param string $gender
     * @param string $email
     * @param string $password
     * @param string $cmgRating
     * @param string $handicap
     * @param string $created
     * @param string $lastModified
     */
    public function __construct(int $id, string $firstName, string $lastName, string $gender,
        string $email, string $password, string $cmgRating, string $handicap, string $created,
        string $lastModified)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->gender = $gender;
        $this->email = $email;
        $this->password = $password;
        $this->cmgRating = $cmgRating;
        $this->handicap = $handicap;
        $this->created = $created;
        $this->lastModified = $lastModified;
    }

    public static function makeFromData($data)
    {
        return new User(
            $data->ID,
            $data->FirstName,
            $data->LastName,
            $data->Gender,
            $data->Email,
            $data->Password,
            $data->CmgRating,
            $data->Handicap,
            $data->Created,
            $data->LastModified
        ); 
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of firstName
     */ 
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */ 
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName
     */ 
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */ 
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of gender
     */ 
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */ 
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of cmgRating
     */ 
    public function getCmgRating()
    {
        return $this->cmgRating;
    }

    /**
     * Set the value of cmgRating
     *
     * @return  self
     */ 
    public function setCmgRating($cmgRating)
    {
        $this->cmgRating = $cmgRating;

        return $this;
    }

    /**
     * Get the value of handicap
     */ 
    public function getHandicap()
    {
        return $this->handicap;
    }

    /**
     * Set the value of handicap
     *
     * @return  self
     */ 
    public function setHandicap($handicap)
    {
        $this->handicap = $handicap;

        return $this;
    }

    /**
     * Get the value of created
     */ 
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Get the value of lastModified
     */ 
    public function getLastModified()
    {
        return $this->lastModified;
    }
}