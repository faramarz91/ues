@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        @role(\App\Enums\UserRole::Admin->value) Admin Panel @endrole
                        @role(\App\Enums\UserRole::Teacher->value) Panel @endrole
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form repeater-default" method="post" id="question" action="{{route('admin.exams.store')}}">
                            @csrf
                            <div class="col-12 mb-5">
                                <label for="title" class="form-label">About this question</label>
                                <input type="text" name="title" value="{{old('title')}}" placeholder="title" class="form-control @error('title') is-invalid @enderror" id="title">
                            </div>
                            <div data-repeater-list="questions">
                            @if(old('questions') && count(old('questions'))>=1)
                                @foreach(old('questions') as $index => $old_q)
                                    <div data-repeater-item>
                                        <div class="row justify-content-between">
                                            <div class="col-12">
                                                <label for="question" class="form-label">Question</label>
                                                <input type="text" name="question[][question]" class="form-control @error('questions.'.$index.'.question') is-invalid @enderror" id="question"
                                                    value="{{$old_q['question']}}">
                                            </div>
                                            <div class="col-6">
                                                <label for="ans1" class="form-label">A:</label>
                                                <input type="text" name="question[][A]" class="form-control @error('questions.'.$index.'.A') is-invalid @enderror" id="ans1"
                                                    value="{{$old_q['A']}}">
                                            </div>
                                            <div class="col-6">
                                                <label for="ans2" class="form-label">B:</label>
                                                <input type="text" name="question[][B]" class="form-control @error('questions.'.$index.'.B') is-invalid @enderror" id="ans2"
                                                       value="{{$old_q['B']}}">
                                            </div>
                                            <div class="col-6">
                                                <label for="ans3" class="form-label">C:</label>
                                                <input type="text" name="question[][C]" class="form-control @error('questions.'.$index.'.C') is-invalid @enderror" id="ans3"
                                                    value="{{$old_q['C']}}">
                                            </div>
                                            <div class="col-6">
                                                <label for="ans4" class="form-label">D:</label>
                                                <input type="text" name="question[][D]" class="form-control @error('questions.'.$index.'.D') is-invalid @enderror" id="ans4"
                                                    value="{{$old_q['D']}}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputState" class="form-label">Correct Answer</label>
                                                <select id="inputState" name="question[][correct]" class="form-select @error('questions.'.$index.'.correct') is-invalid @enderror">
                                                    <option selected disabled>Choose...</option>
                                                    <option value="A" @if(old('questions.'.$index.'.correct')=== "A") selected @endif>A</option>
                                                    <option value="B" @if(old('questions.'.$index.'.correct')=== "B") selected @endif>B</option>
                                                    <option value="C" @if(old('questions.'.$index.'.correct')=== "C") selected @endif>C</option>
                                                    <option value="D" @if(old('questions.'.$index.'.correct')=== "D") selected @endif>D</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-sm-12 form-group d-flex align-items-center pt-2">
                                                <button class="btn btn-danger" data-repeater-delete type="button"> <i class="bx bx-x"></i>
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                @endforeach
                            @else
                                <div data-repeater-item>
                                    <div class="row justify-content-between">
                                        <div class="col-12">
                                            <label for="question" class="form-label">Question</label>
                                            <input type="text" name="question[][question]" class="form-control" id="question">
                                        </div>
                                        <div class="col-6">
                                            <label for="ans1" class="form-label">A:</label>
                                            <input type="text" name="question[][A]" class="form-control" id="ans1">
                                        </div>
                                        <div class="col-6">
                                            <label for="ans2" class="form-label">B:</label>
                                            <input type="text" name="question[][B]" class="form-control" id="ans2">
                                        </div>
                                        <div class="col-6">
                                            <label for="ans3" class="form-label">C:</label>
                                            <input type="text" name="question[][C]" class="form-control" id="ans3">
                                        </div>
                                        <div class="col-6">
                                            <label for="ans4" class="form-label">D:</label>
                                            <input type="text" name="question[][D]" class="form-control" id="ans4">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputState" class="form-label">Correct Answer</label>
                                            <select id="inputState" name="question[][correct]" class="form-select">
                                                <option selected disabled>Choose...</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-sm-12 form-group d-flex align-items-center pt-2">
                                            <button class="btn btn-danger" data-repeater-delete type="button"> <i class="bx bx-x"></i>
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            @endif
                            </div>
                            <div class="form-group">
                                <div class="col p-0">
                                    <button class="btn btn-primary" data-repeater-create type="button"><i class="bx bx-plus"></i>
                                        Add
                                    </button>
                                </div>
                            </div>
                        </form>
                        <button type="submit" form="question" class="btn btn-secondary mt-5">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pageScript')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{asset('scripts/jquery.repeater.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            'use strict';

            // form repeater jquery
            $('.invoice-repeater, .repeater-default').repeater({
                show: function () {
                    $(this).slideDown();
                    // Feather Icons
                    if (feather) {
                        feather.replace({ width: 14, height: 14 });
                    }
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });
        });
    </script>
@endsection
