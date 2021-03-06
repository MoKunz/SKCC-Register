@extends('layouts.app')

@section('title')
    {{$contest->name}} - Contest
@endsection

@section('content')
    @if($contest->controller !== 'normal')
        {{-- INSANITY --}}
    @else
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">Contest tasks</div>
                        <div class="panel-body">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <td><strong>#</strong></td>
                                    <td><strong>Name</strong></td>
                                    <td><strong>Result</strong></td>
                                    <td><strong>Score</strong></td>
                                    <td><strong>Action</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    @php
                                        $taskData = (new \App\Judge\TaskData($task->code_name))->data();
                                        $lastSub = \App\Judge\Task::lastSub($task);
                                    @endphp
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$taskData->name.' ('.$task->code_name.')'}}</td>
                                        <td>{{$lastSub->result or '-'}}</td>
                                        <td>{{$lastSub->score >= 0 ? $lastSub->score : '-' }}</td>
                                        <td><a class="btn btn-info btn-sm"
                                               href="{{route('task-view',$task->code_name)}}">View</a>
                                            <a class="btn btn-primary btn-sm"
                                               href="{{route('task-submit',$task['code_name']).'?redirect=contest-view&value='.$contest->id}}">Submit</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Contest details</div>
                        <div class="panel-body">
                            {{$contest->description}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Status</div>
                        <div class="panel-body">
                            <p class="help-block">Not available</p>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Recent activity</div>
                        <div class="panel-body">
                            <p class="help-block">Disabled</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection