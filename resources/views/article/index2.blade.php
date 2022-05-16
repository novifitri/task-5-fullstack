@extends('layouts.app')

@section('title')
    My Articles      
@endsection

@section('create-button')
@auth
<a href="{{route('articles.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Create New Article<i class="fas fa-plus ml-2"></i></a>
@endauth
@endsection

@section('content')
@include('components.alert')
    <!-- Content Row -->
    <div class="row">

            @forelse ($articles as $article)
            <div class="col-lg-4 mb-4"> 
                <div class="card shadow mb-4">
                    <div class="position-absolute px-3 py-2" 
                        style="background-color:rgba(0, 0, 0, 0.7)">
                        <a href="/categories/{{$article->category_id}}" class="text-white text-decoration-none">
                            {{$article->category->name}}
                        </a>
                    </div>
                    <img src="{{ $article->checkFile($article->image) ? asset('image/'.$article->image) : $article->image}}" class="card-img-top" height="250px" alt="...">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{Str::limit($article->title, 30)}}</h6>
                    </div>
                    <div class="card-body" style="height: 200px;">              
                        <p>
                            <small>
                                By. <span class="text-info">{{$article->user->name}}</span> 
                                {{$article->updated_at->diffForHumans()}}
                            </small>
                        </p>
                        {!! (Str::limit($article->content, 100)) !!}
                    
                    </div>
                    <div class="card-header text-center">   
                            <a href="/articles/{{$article->id}}" class="btn btn-info" title="Detail">Read More</a>                  
                    </div>
                </div> 
            </div>
            @include('components.article-modal')
            
            @empty
            <h4 class="container">There is no article</h4>
            @endforelse
            
    </div>
    <div class="d-flex justify-content-center">
        {{$articles->links()}}
    </div>
@endsection  
