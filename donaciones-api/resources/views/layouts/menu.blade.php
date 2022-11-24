<li class="nav-item">
    
</li>


<li class="nav-item">
    <a href="{{ route('questions.index') }}"
       class="nav-link {{ Request::is('questions*') ? 'active' : '' }}">
        <p>Questions</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('newCalls.index') }}"
       class="nav-link {{ Request::is('newCalls*') ? 'active' : '' }}">
        <p>New Calls</p>
    </a>
</li>


