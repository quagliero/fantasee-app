<?php
use Fantasee\Team;
use Fantasee\Match;
use Fantasee\League;

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
