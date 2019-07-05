<div class="d-flex flex-column justify-content-end align-items-end position-fixed fixed-bottom">
    <flash :data='@json(session('flash'))'></flash>
</div>

@if(count($errors))
    <div class="d-flex flex-column justify-content-end align-items-end position-fixed fixed-bottom">
        @foreach($errors->all() as $error)
            <flash :data='@json(['message' => $error, 'type' => 'danger'])'></flash>
        @endforeach
    </div>
@endif
