@extends('layouts.app')

@section('content')
    <main>
        <div class="container">
            <div class="accordion" id="accordionExample">
                <div class="card-title">
                    <div class="row justify-content-between">
                        <div class="col-3">
                            <p>Exam title:</p>
                            <h1 class="card-title text-primary">{{$exam->title}}</h1>
                        </div>
                        <div class="col-2 me-0">
                            <form hidden id="question_submit" action="{{route('admin.exam.submit', $exam)}}" method="post">
                                @csrf
                                @method('patch')
                            </form>
                            <button type="submit" form="question_submit" class="btn btn-info">Approve This Quiz?</button>
                        </div>
                    </div>
                    <hr>
                </div>
                @foreach($exam->questions as $question)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="{{"question-".$loop->index}}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{"question-collapse-".$loop->index}}" aria-expanded="true" aria-controls="{{"question-collapse-".$loop->index}}">
                            Question Item #{{$loop->index+1}}
                        </button>
                    </h2>
                    <div id="{{"question-collapse-".$loop->index}}" class="accordion-collapse collapse @if($loop->first) show @endif" aria-labelledby="{{"question-".$loop->index}}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>question:</p>
                            <h3>
                                <strong>{{$question['question']}}</strong>
                            </h3>
                            <hr>
                            <div class="row justify-content-end">
                                <div class="col-4 mx-auto card my-2 @if(ucwords($question['correct']) == 'A') bg-success @endif">
                                    A:
                                    <div class="card-body">{{$question['A']}}</div>
                                </div>
                                <div class="col-4 mx-auto card my-2 @if(ucwords($question['correct']) == 'B') bg-success @endif">
                                    B:
                                    <div class="card-body">{{$question['B']}}</div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-4 mx-auto card my-2 @if(ucwords($question['correct']) == 'C') bg-success @endif">
                                    C:
                                    <div class="card-body">{{$question['C']}}</div>
                                </div>
                                <div class="col-4 mx-auto card my-2 @if(ucwords($question['correct']) == 'D') bg-success @endif">
                                    D:
                                    <div class="card-body">{{$question['D']}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection

