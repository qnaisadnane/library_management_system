<?php

namespace App\src\Models;

class BorrowRecord{
    private $id;
    private $id_book;
    private $id_member;
    private $borrow_date;
    private $due_date;
    private $return_date;
    private $latefee;

    function __construct($id , $id_book , $id_member , $borrow_date ,$due_date ,$return_date ,$latefee){
        $this->id = $id;
        $this->id_book = $id_book;
        $this->id_member = $id_member;
        $this->borrow_date = $borrow_date;
        $this->due_date = $due_date;
        $this->return_date = $return_date;
        $this->latefee = $latefee;
    }

    public function getId(){
        return $this->id;
    }
    public function getIdbook(){
        return $this->id_book;
    }
    public function getIdMember(){
        return $this->id_member;
    }
    public function getBorrowDate(){
        return $this->borrow_date;
    }
    public function getDueDate(){
        return $this->due_date;
    }
    public function getReturnDate(){
        return $this->return_date;
    }
    public function getLatefee(){
        return $this->latefee;
    }
    
}