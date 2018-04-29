<?php

use PHPUnit\Framework\TestCase;

class DeckTest extends TestCase{
  
  # ------------------ HELPERS ------------------

  protected $deck;
  protected $deck_cards;
  protected $set = Deck::CARD_SET;

  protected function setUp(){
    $this->deck = new Deck();
    $this->deck_cards = $this->deck->cards();
  }

  private function createCardSuit($suit, $set){
    $suit_set = [];
    foreach($set as $card){
      array_push($suit_set, array($suit, $card));
    }
    return $suit_set;
  }

  private function getCardSection($start, $end){
    $card_section = array_splice($this->deck_cards, $start, $end);
    return $card_section;
  }

  # ------------------ TESTS ------------------

  public function testDeckCardCount(){
    $this->assertEquals(52, sizeof($this->deck_cards));
  }

  public function testDeckFirstCard(){
    $this->assertArraySubset(['Hearts', 'Ace'],$this->deck_cards[0]);
  }

  public function testDeckLastCard(){
    $this->assertArraySubset(['Diamonds', 'King'],$this->deck_cards[51]);
  }  

  public function testHeartSequence(){
    $hearts = $this->getCardSection(0, 13);
    $this->assertArraySubset($this->createCardSuit("Hearts", $this->set),$hearts);
  }

  public function testClubSequence(){
    $clubs = $this->getCardSection(13, 26);
    $this->assertArraySubset($this->createCardSuit("Clubs", $this->set),$clubs);
  }

  public function testSpadeSequence(){
    $spades = $this->getCardSection(26,39);
    $this->assertArraySubset($this->createCardSuit("Spades", $this->set),$spades);
  }

  public function testDiamondSequence(){
    $diamonds = $this->getCardSection(39,52);
    $this->assertArraySubset($this->createCardSuit("Diamonds", $this->set),$diamonds);
  }

}