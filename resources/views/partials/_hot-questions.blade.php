@if(count($hot_questions))
    <div class="card">
        <div class="card-header">
            Hot Questions
        </div>

        <ul class="list-group">
            @foreach($hot_questions as $question)
                <li class="list-group-item">
                    <a href="{{ $question->link }}">{{ $question->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endif
