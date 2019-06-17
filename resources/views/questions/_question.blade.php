{{-- Editing the Question --}}
<div class="card mb-3" v-if="editing">
    <div class="card-header">
        <input type="text" v-model="form.title" placeholder="Question Title" class="form-control">
    </div>
    <div class="card-body">
        <textarea class="form-control" cols="30" rows="10" v-model="form.body" placeholder="Question Description"></textarea>
    </div>

    @can('update', $question)
        <div class="card-footer">
            <button class="btn btn-primary btn-sm float-left mr-3" @click="update">Update</button>
            <button class="btn btn-link btn-sm float-left" @click="resetForm">Cancel</button>
            <form method="post" action="{{ route('questions.destroy', $question) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-link btn-sm float-right">DELETE</button>
            </form>
        </div>
    @endcan
</div>


{{-- Viewing the Question --}}
<div class="card mb-3" v-else>
    <div class="card-header">
        <h4 v-text="title"></h4>
        <h5>Asked By: {{ $question->owner->name }}</h5>
    </div>
    <div class="card-body" v-text="body"></div>

    @can('update', $question)
        <div class="card-footer">
           <button class="btn btn-secondary btn-sm" @click="editing = true">Edit</button>
        </div>
    @endcan
</div>
