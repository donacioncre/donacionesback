@extends('layouts.app')

@section('content')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
               <div class="page_title">
                  <h2>Dashboard</h2>
               </div>
            </div>
         </div>
        <div class="row column1">
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div> 
                            <i class="fa fa-user yellow_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no">{{$donors}}</p>
                            <p class="head_couter">Usuarios Registrados</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div> 
                            <i class="far fa-hospital red_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no">{{$donationCenter}}</p>
                            <p class="head_couter">Puntos de Donación</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('schedule.index') }}">
                    <div class="full counter_section margin_bottom_30">
                        <div class="couter_icon">
                            <div> 
                                <i class="far fa-calendar-alt orange_color"></i>
                            
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <p class="total_no">Ver</p>
                                <p class="head_couter">Citas</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('calls.index') }}">
                    <div class="full counter_section margin_bottom_30">
                        <div class="couter_icon">
                            <div> 
                                <i class="fas fa-bullhorn blue1_color"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <p class="total_no">Ver</p>
                                <p class="head_couter">Convocatorias de Donación</p>
                            </div>
                        </div>
                    </div>
                </a>
              
            </div>
            
        </div>
    </div>
</div>
@endsection
