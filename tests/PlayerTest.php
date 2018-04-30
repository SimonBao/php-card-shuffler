<?php

use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase{
  
  # ------------------ HELPERS ------------------
  protected $player;

  protected function setUp(){
    $this->player = new Player();
  }

  private function givePlayerCard($player, $card){
    $player->obtainCard($card);
  }

  private function createCard($suit, $rank){
    $created_card = array($suit, $rank);
    return $created_card;
  }

  private function getHand(){
    $hand = $this->player->getHand();
    return $hand;
  }
  # ------------------ TESTS ------------------

  public function testEmptyHand(){
    $player_hand = $this->getHand();
    $this->assertEmpty($player_hand);
  }
  // This tests each player instance starts with an empty hand.

  public function testPlayerRecievesCard(){
    $player = $this->player;
    $card = $this->createCard('Hearts', 'Ace');
    $this->givePlayerCard($player, $card);
    $this->assertArraySubset([['Hearts', 'Ace']], $this->getHand());
  }
  // This tests if the argument passed to player is stored as intended.

  public function testPlayerRecievesMultipleCards(){
    $player = $this->player;
    $king_of_spades = $this->createCard('Spades', 'King');
    $this->givePlayerCard($player, $king_of_spades);
    $this->assertEquals([$king_of_spades], $this->getHand());
    $three_of_clubs = $this->createCard('Clubs', 'Three');
    $this->givePlayerCard($player, $three_of_clubs);
    $this->assertEquals([$king_of_spades, $three_of_clubs], $this->getHand());
  }
  // This tests if the multiple argument passed to player are stored correctly.

}