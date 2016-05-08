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

        <li class="divider"></li>

        <li>
            <a href="/logout">
                <i class="fa fa-btn fa-fw fa-sign-out"></i>Logout
            </a>
        </li>
    </ul>
</li>
