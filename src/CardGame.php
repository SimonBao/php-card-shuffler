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

    public function dealCards(){
      $hand = array_splice($this->deck, 0, 7);
      return $hand;
    }
  }



