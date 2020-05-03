@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">Edit subject</div>
        <div class="card-body">
            {!! Form::open(['url'=>route('subject.update', $subject->id),'method'=>'patch']) !!}
                <div class="row">
                    <label>Name</label>
                    <input name="name" class="form-control" value="{{$subject->name}}">
                </div>
                <div class="row">
                    <label>Students</label>
                    {{ Form::select('students_id[]', $students, $subject->students, ['multiple' => 'multiple', 'class'=>'form-control select2']) }}
                </div>
                <input type="submit" value="Save" class="btn btn-success">
            {{Form::close()}}
        </div>
    </div>
@endsection