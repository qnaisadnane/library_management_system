<?php

namespace App\Models;

class LibraryBranch {
    private  $id;
    private  $name;
    private  $location;
    private  $operating_hours;

    public function __construct( $id,  $name,  $location , $operating_hours) {
        $this->id = $id;
        $this->name = $name;
        $this->location = $location;
        $this->operating_hours = $operating_hours;
    }

    public function getId(){ 
        return $this->id; 
        }
    public function getName(){ 
        return $this->name; 
        }
    public function getLocation(){ 
        return $this->location; 
        }
    public function getOperatingHours(){ 
        return $this->operating_hours; 
        }    
    public function setName(string $name){ 
        $this->name = $name; 
        }
    public function setLocation(string $location){ 
        $this->location = $location; 
        }
    public function setOperatingHours(int $operating_hours){ 
        $this->operating_hours = $operating_hours; 
        }      
}