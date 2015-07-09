<?php

use Fantasee\User;
use Fantasee\League;
use Fantasee\Week;
use Fantasee\Team;
use Fantasee\Player;
use Fantasee\Manager;
use Fantasee\Season;
use Fantasee\Trade\TradeStatus;
use Fantasee\Trade\Trade;
use Fantasee\Trade\Exchange;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
$factory->define(User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt($faker->password),
        'role' => 1,
    ];
});
$factory->define(Manager::class, function ($faker) {
  return [
    'name' => $faker->name,
    'site_id' => $faker->randomNumber,
  ];
});
$factory->define(TradeStatus::class, function ($faker) {
    return [
        'display_text' => $faker->word,
    ];
});
$factory->define(Season::class, function ($faker) {
    return [
      'year' => $faker->year,
    ];
});
$factory->define(Exchange::class, function ($faker) {
    return [
    ];
});
$factory->define(Trade::class, function ($faker) {
    return [
    ];
});
$factory->define(League::class, function ($faker) {
    return [
      'name' => $faker->word(6),
      'slug' => $faker->word(3),
      'league_id' => $faker->randomNumber(),
    ];
});
$factory->define(Week::class, function ($faker) {
    return [
      'name' => $faker->word,
    ];
});
$factory->define(Team::class, function ($faker) {
    return [
      'name' => $faker->word,
      'position' => $faker->randomNumber(),
    ];
});
$factory->define(Player::class, function ($faker) {
    return [
      'name' => $faker->word(3),
      'position' => $faker->word(3),
      'site_id' => $faker->unique()->randomNumber(),
    ];
});
