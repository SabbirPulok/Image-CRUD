@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-7">
            {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method'=>'PUT','files'=>true ])!!}

            {{Form::label('title','Image Title:')}}
            {{Form::text('title',$task->title,[ "class"=> 'form-control'])}}

            {{Form::label('upload_image','Update Your Image:')}}
            {{Form::file('upload_image')}}
            <hr>
            <div class="row">

                <div class="col-sm-3">
                    {!! Html::linkRoute('tasks.index','Cancel',array(),array('class'=>'btn btn-danger btn-block')) !!}
                </div>
                <div class="col-sm-3">
                    {{Form::submit('Save',['class'=>'btn btn-success btn-block'])}}

                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card btn-h1-spacing">
                <div class="card-body">
                    <dl>
                        <dt>Created At: </dt>
                        <dd>{{ date('M j,Y h:i a',strtotime($task->created_at)) }}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Last updated At: </dt>
                        <dd>{{ date('M j,Y h:i a',strtotime($task->updated_at)) }}</dd>
                    </dl>

                </div>
            </div>
        </div>
        {!! Form::close()!!}
    </div>
@endsection