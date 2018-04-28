<?php

use PHPUnit\Framework\TestCase;

class CardGameTest extends TestCase{
  # ------------------ HELPERS ------------------

  protected $card_game;
  protected $deck_length;

  protected function setUp(){
    $this->card_game = new CardGame();
    $this->deck_length = sizeof($this->card_game->getDeck());
  }

  protected function updateDeck(){
    $updatedDeck = $this->deck_length = sizeof($this->card_game->getDeck());
    return $updatedDeck;
  }

  protected function dealCards(){
    $dealed_hand = $this->card_game->dealCards();
    return $dealed_hand;
  }

  # ------------------ TESTS ------------------

  public function testDeckCardCount()
  {
    $this->assertEquals(52, $this->deck_length);
  } 

  public function testDealedSevenCards()
  {
    $dealed_hand_length = sizeof($this->dealCards());
    $this->assertEquals(7, $dealed_hand_length);
  }

  public function testDealedCardsRemovesSevenFromDeck()
  {
    $this->assertEquals(52, $this->deck_length);
    $this->dealCards();
    $this->assertEquals(45, $this->updateDeck());
  }

  public function testDealedCardsRemovedFromDeck()
  {
    $cards = $this->dealCards();
    foreach($cards as $card){
      $this->assertNotContains($card, $this->card_game->getDeck());
    }
  }

}