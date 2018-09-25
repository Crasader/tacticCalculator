<div class="header" id='cssmenu'>
    <div class="header-title">
        <div class="header-title-text">
            <a href="{{ route('home') }}">TacticCalculator</a>
        </div>
    </div>
    <ul>
        <li class="{{ request()->route()->named('home') ? ' active' : '' }}"><a href="{{ route('home') }}">Főoldal</a></li>
        <li class="{{ request()->route()->named('tactic') ? ' active' : '' }}"><a href="{{ route('tactic') }}">Taktikai elemzés</a></li>
        <li class="{{ request()->route()->named('statistic') ? ' active' : '' }}"><a href="{{ route('statistic') }}">Foci statisztikák</a></li>
        <li class="{{ request()->route()->named('tactic-statistic') ? ' active' : '' }}"><a href="{{ route('tactic-statistic') }}">Taktikai statisztikák</a></li>
    </ul>
</div>
