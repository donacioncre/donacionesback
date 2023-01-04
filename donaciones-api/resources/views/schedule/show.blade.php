@extends('layouts.app')

@section('scripts')

<link rel="stylesheet" href="{{asset('fullcalendar/packages/core/main.css')}}" />
<link rel="stylesheet" href="{{asset('fullcalendar/packages/daygrid/main.css')}}" />
<link rel="stylesheet" href="{{asset('fullcalendar/packages/list/main.css')}}" />
<link rel="stylesheet" href="{{asset('fullcalendar/packages/timegrid/main.css')}}" />






<script src="{{asset('fullcalendar/packages/core/main.js')}}" defer></script>
<script src="{{asset('fullcalendar/packages/core/locales-all.js')}}" defer></script>

<script src="{{asset('fullcalendar/packages/interaction/main.js')}}" defer></script>
<script src="{{asset('fullcalendar/packages/daygrid/main.js')}}" defer></script>
<script src="{{asset('fullcalendar/packages/timegrid/main.js')}}" defer></script>
<script src="{{asset('fullcalendar/packages/list/main.js')}}" defer></script>




@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1>{{$donation->name}}</h1>
                </div>
                <div class="col-sm-4">
                    <a class="btn btn-default float-right"
                       href="{{ route('schedule.index') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('schedule.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
