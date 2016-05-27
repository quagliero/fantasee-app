<?php namespace Fantasee\Http\Controllers;


use Fantasee\Trade\Trade;

class TradesController extends Controller {

  /**
   * @var Trade
   */
  private $trade;

  public function __construct(Trade $trade) {

    $this->trade = $trade;
  }

  public function summary($id) {
    return $this->trade->findOrFail($id)->toArray();
  }
}