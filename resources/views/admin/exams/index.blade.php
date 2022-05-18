@extends('layouts.app')

@section('content')
    <main>

        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Quizzes List</h1>
                    <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
                </div>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($exams as $exam)
                    <div class="col">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <p class="card-text"><a href="{{route('admin.exams.show', $exam)}}">{{$exam->title}}</a></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{route('admin.exams.show', $exam)}}" class="btn btn-sm btn-outline-secondary">View</a>
                                        @role('admin')
                                        <a href="{{route('admin.exams.edit', $exam)}}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                        @endrole
                                    </div>
                                    <small class="text-muted">{{$exam->created_at->diffForHumans()}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </main>
@endsection

