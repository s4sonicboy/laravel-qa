@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>Ask Questions</h2>
                        <div class="ml-auto">
                            <a class="btn btn-outline-secondary" href=" {{route('questions.index')}} ">
                                Back to All Questions
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('questions.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="question-title">Question Title</label>
                        <input value="{{ old('title') }}" type="text" name="title" id="question-title" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}" />
                            @if ($errors->has('title'))
                                <div class="invalid-feedback">
                                    <strong> {{ $errors->first('title') }} </strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="question-body">Explain Your Question</label>
                        <textarea name="body" id="question-body" rows="5" class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}">{{ old('body') }}</textarea>
                            @if ($errors->has('body'))
                                <div class="invalid-feedback">
                                    <strong> {{ $errors->first('body') }} </strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Ask This Question" class="btn btn-outline-success btn-sm" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
