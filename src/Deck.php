<?php
  class Deck{
    private $cards;

    function __construct(){
      $this->cards = range(1,52);
    }

    public function cards(){
      return $this->cards;
    }

  }