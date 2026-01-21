<?php

namespace App\Models;


Class StudentMember{

    public function getMaxBooks(){
        return 3;
    } 
    public function getLoanDays(){
        return 14;
    }
    public function getDailyLatefee(){
        return 0.50;
    }
}