@extends('layouts.app')

@section('title')
    Article Details
@endsection

@section('content')
<div class="card mb-3">
    <img src="{{ $article->checkFile($article->image) ? asset('image/'.$article->image) : $article->image}}" class="card-img-top" width="1000" height="300px">
    <div class="card-body">
      <h5 class="card-title">{{$article->title}}</h5>
      <p><b>by</b> <span class="text-info">{{$article->user->name}}</span></p>
      <p><b>category</b> <span class="text-info">{{$article->category->name}}</span></p>
       {!! $article->content !!}
      <p class="card-text"><small class="text-muted">Last updated {{$article->updated_at->diffForHumans()}}</small></p>
    </div>
</div>
<div class="d-flex justify-content-center py-3">
  <a href="/articles/" class="btn btn-primary" title="Back">Back</a>                  
</div>
@endsection