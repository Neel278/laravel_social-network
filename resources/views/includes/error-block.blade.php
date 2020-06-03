@if(count($errors) > 0)
<div class="row">
    <div class="col-md-4 offset-md-4 error alert alert-danger">
        @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
    </div>
</div>
@endif