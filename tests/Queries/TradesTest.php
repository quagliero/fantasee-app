<?php

use Fantasee\Player;
use Fantasee\Queries\Trades;
use Fantasee\Team;
use Fantasee\Trade\Exchange;
use Fantasee\Trade\Trade;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TradesTest extends TestCase
{
    private $trades;

    private function pickTeam($not = null) {
        $team = Team::all()->random();

        if ($team->id == $not) {
            $team = $this->pickTeam($not);
        }

        return $team;
    }

    public function setUp() {
        parent::setUp();

        factory(Player::class, 10)->create();
        factory(Team::class, 3)->create();

        $this->trades = factory(Trade::class, 23)->create();
        $this->trades->each(function ($t) {
            $noOfExchanges = rand(1, 3);
            $exchanges = factory(Exchange::class, $noOfExchanges)->create();

            $exchanges->each(function ($e) use ($t) {
                $gainingTeam = $this->pickTeam();
                $losingTeam = $this->pickTeam($gainingTeam->id);

                $e->trade_id = $t->id;
                $e->gaining_team_id = $gainingTeam->id;
                $e->losing_team_id = $losingTeam->id;
                $e->asset_id = Player::all()->random()->id;
                $e->asset_type = Player::class;

                $e->save();
            });
        });
    }

    public function testThrowsIfNonTradeInCollection()
    {
        $this->expectException(InvalidArgumentException::class);

        $collection = new \Illuminate\Database\Eloquent\Collection();

        $collection->add('foo');

        new Trades($collection);
    }

    public function testRetrievesMostCommonlyTradedPlayer() {
        $counts = [];
        $mostCommon = null;

        $this->trades->each(function ($t) use ($counts) {
           $t->exchanges->each(function ($e) use ($counts) {
               if (!isset($counts[$e->asset_id])) {
                   $counts[$e->asset_id] = 0;
               }

               $counts[$e->asset_id] = $counts[$e->asset_id] + 1;
           }) ;
        });

        foreach ($counts as $k => $c) {
            if ($c > $counts[$mostCommon]) {
                $mostCommon = $k;
            }
        }

        $tradeQuery = new Trades($this->trades);

        $this->assertEquals($tradeQuery->getMostCommonlyTradedPlayer(), $mostCommon);
    }
}
