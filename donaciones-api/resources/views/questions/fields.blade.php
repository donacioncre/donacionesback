<!-- Ask Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ask', 'Ask:') !!}
    {!! Form::text('ask', null, ['class' => 'form-control']) !!}
</div>

<!-- Answer Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('answer', 'Answer:') !!}
    {!! Form::textarea('answer', null, ['class' => 'form-control']) !!}
</div>