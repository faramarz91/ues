@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
            <h1 class="display-4 fw-normal">All Student Result</h1>
            <p class="fs-5 text-muted">Lorem ipsum Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
        </div>
        <div class="row justify-content-center mb-3 text-center">
            <div class="col-5">
                <div class="card mb-4 rounded-3 shadow-sm border-primary">
                    <div class="card-header py-3 text-white bg-primary border-primary">
                        <h4 class="my-0 fw-normal">Result</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">{{$userExams->sum('score')}}<small class="text-muted fw-light">/100</small></h1><spqn>Total Score</spqn>
                        <ul class="list-unstyled mt-3 mb-4 mx-auto">
                            <li><span class="text-success fw-bold">{{$userExams->sum('total_correct')}} Correct</span> answer OF <span class="text-black-50 text-decoration-underline fw-bolder">{{ $total_questions}}</span></li>
                            <li><span class="text-danger fw-bold">{{$userExams->sum('total_false')}} False</span> answer in <span class="text-black-50 text-decoration-underline fw-bolder">{{$userExams->count()}} exams</span></li>
                        </ul>
                        <a href="{{route('admin.exams.index')}}" type="button" class="w-100 btn btn-lg btn-primary">Quiz list</a>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="display-6 text-center mb-4">All Exams Result foreach student</h2>

        <div class="table-responsive">
            <table class="table text-center">
                <thead>
                <tr>
                    <th style="width: 34%;">user->count</th>
                    <th style="width: 22%;">Correct</th>
                    <th style="width: 22%;">False</th>
                    <th style="width: 22%;">Score</th>
                </tr>
                </thead>
                <tbody>
                @foreach($candidate_users->get() as $user)
                    <tr>
                        <th scope="row" class="text-start">{{$user->email}} -> {{$user->takenTest->count()}}</th>
                        <td>{{$user->takenTest()->sum('total_correct')}}</td>
                        <td>{{$user->takenTest()->sum('total_false')}}</td>
                        <td>{{$user->takenTest()->sum('score')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

