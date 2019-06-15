@extends('layouts.app')

@section('content')
    <div class="container">
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
                                <textarea class="form-control" name="body" id="body" rows="8"
                                          placeholder="Describe your question" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Post Question</button>

                            @if(count($errors))
                                <ul class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
