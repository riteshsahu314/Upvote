@extends('layouts.app')

@section('scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection

@section('content')
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Ask a Question
                    </div>

                    <div class="card-body">
                        <form action="{{ route('questions.store') }}" method="post">
                        @csrf

                        <!-- Form Input for Title -->
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" name="title" class="form-control" id="title"
                                       placeholder="Enter question title" required>
                            </div>

                            <!-- Form Input for Body -->
                            <div class="form-group">
                                <label for="body">Body:</label>
                                <wysiwyg name="body"></wysiwyg>
                            </div>

                            <!-- Form Input for Tags -->
                            <div class="form-group">
                                <label for="tags">Tags:</label>
                                <tag-editor></tag-editor>
                            </div>

                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
                            </div>

                            <button type="submit" class="btn btn-primary">Post Question</button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
