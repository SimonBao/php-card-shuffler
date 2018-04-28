<?php

use PHPUnit\Framework\TestCase;

class CardGameTest extends TestCase{

  public function testDeckCardCount()
  {
    $card_game = new CardGame();
    $deck_length = sizeof($card_game->getDeck());
    $this->assertEquals(52, $deck_length);
  } 

  public function testDealedSevenCards()
  {
    $card_game = new CardGame();
    $dealed_hand_length = sizeof($card_game->dealCards());
    $this->assertEquals(7, $dealed_hand_length);
  }
}