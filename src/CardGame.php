<?php
  require_once('Deck.php');
  require_once('Player.php');
  class CardGame{
    const MAX_CARDS = 7;
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

    public function getDeckLength(){
      return $this->deck->getDeckLength();
    }
    /* 
    Getter method returns instance variable deck.
    Instance variable deck is defined by the setDeck method call at instance construction.
    */ 

    public function dealToAll(){
      $players = $this->players;
      $max_cards = self::MAX_CARDS;
      $delt_cards = [];
      for($i = 0; $i < $max_cards ; $i++){
        $cards_delt_to_player = [];
        foreach($players as $player){
          $delt_card = $this->dealCard();
          array_push($cards_delt_to_player, $delt_card);
          $player->obtainCard($delt_card);
        }
        array_push($delt_cards, $cards_delt_to_player);
      }
      return $delt_cards;
    }
    /*     
    The dealToAll method deals cards to each player individually.
    The method works by using the amount of cards required each and the total players.
    It works by giving each player a single card until each player has the maximum cards.
    */
    public function playerCount(){
      return sizeof($this->players);
    }
    // The playerCount method returns total players in instance as integer.

    private function createDeck(){
      $deck_object = new Deck();
      return $deck_object;
    }
    // creates a new Deck object and returns it

    private function dealCard(){
      $card = $this->deck->removeCard();
      return $card;
    }
    //The dealCard method returns a single card removed from deck.

        
    private function getPlayers($players_needed){
      $needed_players = [];
      for($i = 0; $i < $players_needed ; $i++){
        array_push($needed_players, new Player());
      }
      return $needed_players;
    }
    /*
    The getPlayers method takes in a single parameter players_needed.
    The argument defines how many players are needed to fill table.
    The method creates each player individually and stores them into $needed_players.
    The method creates players until no more players are needed, then returns the needed_players array.
    */
    
    private function setupDeck($deck){
      if($deck == null){
        $deck = $this->createDeck();
      }
      $this->setDeck($deck);
    }
    /*
    The setupDeck method is a private method that can only be accessed from within the instance.
    The method takes in a single parameter deck_object.
    If the argument is null it constructs a new Deck.
    */

    private function setDeck($deck){
      $this->deck = $deck;
    }
    // The argument gets stored as a instance variable called deck.

    private function setupPlayers($players){
      $minimum_players = self::PLAYERS_NEEDED;

      if($players == null){
        $players = $this->getPlayers($minimum_players);
      } elseif (sizeof($players) < $minimum_players){
        $players_needed = ($minimum_players - sizeof($players));
        $players = array_merge($players, $this->getPlayers($players_needed));
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

  }
