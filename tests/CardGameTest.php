<?php

use PHPUnit\Framework\TestCase;

class CardGameTest extends TestCase{
  public function testEnvironment()
  {
    $this->assertEquals('Hello', CardGame::sayHello());
  }  
}