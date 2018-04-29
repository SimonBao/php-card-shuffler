<?php
  class Deck{
    private $cards = [];
    const SUITS = array(
      'Hearts', 'Clubs', 'Spades',
      'Diamonds');

    const CARD_SET = array(
      'Ace', 'Two', 'Three',
      'Four', 'Five', 'Six',
      'Seven', 'Eight', 'Nine',
      'Ten', 'Jack', 'Queen',
      'King'
    );

    function __construct(){
      $this->buildDeck();
    }

    public function cards(){
      return $this->cards;
    }

    private function buildDeck(){
      $suits = Deck::SUITS;
      $set = Deck::CARD_SET;
      foreach($suits as $suit){
        foreach($set as $card){
          array_push($this->cards, array($suit, $card));
        }
      }
    }
  }