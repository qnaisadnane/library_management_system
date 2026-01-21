<?php

namespace App\Models;

class Book{
    private $id;
    private $isbn;
    private $title;
    private $categories;
    private $status;
    private $publication_year;
    private $number_available_copies;
    private array $authors;

    function __construct($id , $isbn , $title , $categories ,$status='Available' ,$publication_year ,$number_available_copies){
        $this->id = $id;
        $this->isbn = $isbn;
        $this->title = $title;
        $this->categories = $categories;
        $this->status = $status;
        $this->publication_year = $publication_year;
        $this->number_available_copies = $number_available_copies;
        $this->authors = [];
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
    public function getAuthors(){
        return $this->authors;
    }
    
    public function setTitle(string $title):void{
         $this->title = $title;
    }
    public function setCategories(string $categories):void{
         $this->categories = $categories;
    }
    public function setStatus(string $status):void{
         $this->status = $status;
    }
    public function setPublicationYear(int $publication_year):void{
         $this->publication_year = $publication_year;
    }
    public function setNumberAvailableCopies( int $number_available_copies):void{
         $this->number_available_copies = $number_available_copies;
    }
    public function addAuthor(Author $author):void{
         $this->authors[] = $author;
    }
    
}