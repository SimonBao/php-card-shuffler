<?php

  class CardGame{
    const MAX_PLAYERS = 4;
    private $deck;
    private $players = [];

    public function __construct($deck = null, $players = null){
      $this->setDeck($deck);
      $this->setPlayers($players);
    }

    public function getDeck(){
      return $this->deck;
    }

    public function dealCards(){
      $hand = array_splice($this->deck, 0, 7);
      return $hand;
    }

    public function playerCount(){
      return sizeof($this->players);
    }

    private function setDeck($deck){
      if($deck == null){
        $deck_object = new Deck();
        $deck_of_cards = $deck_object->cards();
        $this->deck = $deck_of_cards;
      } else {
        $this->deck = $deck->cards();
      } 
    }

    private function setPlayers($players){
      $max_players = self::MAX_PLAYERS;
      if($players == null){
        $this->getPlayers($max_players);
      } elseif ($players < $max_players){
        $players_needed = $max_players - $players;
        $this->getPlayers($players_needed);
      } else {
        $this->players = $players;
      }
    }


    private function getPlayers($players_needed){
      for($i = 0; $i < $players_needed ; $i++){
        array_push($this->players, new Player());
      }
    }

  }



