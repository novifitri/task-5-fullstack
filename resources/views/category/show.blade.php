@extends('layouts.app')

@section('title')
Detail Category <strong>{{$category->name}}</strong>
@endsection

@section('content')
    
    <div class="card mb-3 col-lg-10">
        <div class="card-body">
          <h5 class="card-title">Category Name : {{$category->name}}</h5>
          <p class="card-text"><small class="text-muted">Last updated {{$category->created_at->diffForHumans()}}</small></p>
          <div class="list-group">
              <strong>List of articles references to this category</strong>
              @forelse ($category->articles as $item)
              <a href="{{route('articles.show', $item->id)}}" class="list-group-item list-group-item-action">{{$item->title}}</a>      
              @empty
                  <p>No article yet.</p>
              @endforelse
           
          </div>
        </div>
    </div>
    <div class="d-flex justify-content-center py-3">
      <a href="/categories" class="btn btn-primary" title="Back">Back</a>                  
    </div>
@endsection