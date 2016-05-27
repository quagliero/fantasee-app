<ul class="nav nav-pills">
  <li {{ $active == 'managers' ? 'class=active' : '' }}>{!! link_to_route('league_path', 'Managers', [$league->slug]) !!}</li>
  <li {{ $active == 'teams' ? 'class=active' : '' }}>{!! link_to_route('league_teams_path', 'Teams', [$league->slug]) !!}</li>
  <li {{ $active == 'drafts' ? 'class=active' : '' }}>{!! link_to_route('league_drafts_path', 'Drafts', [$league->slug]) !!}</li>
  <li {{ $active == 'trades' ? 'class=active' : '' }}>{!! link_to_route('league_trades_path', 'Trades', [$league->slug]) !!}</li>
</ul>
