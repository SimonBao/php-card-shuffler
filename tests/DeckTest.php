<?php

use PHPUnit\Framework\TestCase;

class DeckTest extends TestCase{
  # ------------------ HELPERS ------------------

  protected $deck;

  protected function setUp(){
    $this->deck = new Deck();
  }

  

  # ------------------ TESTS ------------------

  public function testDeckCardCount(){
    $this->assertEquals(52, sizeof($this->deck->cards()));
  }

}