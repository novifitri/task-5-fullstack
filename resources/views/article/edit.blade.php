@extends('layouts.app')

@section('title')
    Update Article
@endsection

@section('content')
<!-- Outer Row -->
<div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <form class="user" method="POST" action="{{route('articles.update', $article->id)}}" enctype="multipart/form-data" >
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control form-control-user"
                                            id="title" placeholder="Enter title..." value="{{$article->title}}">
                                            @error('title')
                                            <p class="text-danger text-center">{{$message}}</p>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Content</label>
                                            <textarea name="content" id="content" cols="0" rows="2" class="form-control">{{ strip_tags($article->content) }}</textarea>
                                            @error('content')
                                            <p class="text-danger text-center">{{$message}}</p>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" id="image" name="image" class="form-control"
                                        id="image" accept="image/*">
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Choose Category</label>
                                        <select name="category_id" id="category" class="form-select form-control">
                                            <option selected>Choose Category...</option>
                                            @foreach ($categories as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>                                     
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Submit</button>
                                    <a href="/articles" class="btn btn-secondary btn-user btn-block">Cancel</a>
                                </form>
                             
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

</div>
@endsection