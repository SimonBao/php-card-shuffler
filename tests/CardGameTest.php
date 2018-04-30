<?php

use PHPUnit\Framework\TestCase;

class CardGameTest extends TestCase{

  # ------------------ HELPERS ------------------

  protected $card_game;

  protected function setUp(){
    $mocked_deck = $this->mockDeck();
    $mocked_players = $this->mockAllPlayers();
    $this->card_game = new CardGame($mocked_deck, $mocked_players);
  }

  private function mockDeck(){
    $mock_deck = $this->createMock(Deck::class);
    $mock_deck->method('cards')->willReturn(range(1,52));
    return $mock_deck;
  }

  private function mockPlayer(){
    $mock_player = $this->createMock(Player::class);
    $mock_player->method('obtainCard')->will($this->returnArgument(0));
    return $mock_player;
  }

  private function mockAllPlayers(){
    $maximum_players = CardGame::MAX_PLAYERS;
    $mock_players = [];
    for($i = 0; $i < $maximum_players ; $i++){
      $mock_player = $this->mockPlayer();
      array_push($mock_players, $mock_player);
    }
    return $mock_players;
  }

  private function getDeckLength(){
    $deck_length = sizeof($this->card_game->getDeck());
    return $deck_length;
  }

  private function updateDeck(){
    $updatedDeck = $this->deck_length = sizeof($this->card_game->getDeck());
    return $updatedDeck;
  }

  private function dealCards(){
    $dealed_hand = $this->card_game->dealCards();
    return $dealed_hand;
  }

  # ------------------ TESTS ------------------

  public function testDeckCardCount(){
    $this->assertEquals(52, $this->getDeckLength());
  } 

  public function testDealedSevenCards(){
    $dealed_hand_length = sizeof($this->dealCards());
    $this->assertEquals(7, $dealed_hand_length);
  }

  public function testDealedCardsRemovesSevenFromDeck(){
    $this->assertEquals(52, $this->getDeckLength());
    $this->dealCards();
    $this->assertEquals(45, $this->updateDeck());
  }

  public function testDealedCardsRemovedFromDeck(){
    $cards = $this->dealCards();
    foreach($cards as $card){
      $this->assertNotContains($card, $this->card_game->getDeck());
    }
  }

  public function testCardGameStartsWithFourPlayers(){
    $game_players = $this->card_game->playerCount();
    $this->assertEquals(4, $game_players);
  }
}