<?php

  class CardGame{
    private $deck;

    public function __construct($deck = null){
      $this->createDeck($deck);
    }

    public function getDeck(){
      return $this->deck;
    }

    public function dealCards(){
      $hand = array_splice($this->deck, 0, 7);
      return $hand;
    }

    private function createDeck($deck){
      if($deck == null){
        $deck_object = new Deck();
        $deck_of_cards = $deck_object->cards();
        $this->deck = $deck_of_cards;
      } else {
        $this->deck = $deck->cards();
      } 
    }

  }



