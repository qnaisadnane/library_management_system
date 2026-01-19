<?php

namespace App\src\Models;

abstract class Member{
    protected $id;
    protected $full_name;
    protected $email;
    protected $phone_number;

    function __construct($id , $full_name , $email , $phone_number){
        $this->id = $id;
        $this->full_name = $full_name;
        $this->email = $email;
        $this->phone_number = $phone_number;
    }
    
}