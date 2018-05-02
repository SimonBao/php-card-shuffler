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
      for($runs = 0; $runs < 2 ; $runs++){
        for( $i = sizeof($cards)-1 ; $i > 0 ; $i-- ){
          $random_number = mt_rand(0,$i);
          if($this->validSwap($cards, $i, $random_number)){
            list($cards[$i], $cards[$random_number]) = array($cards[$random_number], $cards[$i]);
          }
        }
      }
    }
    /* 
    The shuffleCards function follows the Fisher Yates shuffling algorithm, which iterates through the cards and swaps them with an,
    randomly generated position each time. It has been modified for further shuffling.
    */
    
    private function createNeighbours($cards, $i, $deck_length){
      $neighbours = [];

      if($i == 0){
        array_push($neighbours, $cards[$i+1]);
      } elseif($i == $deck_length){
        array_push($neighbours, $cards[$i-1]);
      } else {
        array_push($neighbours, $cards[$i-1], $cards[$i+1]);
      }
      return $neighbours;
    }
    /*
    The createNeighbours function, prepares neighbours to be used in comparison tests.
    This will be used to prevent sequences from forming. It returns an array which are adjacent to the current card.
    */

    private function checkNeighbour($card, $neighbours){
      $valid_neighbour = [];
 
      foreach($neighbours as $neighbour){
        if($this->checkSuit($neighbour, $card)){
          $same_rank = $this->compareRanks($neighbour, $card);
          array_push($valid_neighbour, $same_rank );
        } else {
          array_push($valid_neighbour, true);
        }
      }

      if(sizeof($valid_neighbour) == 1 && $valid_neighbour[0 == true]){
        return true;
      }

      return $valid_neighbour == [true, true];
    }
    /* 
    The checkNeighbour method, is reponsible for checking if the potential new position
    is valid, through comparing its potential neighbours suit/ranking. If any potential neighbours
    can cause a sequence to be created, it returns false. Preventing the swap.
    */
    
    private function checkSuit($firstcard, $secondcard){
      if($firstcard[0] == $secondcard[0]){
        return true;
      }
      return false;
    }
    /* 
    The method checkSuit compares the two arguments suits and returns boolean,
    determining if they are equal.
    */
    
    private function compareRanks($firstcard, $secondcard){
      $firstcard_rank = $this->getRank($firstcard);
      $secondcard_rank = $this->getRank($secondcard);
      $not_sequenced = $this->notSequenced($firstcard_rank, $secondcard_rank);
      return $not_sequenced;
    }
    /* 
    The compareRanks method transforms two cards to enable rank comparison then returns a boolean,
    defining if ranks are in sequence.
    */
    
    private function getRank($card){
      $card_rank = array_search($card[1], Deck::CARD_RANKS);
      return $card_rank;
    }
    /* 
    The getRank method transforms the String rank into its relative rank as an integer.
    Strings could not be reliably used, however they are used to define ranking for consistency.
    */

    private function notSequenced($firstcard, $secondcard){
      $difference = abs($firstcard - $secondcard);
      $no_sequence = ($difference == 1 ? false : true );
      return $no_sequence;
    }
    /* 
    The notSquenced method returns true if the values compared are not sequenced,
    either positively or negatively.
     */
    
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

    private function validSwap($cards, $i, $r){
      $deck_length = $this->getDeckLength() - 1;
      $i_neighbours = $this->createNeighbours($cards, $i, $deck_length);
      $r_neighbours = $this->createNeighbours($cards, $r, $deck_length);
      $i_valid = $this->checkNeighbour($cards[$i], $r_neighbours);
      $r_valid = $this->checkNeighbour($cards[$r], $i_neighbours);
      return [$i_valid, $r_valid] == [true, true]; 
    }
    /* 
    The valid swap method checks suits/values from its position before any swaps happen.
    The method returns true only if both cards have are not in sequence with its neighbouts after the swap.
    */
  }
