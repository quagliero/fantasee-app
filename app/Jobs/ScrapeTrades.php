<?php namespace Fantasee\Jobs;

use Fantasee\Team;
use Fantasee\Player;
use Fantasee\Trade\Trade;
use Fantasee\Trade\Exchange;
use Fantasee\Week;

class ScrapeTrades extends BaseScraper {

	/**
	 * Create a new Job instance.
	 *
	 * @return void
	 */
	public function __construct($league)
	{
		parent::__construct($league);
	}

	/**
	 * Execute the Job.
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->scrapeTrades($this->league->seasons);
	}

	/**
	 * scrapeTrades
	 * Each teams EXCHANGE of the trade is in its own <tr>, they are grouped by
	 * a common class 'transaction-trade-XXXX-Y'
	 * XXXX is the unique id of the trade in this league,
	 * Y is a number between 1 and 4 which corresponds to:
	 * 1: Players from the Team who offered the trade
	 * 2: Players from the Team who accepted the trade
	 * 3: Any players Team 1 had to drop in the process of completing the trade
	 * 4: Any players Team 2 had to drop in the process of completing the trade
	 * @param  array $seasons
	 * @return void
	 */
	public function scrapeTrades($seasons, $pagination = '') {
		$urlParams = $pagination ?: '?transactionType=trade';

		foreach ($this->league->seasons as $season) {
			$crawler = $this->client->request('GET', $this->baseUrl . '/' . $season->year . '/transactions' . $urlParams);

			$trades = $crawler->filter('#primaryContent #leagueTransactions .tableType-transaction tbody > [class*="transaction-trade-"]');

			// can't figure out why the recursion seems to be hitting links that by all account shouldn't exist
			// this prevents an endless loop by getting out as soon as we hit an empty page
			if ($trades->count() == 0) {
				return false;
			}
			$trades->each(function ($node) use ($season) {
					$trade_info = [];
				  $is_trade = preg_match('/transaction-trade-(.*?)-[12]/', $node->attr('class'), $trade_info);

					if ($is_trade) {
						// skip if it's a vetoed trade
						if (stristr($node->filter('.transactionType')->text(), 'veto')) {
							return;
						}

						$trade_id = $trade_info[1];
						// Try and find the matching week, otherwise it's the "Offseason"
						$week = Week::find($node->filter('.transactionWeek')->text());
						if (is_null($week)) {
							$week = Week::find(Week::OFF_SEASON_ID);
						}

						$losing_team = Team::byLeague($this->league->id)
							->bySeason($season->id)
							->where('name', $node->filter('.transactionFrom .teamName')->text())
							->first();

						$gaining_team = Team::byLeague($this->league->id)
								->bySeason($season->id)
								->where('name', $node->filter('.transactionTo .teamName')->text())
								->first();

						$player_list = $node->filter('.playerNameAndInfo ul > li');
						// if we have players (legacy views sometimes don't)
						if ($player_list->count()) {
							// see if this trade already exists
							$trade = Trade::firstOrCreate([
								'external_id' => $trade_id,
								'trade_status_id' => 4, // 4 is 'accepted'
								'league_id' => $this->league->id,
								'week_id' => $week->id
							]);

							$player_list->filter('.playerNameAndInfo ul > li')->each(function ($player) use ($trade, $gaining_team, $losing_team) {
								$player_info = (object) array(
									'external_id' => preg_replace('/(\D)*/', '', $player->filter('[class*="playerNameId-"]')->attr('class')),
									'name' => $player->filter('.playerName')->text(),
									'position' => explode(' - ', $player->filter('.playerName + em')->text())[0]
								);

								// Create or update this NFL player
								$player = Player::firstOrNew(['site_id' => $player_info->external_id]);
								if ($player->name !== $player_info->name) {
									$player->name = $player_info->name;
								}
								if ($player->position !== $player_info->position) {
									$player->position = $player_info->position;
								}
								$player->save();

								$exchange = Exchange::create([
									'trade_id' => $trade->id,
									'asset_id' => $player->id,
									'asset_type' => Player::class,
									'gaining_team_id' => $gaining_team->id,
									'losing_team_id'  => $losing_team->id,
								]);
							});
						}
					}
			});

			// we have a next page, recursion!
			if ($crawler->filter('#primaryContent #leagueTransactions .paginationWrap .next a')->count()) {
				$next = $crawler->filter('#primaryContent #leagueTransactions .paginationWrap .next a')->attr('href');
				$this->scrapeTrades([$season], $next);
			}
		}

	}

}
