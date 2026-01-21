<?php

namespace App\Models;

abstract class Member{
    protected $id;
    protected $full_name;
    protected $email;
    protected $phone;
    protected $expiry_date;

    function __construct($id , $full_name , $email , $phone , $expiryDate){
        $this->id = $id;
        $this->full_name = $full_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->expiry_date = $expiry_date;
    }

    abstract public function getMaxBooks();
    abstract public function getLoanPeriod();
    abstract public function getLateFeeRate();


    public function isExpired(){
        return $this->membershipExpiry;
    }
    public function getId(){ 
        return $this->id; 
        }
    public function getFullName(){ 
        return $this->full_name; 
        }
    public function getEmail(){ 
        return $this->email; 
        }
    public function getPhone(){ 
        return $this->phone; 
        }
    public function getExpiryDate(){ 
        return $this->expiry_date; 
        }
    public function setFullName(string $full_name): void { 
        $this->full_name = $full_name; 
        }
    public function setEmail(string $email): void { 
        $this->email = $email; 
        }
    public function setPhone(string $phone): void { 
        $this->phone = $phone; 
        }
    public function setExpiryDate(DateTime $expiry_date): void { 
        $this->expiry_date = $expiry_date; 
        }
    
}