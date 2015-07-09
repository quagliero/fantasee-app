<?php

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
$factory->define(TradeStatus::class, function ($faker) {
    return [
        'display_text' => $faker->word,
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
