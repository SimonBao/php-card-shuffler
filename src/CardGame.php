<?php

  class CardGame{
    private $deck;

    function __construct(){
      $this->deck = range(1,52);
    }

    public function getDeck()
    {
      return $this->deck;
    }
  }



