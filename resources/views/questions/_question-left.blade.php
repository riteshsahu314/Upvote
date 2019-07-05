<div class="col-1 d-flex flex-column justify-content-start align-items-center"
     style="font-size: 1.5rem;">
    <div>
        <form
            action="{{ route('questions.votes.store', ['question' => $question, 'type' => 'UpVote']) }}"
            method="post">
            @csrf
            <button class="btn btn-link p-0"><i class="fas fa-caret-up fa-3x"></i></button>
        </form>
    </div>
    <div>
        <span>{{ $question->score }}</span>
    </div>
    <div>
        <form
            action="{{ route('questions.votes.store', ['question' => $question, 'type' => 'DownVote']) }}"
            method="post">
            @csrf
            <button class="btn btn-link p-0"><i class="fas fa-caret-down fa-3x"></i></button>
        </form>
    </div>
    <div>
        <favorite :question="{{ $question }}"></favorite>
    </div>
</div>
