<?php

  class Deck{
    const SUITS = array(
      'Hearts', 'Clubs', 'Spades',
      'Diamonds');
    /* The SUITS constant define each suit in a traditional French card deck as an array. */

    const CARD_RANKS = array(
      'Ace', 'Two', 'Three',
      'Four', 'Five', 'Six',
      'Seven', 'Eight', 'Nine',
      'Ten', 'Jack', 'Queen',
      'King'
    );
    /* The CARD_RANKS constant define each rank in a traditional French card deck as an array. */

    private $cards = [];

    function __construct(){
      $this->setupCards();
    }
    /* On Deck instance construction call buildDeck method. */

    public function getDeckLength(){
      $card_count = sizeof($this->cards);
      return $card_count;
    }
    /* Returns quantity of elements within $cards variable as integer */

    public function getCards(){
      return $this->cards;
    }
    /* 
    The getCards function that return instance variable cards.
    The method encapulates the instance variable from being directly accessible.
    */

    public function removeCard(){
      $removed_card = array_splice($this->cards, 0, 1);
      return $removed_card;
    }
    /* 
    Removes first element from $cards,
    and sets return argument as the removed element
     */

    public function shuffleCards(){
      $cards = &$this->cards;
      for( $i = sizeof($cards)-1 ; $i > 0 ; $i-- ){
        $random_number = mt_rand(0,$i);
        list($cards[$i], $cards[$random_number]) = array($cards[$random_number], $cards[$i]);
      }
    }
    
    private function setupCards(){
      $suits = Deck::SUITS;
      $ranks = Deck::CARD_RANKS;
      $cards = [];
      foreach($suits as $suit){
        foreach($ranks as $rank){
          array_push($cards, array($suit, $rank));
        }
      }
      $this->setCards($cards);
    }
    /*
    The method setupCards is reponsible for creating the cards required.
    Calls setCards method with the cards created as the argument.
    */

    private function setCards($cards){
      $this->cards = $cards;
    }
    /* The setCards function takes an argument and sets it as the instance variable cards. */
  }