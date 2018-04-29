<?php

use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase{
  
  # ------------------ HELPERS ------------------
  protected $player;

  protected function setUp(){
    $this->player = new Player();
  }

  # ------------------ TESTS ------------------

  public function testEmptyHand(){
    $player_hand = $this->player->hand();
    $this->assertEmpty($player_hand);
  }

  public function testPlayerRecievesCard(){
    $player = $this->player;
    $player->obtainCard(array('Hearts', 'Ace'));
    $this->assertArraySubset([['Hearts', 'Ace']], $player->hand());
  }
}