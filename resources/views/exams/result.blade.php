@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
            <h1 class="display-4 fw-normal">{{$userExam->exam->title}} Result</h1>
            <p class="fs-5 text-muted">Lorem ipsum Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
        </div>
        <div class="row justify-content-center mb-3 text-center">
            <div class="col-5">
                <div class="card mb-4 rounded-3 shadow-sm border-primary">
                    <div class="card-header py-3 text-white bg-primary border-primary">
                        <h4 class="my-0 fw-normal">Result</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">{{$userExam->score}}<small class="text-muted fw-light">/100</small></h1><spqn>Total Score</spqn>
                        <ul class="list-unstyled mt-3 mb-4 mx-auto">
                            <li><span class="text-success fw-bold">{{$userExam->total_correct}} Correct</span> answer OF <span class="text-black-50 text-decoration-underline fw-bolder">{{$userExam->exam->q_count}}</span></li>
                            <li><span class="text-danger fw-bold">{{$userExam->total_false}} False</span> answer Of <span class="text-black-50 text-decoration-underline fw-bolder">{{$userExam->exam->q_count}}</span></li>
                        </ul>
                        <a href="{{route('take-test.index')}}" type="button" class="w-100 btn btn-lg btn-primary">Quiz list</a>
                    </div>
                </div>
            </div>
        </div>

        @role(\App\Enums\UserRole::Student->value)
        <h2 class="display-6 text-center mb-4">All Exams Result of You</h2>

        <div class="table-responsive">
            <table class="table text-center">
                <thead>
                <tr>
                    <th style="width: 34%;"></th>
                    <th style="width: 22%;">Correct</th>
                    <th style="width: 22%;">False</th>
                    <th style="width: 22%;">Score</th>
                </tr>
                </thead>
                <tbody>
                @foreach($takenExam->get() as $examResult)
                <tr>
                    <th scope="row" class="text-start">{{$examResult->title}}</th>
                    <td>{{$examResult->pivot->total_correct}}</td>
                    <td>{{$examResult->pivot->total_false}}</td>
                    <td>{{$examResult->pivot->score}}</td>
                </tr>
                @endforeach
                </tbody>
                <tbody>
                <tr>
                    <th scope="row" class="text-start">All</th>
                    <td class="bg-success">{{$takenExam->sum('user_exams.total_correct')}}</td>
                    <td class="bg-danger">{{$takenExam->sum('user_exams.total_false')}}</td>
                    <td class="bg-primary">{{$takenExam->sum('user_exams.score')}}/{{$takenExam->count() * 100}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        @endrole
    </div>
@endsection

