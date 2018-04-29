<?php

use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase{
  public function testEnvironment(){
    $this->assertEquals('Hello', Player::sayHello());
  }
}