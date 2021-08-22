@extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		@if (\Session::has('success'))
		      <div class="alert alert-success">
		        <p>{{ \Session::get('success') }}</p>
		      </div><br />
		     @endif
		   <div class="panel panel-default">
		         <div class="panel-heading">
		             <h2>Calendario Interno </h2>
		         </div>
		         <div class="panel-body" >
		            {!! $calendar->calendar() !!}
		        </div>
		    </div>
		</div>
	</div>	    
</div>

@push ('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
{!! $calendar->script() !!}
@endpush
@endsection


