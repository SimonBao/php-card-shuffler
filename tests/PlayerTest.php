<?php

use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase{
  
  # ------------------ HELPERS ------------------
  protected $player;

  protected function setUp(){
    $this->player = new Player();
  }

  protected function givePlayerCard($player, $suit, $rank){
    $player->obtainCard(array($suit, $rank));
  }

  # ------------------ TESTS ------------------

  public function testEmptyHand(){
    $player_hand = $this->player->hand();
    $this->assertEmpty($player_hand);
  }

  public function testPlayerRecievesCard(){
    $player = $this->player;
    $this->givePlayerCard($player, 'Hearts', 'Ace');
    $this->assertArraySubset([['Hearts', 'Ace']], $player->hand());
  }

  public function testPlayerRecievesMultipleCards(){
    $player = $this->player;
    $this->givePlayerCard($player, 'Spades', 'King');
    $this->assertEquals([['Spades', 'King']], $player->hand());
    $this->givePlayerCard($player, 'Clubs', 'Three');
    $this->assertEquals([['Spades', 'King'],['Clubs', 'Three']], $player->hand());
  }

}