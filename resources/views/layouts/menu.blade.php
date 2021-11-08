<li class="nav-item">
    <a href="{{ route('lanuds.index') }}"
       class="nav-link {{ Request::is('lanuds*') ? 'active' : '' }}">
        <p>Lanuds</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('estimates.index') }}"
       class="nav-link {{ Request::is('estimates*') ? 'active' : '' }}">
        <p>Estimates</p>
    </a>
</li>


