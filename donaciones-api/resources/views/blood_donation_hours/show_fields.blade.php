<!-- Days Field -->
<div class="col-sm-12">
    {!! Form::label('days', 'Days:') !!}
    <p>{{ $bloodDonationHour->days }}</p>
</div>

<!-- Start Time Field -->
<div class="col-sm-12">
    {!! Form::label('start_time', 'Start Time:') !!}
    <p>{{ $bloodDonationHour->start_time }}</p>
</div>

<!-- End Time Field -->
<div class="col-sm-12">
    {!! Form::label('end_time', 'End Time:') !!}
    <p>{{ $bloodDonationHour->end_time }}</p>
</div>

<!-- Donation Id Field -->
<div class="col-sm-12">
    {!! Form::label('donation_id', 'Donation Id:') !!}
    <p>{{ $bloodDonationHour->donation_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $bloodDonationHour->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $bloodDonationHour->updated_at }}</p>
</div>

