<?php namespace Fantasee\Http\Controllers;

use Fantasee\Http\Requests;
use Fantasee\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Goutte\Client;

class ScrapeController extends Controller {

	public function index() {
		$client = new Client();

		$crawler = $client->request('GET', 'http://fantasy.nfl.com/league/874089/history');

		// Get the latest post in this category and display the titles
		$crawler->filter('#historySeasonNav .st-menu a[href]')->each(function ($node) {
			print $node->text()."\n";
		});
	}
}
