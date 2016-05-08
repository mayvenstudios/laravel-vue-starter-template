<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        {{ Auth::user()->name }} <span class="caret"></span>
    </a>

    <ul class="dropdown-menu" role="menu">

        @if (isMastermind())

            <li>
                <a href="/mastermind/dashboard">
                    <i class="fa fa-btn fa-fw fa-link"></i> Mastermind
                </a>
            </li>

        @endif

        @if(!isCustomer())
            <li class="divider"></li>
        @endif

        <li class="dropdown-header">Settings</li>

        <li>
            <a href="/settings">
                <i class="fa fa-btn fa-fw fa-cog"></i>User Settings
            </a>
        </li>

        @if(isCustomer())
            <li>
                <a href="/settings/teams/{{ Auth::user()->current_team_id }}">
                    <i class="fa fa-btn fa-fw fa-cog"></i>Team Settings
                </a>
            </li>

            <li class="divider"></li>

            <li class="dropdown-header">Teams</li>

            <li>
                <a href="/settings?tab=teams">
                    <i class="fa fa-btn fa-fw fa-plus"></i>Create New Team
                </a>
            </li>

            @foreach (Auth::user()->teams as $team)
                <li>
                    <a href="/settings/teams/switch/{{ $team->id }}">
                        @if ($team->id === Auth::user()->current_team_id)
                            <i class="fa fa-btn fa-fw fa-check text-success"></i>{{ $team->name }}
                        @else


                            <i class="fa fa-btn fa-fw"></i>{{ $team->name }}

                        @endif
                    </a>
                </li>
            @endforeach
        @endif
        <li class="divider"></li>

        <li>
            <a href="/logout">
                <i class="fa fa-btn fa-fw fa-sign-out"></i>Logout
            </a>
        </li>
    </ul>
</li>
