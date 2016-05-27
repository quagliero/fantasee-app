<ul class="nav nav-pills">
  <li {{ $active == 'standings' ? 'class=active' : '' }}>{!! link_to_route('league_season_path', 'Standings', [$league->slug, $season->year]) !!}</li>
  <li {{ $active == 'schedule' ? 'class=active' : '' }}>{!! link_to_route('league_season_week_path', 'Schedule', [$league->slug, $season->year, 1]) !!}</li>
  <li {{ $active == 'draft' ? 'class=active' : '' }}>{!! link_to_route('league_season_draft_path', 'Draft', [$league->slug, $season->year]) !!}</li>
  <li {{ $active == 'trades' ? 'class=active' : '' }}>{!! link_to_route('league_season_trade_path', 'Trades', [$league->slug, $season->year]) !!}</li>
</ul>
