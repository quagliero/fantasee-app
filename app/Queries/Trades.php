<?php namespace Fantasee\Queries;

use Fantasee\Trade\Trade;
use Illuminate\Database\Eloquent\Collection;

class Trades
{
    /**
     * @var Collection
     */
    private $trades;

    public function __construct(Collection $trades) {
        $trades->each(function ($t) {
           if (!$t instanceof Trade) {
               throw new \InvalidArgumentException("Trades query requires collection of trades.");
           }
        });

        $this->trades = $trades;
    }

    public function getMostCommonlyTradedPlayer() {
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

        return $mostCommon;
    }
}