@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Questions</h2>
                        <div class="ml-auto">
                            <a class="btn btn-outline-secondary" href=" {{route('questions.create')}} ">
                                Ask question
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($question as $questions)
                    <div class="media">
                        <div class="d-flex flex-column counters">
                            <div class="vote">
                                <strong> {{ $questions->votes }} </strong> {{ str_plural('vote', $questions->votes) }}
                            </div>
                            <div class="status {{ $questions->status }}">
                                <strong> {{ $questions->answers }} </strong> {{ str_plural('answer', $questions->answers) }}
                            </div>
                            <div class="view">
                                {{ $questions->views . " " . str_plural('view', $questions->views) }}
                            </div>
                        </div>
                        <div class="media-body">
                        <h4 class="mt-0">
                        <a href="{{ $questions->url }}">{{ $questions->title }}</a>
                        </h4>
                        <p class="lead">
                            Asked By : <a href="{{ $questions->user->url }}"> {{ $questions->user->name }} </a>
                            <small class="text-muted">
                                {{ $questions->created_date }}
                            </small>
                        </p>
                        {{ str_limit($questions->body, 250) }}
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    {{ $question->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
