<?php

use PHPUnit\Framework\TestCase;

class CardGameTest extends TestCase{

  public function testDeckCardCount()
  {
    $card_game = new CardGame();
    $deck = $card_game->getDeck();
    $this->assertEquals(52, sizeof($deck));
  } 
}