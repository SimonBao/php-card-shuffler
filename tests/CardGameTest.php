<?php

use PHPUnit\Framework\TestCase;

class CardGameTest extends TestCase{

  # ------------------ HELPERS ------------------

  protected $card_game;
  /*
  Protected variable which will be used by fixture setUp
  */

  protected function setUp(){
    $mocked_deck = $this->mockDeck();
    $mocked_players = $this->mockAllPlayers();
    $this->card_game = new CardGame($mocked_deck, $mocked_players);
  }
  /* 
  The PHPUnit fixture will run once before each test.
  The fixture creates a new CardGame instance with two mocked paramaters passed in.
  The mocked parameters have set expectations to calls. 
  This reduces the risk of a faulty dependency from causing false positives.
  */

  private function mockDeck(){
    $cards = range(1,52);
    $mock_deck = $this->createMock(Deck::class);
    $mock_deck->method('getDeckLength')->willReturn(52);
    $mock_deck->method('removeCard')->will($this->onConsecutiveCalls(...$cards));
    return $mock_deck;
  }
  /*
  This function creates a mock object with the class attribute Deck,
  the mocked deck will have a set expectation call and a return value attached.
  In this case the expectation 'getCards' call will return a array with between the ranges of
  1 to 52. 
  */

  private function mockPlayer(){
    $mock_player = $this->createMock(Player::class);
    $mock_player->method('obtainCard')->will($this->returnArgument(0));
    return $mock_player;
  }
  /*
  This function creates a mock object with the class attribute Player,
  the mocked expectation call 'obtainCard' with an argument. In this case -
  will return the argument back.

  For example "obtainCard(['Hearts','Ace'])" will return "['Hearts', 'Ace']".
  */

  private function mockAllPlayers(){
    $players_needed = CardGame::PLAYERS_NEEDED;
    $mock_players = [];
    for($i = 0; $i < $players_needed ; $i++){
      $mock_player = $this->mockPlayer();
      array_push($mock_players, $mock_player);
    }
    return $mock_players;
  }
  /* 
  The mockAllPlayers function creates and returns an array with multiple mocked objects stored.
  The amount of mocked objects created, depends on number of players required.
  */

  private function getDeckLength(){
    $deck_length = $this->card_game->getDeckLength();
    return $deck_length;
  }
  /*
  Returns numeral count of elements stored in the deck as integer.
  */

  private function flattenArray(array $delt_cards){
      $cards = [];
      array_walk_recursive($delt_cards, function($card) use (&$cards) { $cards[] = $card; });
      return $cards;
  }

  /* 
  The flattenArray method accepts an single array parameter.
  The parameter is then passed into an PHP method which iterates over every element
  and executes a callback function with $cards referenced.
  The callback will append the $cards variable with each element $card.
  */

  # ------------------ TESTS ------------------

  public function testDeckCardCount(){
    $this->assertEquals(52, $this->getDeckLength());
  } 
  /*
  Expects deck to have 52 elements.
  */

  public function testValidAmountOfPlayers(){
    $players_needed = CardGame::PLAYERS_NEEDED;
    $total_players = $this->card_game->playerCount();
    $this->assertEquals($players_needed, $total_players);
  }
  /* Expects total players to be the same as the amount of players needed */


  public function testSevenCardsDealedToEachPlayer(){
    $card_game = $this->card_game;
    $delt_cards_array_md = $card_game->dealToAll();
    $total_cards = sizeof($this->flattenArray($delt_cards_array_md));
    $this->assertEquals(28, $total_cards);
  }
  /* 
  Test that each players get delt seven cards.
  If seven cards are delt to four players, 28 cards
  are removed from the deck, resulting in 24 cards left.
  
  The multi-dimensional array gets transformed into a flat array.
  To get total elements in a flat array, sizeof/count can be used to get element count as
  integer value.
  */

  public function testDealSequence(){
    $card_game = $this->card_game;
    $cards_each = CardGame::MAX_CARDS;
    $total_players = CardGame::PLAYERS_NEEDED;
    $cards_delt = $card_game->dealToAll();
    $this->roundRobinSequenceCheck($cards_each, $total_players, $cards_delt);
  }

  private function roundRobinSequenceCheck($cards_each, $total_players, $cards_delt){
    for( $deal_sequence = 0 ; $deal_sequence < $cards_each ; $deal_sequence++ ){
      for( $player_position = 0 ; $player_position < $total_players ; $player_position++){
        $card_in_sequence = ($deal_sequence * 4) + ($player_position + 1);
        $delt_card = $cards_delt[$deal_sequence][$player_position];
        $this->assertEquals($card_in_sequence, $delt_card );
      }
    }
  }

  /*
  The roundRobinSequenceCheck has 3 parameters: $cards_each, $total_players, $cards_delt.
  The first two arguments are used to calculate what card should be delt based on iteration and
  number of players.

  (a*4)+(b+1) a in this case is $deal_sequence and b is $player_position
  first sequence == [1,2,3,4]
  second sequence == [5,6,7,8]
  */
}