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

  private function checkCardSquence($cards, $i){
    $next_iteration = $i + 1;
    $current_card = $this->createCard($cards[$i]);
    $next_card = $this->createCard($cards[$next_iteration]);
    if($current_card[0] == $next_card[0]){
      $this->assertNotEquals($current_card[1]+1, $next_card[1]);
    }
  }
  /* 
  Helper method creates current card and next card via another helper method,
  if both card suits are equal then expects next card to not match sequence.
  */

  private function createCard($card){
    $card_suit = $this->getCardSuit($card);
    $card_numeral_rank = $this->getCardRank($card);
    return [$card_suit, $card_numeral_rank];
  }
  /* 
  The createdCard method rebuilds the card argument and returns it with,
  value represented by integer value instead of string.
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

  private function getCardSuit($card){
    $card_suit = $card[0];
    return $card_suit;
  }
  /* Returns the card suit */

  private function getCardRank($card){
    $card_rank = array_search($card[1], Deck::CARD_RANKS);
    return $card_rank;
  }
  /* 
  Returns the card rank from String type to relative integer value,
  based on position in ranking system.
  */

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

  public function testShuffleCards(){
    $deck = $this->deck;
    $deck->shuffleCards();
    $shuffled_cards = $deck->getCards();
    $unshuffled_deck = new Deck();
    $unshuffled_cards = $unshuffled_deck->getCards();
    $this->assertNotEquals($shuffled_cards, $unshuffled_cards);
  }
  /* 
  The testShufflecards method expects cards to be shuffled, it does this by
  comparing a shuffled deck with a new sequenced
  */

  public function testShuffledSequence(){
    $deck = $this->deck;
    $deck->shuffleCards();
    $cards = $deck->getCards();
    for($i = 0; $i < sizeof($cards)-1 ; $i++){
      $card = $cards[$i];
      $this->checkCardSquence($cards, $i);
    }
  }
  /* 
  Expects none of the cards are in sequence, tests card for suit and next value.
  */

}