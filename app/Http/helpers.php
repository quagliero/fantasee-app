<?php
use Fantasee\Team;
use Fantasee\Match;
use Fantasee\League;
use Fantasee\Manager;
use Fantasee\Season;

/* Totals */

function league_count()
{
  return League::get()->count();
}

function manager_count()
{
  return Manager::get()->count();
}

function team_count()
{
  return Team::get()->count();
}

function match_count()
{
  return Match::get()->count();
}

/* random words and sentences */

function get_random_splash_word()
{
  $words = ['nerds', 'addicts', 'heroes', 'studs', 'data hoarders', 'junkies', 'stat lovers', 'lovers'];
  $rand = round(mt_rand(0, count($words) - 1));

  return $words[$rand];
}

function get_random_register_analogy()
{
  $analogies = ['in a 2-for-1', 'if Chip Kelly takes over', 'for LT in his prime', 'for a first round pick this year AND next'];
  $rand = round(mt_rand(0, count($analogies) - 1));

  return $analogies[$rand];
}

function delete_form($routeParams, $label = 'Delete')
{
  $form = Form::open(['method' => 'DELETE', 'route' => $routeParams]);
  $form .= Form::submit('Delete', ['class' => 'btn btn-danger']);
  $form .= Form::close();

  return $form;
}

function get_team_name_from_id($team_id)
{
  $team = Team::where('id', $team_id)->first();
  return $team->name;
}

function get_match_winner($match_id)
{
  $match = Match::where('id', $match_id)->first();
  if ($match->team1_score == $match->team2_score) {
    $draw = new Team;
    $draw->name = 'Draw';
    return $draw;
  } elseif ($match->team1_score > $match->team2_score) {
    return Team::where('id', $match->team1_id)->first();
  } else {
    return Team::where('id', $match->team2_id)->first();
  }
}

function is_league_admin($league_id)
{
  $league = League::find($league_id);

  if (Auth::check() && $league->user_id == Auth::user()->id) {
    return true;
  } else {
    return false;
  }
}

function show_trophy($team)
{
  if ($team->position == 1) {
    return '<i class="fa fa-trophy" title="' . $team->season->year . ' Champion" style="color: gold;"></i>';
  }
}

function ordinal($number) {
  $ends = array('th','st','nd','rd','th','th','th','th','th','th');
  if ((($number % 100) >= 11) && (($number%100) <= 13)) {
      return $number. 'th';
    }
  else {
    return $number. $ends[$number % 10];
  }
}
