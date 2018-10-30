@extends('layouts.app')
@section('content')
    <div class="container">
    <div class="col-md-6 col-md-offset-3">
    {!! Form::open(array('route' => 'tasks.store','files'=>true)) !!}
    {{Form::label('title',"Image Title")}}

    {{Form::text('title',null,array('class' => 'form-control'))}} <hr>
    {{Form::label('upload_image','Upload')}}<hr>
    {{Form::file('upload_image')}}

    {{Form::submit('Upload',array('class'=>'btn btn-primary btn-lg btn-block', 'style' =>'margin-top: 20px;'))}}
    {!! Form::close() !!}
    </div>
    </div>
@endsection