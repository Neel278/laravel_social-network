@extends('layouts.master')

@section('title')
Dashboard
@endsection

@section('content')
@include('includes.error-block')
<section class="row new-post">
    <div class="col-md-6 offset-md-3">
        <header>
            <h3>What do you have to say ?</h3>
        </header>
        <form action="{{ route('createpost') }}" method="post">
            @csrf
            <div class="form-group">
                <textarea name="body" id="new-post" placeholder="Your Post" rows="5" cols="80"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>
</section>
<section class="row posts">
    <div class="col-md-6 offset-md-3">
        <header>
            <h3>What other people say ...</h3>
        </header>
        @foreach($posts as $post)
        <article class="post" data-postid="{{ $post->id }}">
            <p>{{ $post->body }}</p>
            <div class="info">
                Posted By {{ $post->user->first_name }} on {{ $post->created_at->format('d-m-Y') }}
            </div>
            <div class="interaction">
                <a href="#" class="like"><i class="fa fa-thumbs-o-up fa-lg" aria-hidden="true"></i></a>
                |
                <a href="#" class="like"><i class="fa fa-thumbs-o-down fa-lg" aria-hidden="true"></i></a>
                @if(Auth::user() == $post->user)
                |
                <a href="#" class="edit"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i> Edit</a>
                |
                <a href="{{ route('post.delete',['post_id'=>$post->id]) }}"><i class="fa fa-trash fa-lg" aria-hidden="true"></i> Delete</a>
                @endif
            </div>
        </article>
        @endforeach
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="post-body">Edit the Post</label>
                        <textarea name="post-body" id="post-body" cols="60" rows="5" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    var token = '{{Session::token()}}';
    var urlEdit = "{{ route('edit') }}";
</script>
@endsection