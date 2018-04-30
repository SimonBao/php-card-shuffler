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
    $mock_deck = $this->createMock(Deck::class);
    $mock_deck->method('getCards')->willReturn(range(1,52));
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
    $deck_length = sizeof($this->card_game->getDeck());
    return $deck_length;
  }
  /*
  Returns numeral count of elements stored in the deck as integer.
  */

  private function dealCards(){
    $dealed_hand = $this->card_game->dealCards();
    return $dealed_hand;
  }
  /* 
  Calls card_game method dealCards deal seven cards.
  And return the data back as a array.
  */

  # ------------------ TESTS ------------------

  public function testDeckCardCount(){
    $this->assertEquals(52, $this->getDeckLength());
  } 
  /*
  Expects deck to have 52 elements.
  */

  public function testDealedSevenCards(){
    $dealed_hand_length = sizeof($this->dealCards());
    $this->assertEquals(7, $dealed_hand_length);
  }
  /*
  Expects seven cards to be returned by method call.
  */

  public function testDealedCardsRemovesSevenFromDeck(){
    $this->assertEquals(52, $this->getDeckLength());
    $this->dealCards();
    $this->assertEquals(45, $this->getDeckLength());
  }
  /*
  Expects seven cards to be removed.
   */

  public function testDealedCardsRemovedFromDeck(){
    $cards = $this->dealCards();
    foreach($cards as $card){
      $this->assertNotContains($card, $this->card_game->getDeck());
    }
  }
  /* 
  Expects cards delt, to no longer be in deck.
  */

  public function testSevenCardsDealedToEachPlayer(){
    $card_game = $this->card_game;
    $card_game->dealToAll();
    $this->assertEquals(24, $this->getDeckLength());
  }
  /* 
  Test that each players get delt seven cards.
  If seven cards are delt to four players, 28 cards
  are removed from the deck, resulting in 24 cards left.
  */

  public function testCardGameStartsWithFourPlayers(){
    $game_players = $this->card_game->playerCount();
    $this->assertEquals(4, $game_players);
  }
  /*
  Expects game to start with four players.
  */
  
}