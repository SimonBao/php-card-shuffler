<?php

use PHPUnit\Framework\TestCase;

class DeckTest extends TestCase{
  # ------------------ HELPERS ------------------

  protected $deck;
  protected $deck_cards;

  protected function setUp(){
    $this->deck = new Deck();
    $this->deck_cards = $this->deck->cards();
  }

  

  # ------------------ TESTS ------------------

  public function testDeckCardCount(){
    $this->assertEquals(52, sizeof($this->deck_cards));
  }

  public function testDeckFirstCard(){
    $this->assertArraySubset(['Hearts', 'Ace'],$this->deck_cards[0]);
  }

}