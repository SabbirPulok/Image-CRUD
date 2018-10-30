@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        <div class="col-md-10">
            <h1> Task Images</h1>
        </div>
        <div class="col-md-2">
            <a href="{{ route('tasks.create') }}" class="btn btn-lg btn-outline-danger btn-h1-spacing-top">Upload a Image</a>
        </div>
        </div>
        <hr>
        <div class="row">



            @foreach($tasks as $task)
                    <div class="col-md-4 padd">
                        <div class="card" style="width: 18rem;">

                            <img class="card-img-top" src="{{asset('images/'.$task->images) }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{$task->title}}</h5>
                                {{--<p class="card-text">{{$task->title}}</p>--}}
                                {{--<a href="route{{'tasks.edit'}}" class="btn btn-primary btn-sm">Edit</a>--}}
                                {{--<a href="route{{'tasks.delete'}}" class="btn btn-danger btn-sm">Delete</a>--}}
                                <div class="row">
                                    <div class="col-sm-6">
                                        {!! Html::linkRoute('tasks.edit','Edit',array($task->id),array('class'=>'btn btn-primary btn-block')) !!}
                                    </div>
                                    <div class="col-sm-6">
                                        {!! Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'DELETE']) !!}

                                        {!! Form::submit('Delete',['class' => 'btn btn-danger btn-block']) !!}

                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
            <hr>
                <div class="text-center float">
                    {!! $tasks->links(); !!}
                </div>
            @endforeach


        </div>

    </div>
@endsection