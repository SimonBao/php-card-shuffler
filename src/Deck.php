<?php
  class Deck{
    private $cards = [];
    const SUITS = array(
      'Hearts', 'Clubs', 'Spades',
      'Diamonds');

    const CARD_RANKS = array(
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
      $ranks = Deck::CARD_RANKS;
      foreach($suits as $suit){
        foreach($ranks as $rank){
          array_push($this->cards, array($suit, $rank));
        }
      }
    }
  }