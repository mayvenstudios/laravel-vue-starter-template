<li class="disabled">
    <a href="javascript:;"><strong>Mastermind</strong></a>
</li>

<li class="{{ set_active_from_route_name('mastermind.dashboard') }}">
    <a href="{{ route('mastermind.dashboard') }}">Dashboard</a>
</li>

<li>
    <a href="{{ route('mastermind.logs') }}" target="_blank">Error Logs</a>
</li>

<li>
    <a href="/beanstalkd/public" target="_blank">Queues</a>
</li>