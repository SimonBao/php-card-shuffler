<?php

use PHPUnit\Framework\TestCase;

class DeckTest extends TestCase{
  public function testEnvironment()
  {
    $this->assertEquals('Hello', Deck::sayHello());
  }
}