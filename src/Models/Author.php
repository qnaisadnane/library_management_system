<?php

namespace App\src\Models;

class Author{
    private $id;
    private $name;
    private $biography;
    private $nationality;
    private $genre;
    private $birth_date;
    private $death_date;

    function __construct($id , $name , $biography , $nationality ,$genre ,$birth_date ,$death_date){
        $this->id = $id;
        $this->name = $name;
        $this->biography = $biography;
        $this->nationality = $nationality;
        $this->genre = $genre;
        $this->birth_date = $birth_date;
        $this->death_date = $death_date;
    }
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getBiography(){
        return $this->biography;
    }
    public function getNationality(){
        return $this->nationality;
    }
    public function getGenre(){
        return $this->genre;
    }
    public function getBirthDate(){
        return $this->birth_date;
    }
    public function getDeathDate(){
        return $this->death_date;
    }

}

