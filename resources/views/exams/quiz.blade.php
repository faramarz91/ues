@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
            <h1 class="display-4 fw-normal">{{$exam->title}}</h1>
            <p class="fs-5 text-muted">Lorem ipsum Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
        </div>

        <form action="{{route('take-test.store', $exam)}}" method="post" id="quiz">
        @csrf
        @php
            $i=1;
        @endphp
        @foreach($exam->questions as $index => $question)
        <div class="heaader mt-4">
            <h2>#{{$i++}}: {{$question['question']}}</h2>
        </div>
        <div class="list-group list-group-checkable d-grid gap-2 border-0 w-auto">
            <input class="list-group-item-check pe-none" type="radio" name="answers[{{$index}}]" id="A_{{$index}}" value="A">
            <label class="list-group-item rounded-3 py-3" for="A_{{$index}}">
                A:
                <span class="d-block small opacity-50">{{$question['A']}}</span>
            </label>

            <input class="list-group-item-check pe-none" type="radio" name="answers[{{$index}}]" id="B_{{$index}}" value="B">
            <label class="list-group-item rounded-3 py-3" for="B_{{$index}}">
                B:
                <span class="d-block small opacity-50">{{$question['B']}}</span>
            </label>

            <input class="list-group-item-check pe-none" type="radio" name="answers[{{$index}}]" id="C_{{$index}}" value="C">
            <label class="list-group-item rounded-3 py-3" for="C_{{$index}}">
                C:
                <span class="d-block small opacity-50">{{$question['C']}}</span>
            </label>

            <input class="list-group-item-check pe-none" type="radio" name="answers[{{$index}}]" id="D_{{$index}}" value="D">
            <label class="list-group-item rounded-3 py-3" for="D_{{$index}}">
                D:
                <span class="d-block small opacity-50">{{$question['D']}}</span>
            </label>
        </div>
        @endforeach

        </form>

        <button type="submit" form="quiz">Submit</button>

    </div>
@endsection

