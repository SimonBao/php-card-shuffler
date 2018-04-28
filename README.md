# Project Description

You have a deck of 52 cards, comprised of 4 suits (hearts, clubs, spades and diamonds) each with 13 values (Ace, two, three, four, five, six, seven, eight, nine, ten, jack, queen and king).

There are four players waiting to play around a table.
The deck arrives in perfect sequence (so, ace of hearts is at the bottom, two of hearts is next, etc. all the way up to king of diamonds on the top).

The task is a simple one. Please create a simple command line program that when executed recreates the scenario above and then performs the following two actions:

- Shuffle the cards - We would like to take the deck that is in sequence and shuffle it so that no two cards are still in sequence.
- Deal the cards - We would then like to deal seven cards to each player (one card to the each player, then a second card to each player, and so on)

There is no need to necessarily do this in a visual way (for example, simply proving with a test that your deck is shuffled and that the players do now have seven cards will be sufficient)
Please supply your solution as a zip file containing any classes, tests, documentation, etc that you have produced.

## Setup

For testing [Composer](https://getcomposer.org/doc/00-intro.md#using-composer) is required, click on the link and follow installation procedure. I have setup Composer to be used globally.

To install dependencies:
```
$ composer install
```

To regenerate autoload to include our src:
```
$ composer dump-autoload
```

To run tests:
```
$ ./vendor/bin/phpunit tests
```
#### Extra Information

New classes created in the src folder will not be found by PHPUnit tests automatically. You will need to regenerate the autoload file.

## Modules/Packages

For this project I used [Composer](https://github.com/composer/composer) as my dependency manager.

#### Development Dependencies

- [PHPUnit](https://github.com/sebastianbergmann/phpunit) - Testing Framework
