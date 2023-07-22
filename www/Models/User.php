<?php

namespace App\Models;

use App\Core\Sql;

class User extends Sql
{
    private static $instance;
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    protected Int $id = 0;
    protected String $id_role;
    protected String $firstname;
    protected String $lastname;
    protected String $pseudo;
    protected String $email;
    protected String $phone;
    protected String $birth_date;
    protected String $thumbnail;
    protected String $address;
    protected String $zip_code;
    protected String $pwd;
    protected String $country;
    protected bool $is_verified;
    protected String $token;

    /*
    **  Id Getter & Setter
    */
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = \htmlspecialchars($id);
    }
    /*
    **  Id_Role Getter & Setter
    */
    public function getIdRole(): int
    {
        return $this->id_role;
    }

    public function setIdRole(string $id_role): void
    {
        $this->id_role = \htmlspecialchars($id_role);
    }

    /*
    **  Firstname Getter & Setter
    */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = htmlspecialchars(ucwords(strtolower(trim($firstname))));
    }

    /*
    **  Lastname Getter & Setter
    */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = htmlspecialchars(strtoupper(trim($lastname)));
    }

    /*
    **  Pseudo Getter & Setter
    */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = htmlspecialchars(strtoupper(trim($pseudo)));
    }

    /*
    **  Email Getter & Setter
    */
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = htmlspecialchars(strtolower(trim($email)));
    }

    /*
    **  Phone Getter & Setter
    */
    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = htmlspecialchars($phone);
    }

    /*
    **  BirthDate Getter & Setter
    */
    public function getBirthDate(): string
    {
        return $this->birth_date;
    }

    public function setBirthDate(string $birth_date): void
    {
        $this->birth_date = htmlspecialchars($birth_date);
    }

    /*
    **  Thumbnail Getter & Setter
    */
    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): void
    {
        $this->thumbnail = \htmlspecialchars($thumbnail);
    }

    /*
    **  Address Getter & Setter
    */
    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = \htmlspecialchars($address);
    }

    /*
    **  ZipCode Getter & Setter
    */
    public function getZipCode(): string
    {
        return $this->zip_code;
    }

    public function setZipCode(string $zip_code): void
    {
        $this->zip_code = htmlspecialchars($zip_code);
    }

    /*
    **  Password Getter & Setter
    */
    public function getPassword(): string
    {
        return $this->pwd;
    }

    public function setPassword(string $password): void
    {
        $this->pwd = htmlspecialchars(password_hash($password, PASSWORD_DEFAULT));
    }

    /*
    **  Country Getter & Setter
    */
    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = htmlspecialchars(strtoupper(trim($country)));
    }

    /*
    **  IsVerified Getter & Setter
    */
    public function getIsVerified(): bool
    {
        return $this->is_verified;
    }

    public function setIsVerified(string $is_verified): void
    {
        $this->is_verified = \htmlspecialchars($is_verified);
    }

    /*
    **  Token Getter & Setter
    */
    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = \htmlspecialchars($token);
    }

    /* public function hydrate($id_role, $firstname, $lastname, $pseudo, $email, $phone, $birth_date, $address, $zip_code, $country, $pwd, $thumbnail, $is_verified, $token): void
    {
        $this->setIdRole($id_role);
        $this->setFirstname($firstname);
        $this->setLastname($lastname);
        $this->setPseudo($pseudo);
        $this->setEmail($email);
        $this->setPhone($phone);
        $this->setBirthDate($birth_date);
        $this->setAddress($address);
        $this->setZipCode($zip_code);
        $this->setCountry($country);
        $this->setPassword($pwd);
        $this->setThumbnail($thumbnail);
        $this->setIsVerified($is_verified);
        $this->setToken($token);
    } */

    public function generateToken()
    {
        $randomString = bin2hex(random_bytes(16));
        $hash = password_hash($randomString, PASSWORD_DEFAULT);
        $this->setToken($hash);
        return $randomString;
    }

    public function verifyToken($token)
    {
        return password_verify($token, $this->getToken());
    }

    public function refreshUserToken()
    {
        $token = $this->generateToken();
        return $token;
    }
}
