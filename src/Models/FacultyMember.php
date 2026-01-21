<?php

namespace App\Models;


Class FacultyMember{

    public function getMaxBooks(){
        return 10;
    } 
    public function getLoanDays(){
        return 30;
    }
    public function getDailyLatefee(){
        return 0.25;
    }
}