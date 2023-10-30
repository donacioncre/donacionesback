<aside class="main-sidebar  elevation-4" style="background-color:#d34836 ">
    <a href="{{ url('/home') }}" >
        <img src=" {{ asset('icon/cruzroja.png') }}" style="width: 100%"

             alt="{{ config('app.name') }} Logo"
             class="brand-image  ">
    </a>
    <div class="sidebar">
        <nav class="mt-2" >
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>
</aside>


<style>
    .nav-pills .nav-link {
        color: #fff;
        font-size: 16px;
    }
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        color: #fff;
        background-color: #ad699866;
    }
    .nav-pills .nav-link:not(.active):hover {
        color: #efbc7cbf;
    }
    .text-logo{
        color: #fff;
    }
  </style>
