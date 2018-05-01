<?php

use PHPUnit\Framework\TestCase;

class DeckTest extends TestCase{
  
  # ------------------ HELPERS ------------------

  protected $deck;
  protected $ranks = array(
    'Ace', 'Two', 'Three',
    'Four', 'Five', 'Six',
    'Seven', 'Eight', 'Nine',
    'Ten', 'Jack', 'Queen',
    'King'
  );
  /*
  These are the ranks found in the traditional French card deck.
  */

  protected function setUp(){
    $this->deck = new Deck();
  }
  /* This is a PHPUnit fixture which runs before each test. This enables creating clean testing environment,
  and enables setting up code which is required by every test.
  */
  
  private function createCardSuit($suit, $ranks){
    $suit_ranks = [];
    foreach($ranks as $rank){
      array_push($suit_ranks, array($suit, $rank));
    }
    return $suit_ranks;
  }
  /*
  helper function createCardSuit uses provided suit/rank arguments to 
  determine what cards to create. Does this by iterating through every element in ranks and 
  bundles them together with the provided suit to create the card.
  */

  private function getCardSection($start, $end){
    $deck_cards = $this->getDeckCards();
    $card_section = array_splice($deck_cards, $start, $end);
    return $card_section;
  }
  /*
  helper function getCardSection uses provided start/end arguments to 
  determine how many cards to remove from the deck starting from beginning of deck.
  */

  private function getDeckCards(){
    $deck_cards = $this->deck->getCards();
    return $deck_cards;
  }
  /*
  helper function getDeckCards returns variable deck_cards,
  which is all the cards in the deck as an array.
  */

  private function getDeckLength(){
    $deck_length = $this->deck->getDeckLength();
    return $deck_length;
  }
  /*
  Returns numeral count of elements stored in the deck as integer.
  */

  private function removeCard(){
    $removed_card = $this->deck->removeCard();
    return $removed_card;
  }

  # ------------------ TESTS ------------------

  public function testDeckCardCount(){
    $this->assertEquals(52, sizeof($this->getDeckCards()));
  }

  public function testDeckFirstCard(){
    $this->assertArraySubset(['Hearts', 'Ace'],$this->getDeckCards()[0]);
  }
  /*
  Expects first card to be Ace of Hearts.
  */

  public function testDeckLastCard(){
    $this->assertArraySubset(['Diamonds', 'King'],$this->getDeckCards()[51]);
  }  
  /*
  Expects last card to be King of Diamonds.
  */

  public function testHeartSequence(){
    $hearts = $this->getCardSection(0, 13);
    $this->assertArraySubset($this->createCardSuit("Hearts", $this->ranks),$hearts);
  }
  /*
  Compares the first 13 cards in deck with a sorted hearts suit in ascending order from Ace to King.
  */

  public function testClubSequence(){
    $clubs = $this->getCardSection(13, 26);
    $this->assertArraySubset($this->createCardSuit("Clubs", $this->ranks),$clubs);
  }
  /*
  Expects second section to follow suit and ranking system of traditional French card decks,
   in ascending order.
  */

  public function testSpadeSequence(){
    $spades = $this->getCardSection(26,39);
    $this->assertArraySubset($this->createCardSuit("Spades", $this->ranks),$spades);
  }

  public function testDiamondSequence(){
    $diamonds = $this->getCardSection(39,52);
    $this->assertArraySubset($this->createCardSuit("Diamonds", $this->ranks),$diamonds);
  }

  public function testRemoveCard(){
    $card = $this->removeCard();
    $deck_length = $this->getDeckLength();
    $this->assertEquals(51, $deck_length);
  }
  /* Expects a card to be removed from deck */

  public function testRemovedCardFromDeck(){
    $card = $this->removeCard();
    $cards = $this->getDeckCards();
    $this->assertNotContains($card, $cards);
  }
  /* 
  Expects removed card to no longer exist in deck.
  E.g. removing 'Ace of Hearts' through removeCard means
  'Ace of Hearts' get removed from deck, not any other card.
  */

}