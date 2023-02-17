<?php

namespace App\Entity;

use App\Entity\SearchData;

class SearchData 
{
    /** @var int  */
    // public $page = 1;

    /** @var string */
    public string $q = '';

 public function __toString()
 {

     return $this->searchdata;
 }
}