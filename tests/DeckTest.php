<?php

use PHPUnit\Framework\TestCase;

class DeckTest extends TestCase{
  
  # ------------------ HELPERS ------------------

  protected $deck;
  protected $deck_cards;
  protected $ranks = Deck::CARD_RANKS;

  protected function setUp(){
    $this->deck = new Deck();
    $this->deck_cards = $this->deck->cards();
  }

  private function createCardSuit($suit, $ranks){
    $suit_ranks = [];
    foreach($ranks as $card){
      array_push($suit_ranks, array($suit, $card));
    }
    return $suit_ranks;
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
    $this->assertArraySubset($this->createCardSuit("Hearts", $this->ranks),$hearts);
  }

  public function testClubSequence(){
    $clubs = $this->getCardSection(13, 26);
    $this->assertArraySubset($this->createCardSuit("Clubs", $this->ranks),$clubs);
  }

  public function testSpadeSequence(){
    $spades = $this->getCardSection(26,39);
    $this->assertArraySubset($this->createCardSuit("Spades", $this->ranks),$spades);
  }

  public function testDiamondSequence(){
    $diamonds = $this->getCardSection(39,52);
    $this->assertArraySubset($this->createCardSuit("Diamonds", $this->ranks),$diamonds);
  }

}