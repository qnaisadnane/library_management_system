<?php

namespace App\src\Models;

class Book{
    private $id;
    private $isbn;
    private $title;
    private $categories;
    private $status;
    private $publication_year;
    private $number_available_copies;

    function __construct($id , $isbn , $title , $categories ,$status ,$publication_year ,$number_available_copies){
        $this->id = $id;
        $this->isbn = $isbn;
        $this->title = $title;
        $this->categories = $categories;
        $this->status = $status;
        $this->publication_year = $publication_year;
        $this->number_available_copies = $number_available_copies;
    }

    public function getId(){
        return $this->id;
    }
    public function getIsbn(){
        return $this->isbn;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getCategories(){
        return $this->categories;
    }
    public function getStatus(){
        return $this->status;
    }
    public function getPublicationYear(){
        return $this->publication_year;
    }
    public function getNumberAvailableCopies(){
        return $this->number_available_copies;
    }
    
}