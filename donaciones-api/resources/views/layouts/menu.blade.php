<li class="nav-item">

</li>


<li class="nav-item">
    <a href="{{ route('questions.index') }}"
       class="nav-link {{ Request::is('questions*') ? 'active' : '' }}">
        <p>Preguntas</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('newCalls.index') }}"
       class="nav-link {{ Request::is('newCalls*') ? 'active' : '' }}">
        <p>Noticias y Convocatorias</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('donation.index') }}"
       class="nav-link {{ Request::is('donation*') ? 'active' : '' }}">
        <p>Punto de Donación</p>
    </a>
</li>

<li class="nav-item">
    <div class='nav-link dashboard-nav-dropdown'>
        <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle">
            <i class="fas fa-photo-video"></i> Horarios de Donación 
        </a>
        <div class='dashboard-nav-dropdown-menu'>
            <a href="{{ route('bloodDonationHours.index') }}" 
                class=" nav-link  {{ Request::is('bloodDonationHours*') ? 'active' : '' }}  
                    dashboard-nav-dropdown-item">Sangre</a>
           
            <a href="{{ route('plateletDonationHours.index') }}" 
                class=" nav-link  {{ Request::is('plateletDonationHours*') ? 'active' : '' }}  
                    dashboard-nav-dropdown-item">Plaqueta</a>
        </div>
    </div>
</li>




<li class="nav-item">
    <a href="{{ route('schedule.index') }}"
       class="nav-link {{ Request::is('schedule*') ? 'active' : '' }}">
        <p>Agenda Donaciones</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('donationHistories.index') }}"
       class="nav-link {{ Request::is('donationHistories*') ? 'active' : '' }}">
        <p>Historial</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('countries.index') }}"
       class="nav-link {{ Request::is('countries*') ? 'active' : '' }}">
        <p>Provincias</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('cities.index') }}"
       class="nav-link {{ Request::is('cities*') ? 'active' : '' }}">
        <p>Ciudades</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('users.index') }}"
       class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
       <i class="fa fa-user"></i> <p>Usuarios</p>
    </a>
</li>



<li class="nav-item">
    <a href="{{ route('roles.index') }}"
       class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
       <i class="fa fa-user"></i> <p>Roles</p>
    </a>
</li>



@section('javascript')



<style>
  
    .dashboard-nav-dropdown {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
    
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
    }

    .dashboard-nav-dropdown.show {
        background: rgba(255, 255, 255, 0.04);
    }

    .dashboard-nav-dropdown.show > .dashboard-nav-dropdown-toggle {
        font-weight: bold;
    }

    .dashboard-nav-dropdown.show > .dashboard-nav-dropdown-toggle:after {
        -webkit-transform: none;
        -o-transform: none;
        transform: none;
    }

    .dashboard-nav-dropdown.show > .dashboard-nav-dropdown-menu {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
    }

    .dashboard-nav-dropdown-toggle:after {
        content: "";
        margin-left: auto;
        display: inline-block;
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 5px solid rgba(81, 81, 81, 0.8);
        -webkit-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
    }

    .dashboard-nav .dashboard-nav-dropdown-toggle:after {
        border-top-color: rgba(255, 255, 255, 0.72);
    }

    .dashboard-nav-dropdown-menu {
        display: none;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
    }

    .dashboard-nav-dropdown-item {
        min-height: 30px;
        padding: 8px 8px 8px 40px;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        transition: ease-out 0.5s;
    }

    .dashboard-nav-dropdown-item:hover {
        background: rgba(255, 255, 255, 0.04);
    }

</style>



<script>
    const mobileScreen = window.matchMedia("(max-width: 990px )");
    $(document).ready(function () {
        $(".dashboard-nav-dropdown-toggle").click(function () {
            $(this).closest(".dashboard-nav-dropdown")
                .toggleClass("show")
                .find(".dashboard-nav-dropdown")
                .removeClass("show");
            $(this).parent()
                .siblings()
                .removeClass("show");
        });
        
    });
</script>


@stop


