<?php

  class CardGame{
    const PLAYERS_NEEDED = 4;
    private $deck;
    private $players = [];

    public function __construct($deck_object = null, $players = null){
      $this->setupDeck($deck_object);
      $this->setupPlayers($players);
    }
    /*  
    CardGame instance construction takes in two parameters: the card deck and players.
    Construct values set to null by default for conditional check and dependency injection.
    Set deck and players with arguments passed in.
    */

    public function getDeck(){
      return $this->deck;
    }
    /* 
    Getter method returns instance variable deck.
    Instance variable deck is defined by the setDeck method call at instance construction.
    */ 

    public function dealCards(){
      $cards = array_splice($this->deck, 0, 7);
      return $cards;
    }
    //The dealCards method returns cards removed from deck as array.

    public function dealToAll(){
      $players = $this->players;
      foreach($players as $player){
        $player->obtainCard($this->dealCards());
      }
    }
    // The dealToAll method deals cards to each player individually.

    public function playerCount(){
      return sizeof($this->players);
    }
    // The playerCount method returns total players in instance as integer.

    private function setupDeck($deck_object){
      $deck;
      if($deck_object == null){
        $deck_object = $this->createDeck();
        $deck = $deck_object->cards();
      } else {
        $deck = $deck_object->cards();
      }
      $this->setDeck($deck);
    }
    /*
    The setupDeck method is a private method that can only be accessed from within the instance.
    The method takes in a single parameter deck_object.
    If the argument is null it constructs a new Deck.
    */

    private function createDeck(){
      $deck_object = new Deck();
      return $deck_object;
    }
    // creates a new Deck object and returns it

    private function setDeck($deck){
      $this->deck = $deck;
    }
    // The argument gets stored as a instance variable called deck.

    private function setupPlayers($players){
      $minimum_players = self::PLAYERS_NEEDED;
      $current_players = sizeof($players);
      $players;

      if($current_players == null){
        $players = $this->getPlayers($minimum_players);
      } elseif ($current_players < $minimum_players){
        $players_needed = $minimum_players - $current_players;
        $players = array_merge($players + $this->getPlayers($players_needed));
      } 
      $this->setPlayers($players);
    }
    /*
    The setupPlayers object takes a single parameter players.
    Checks if theres enough players, if there isn't get additional players then
    pass players to setPlayers method to store players.
    */

    private function setPlayers($players){
      $this->players = $players;
    }
    /* 
    The method setPlayers takes in a single parameter.
    The provided argument is stored as instance variable players.
    */
    
    private function getPlayers($players_needed){
      $needed_players = [];
      for($i = 0; $i < $players_needed ; $i++){
        array_push($players, new Player());
      }
      return $needed_players;
    }
    /*
    The getPlayers method takes in a single parameter players_needed.
    The argument defines how many players are needed to fill table.
    The method creates each player individually and stores them into $needed_players.
    The method creates players until no more players are needed, then returns the needed_players array.
    */

  }



