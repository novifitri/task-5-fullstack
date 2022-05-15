@extends('layouts.app')

@section('title')
    Create New Article
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
                                <form class="user" method="POST" action="/articles" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control form-control-user"
                                            id="title" placeholder="Enter title..." value="{{old('title')}}">
                                            @error('title')
                                            <p class="text-danger text-center">{{$message}}</p>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Content</label>
                                        <textarea name="content" id="content" cols="0" rows="2" class="form-control" placeholder="Enter content..."></textarea>
                                        @error('content')
                                        <p class="text-danger text-center">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" class="form-control"
                                        id="image" accept="image/*">
                                        @error('image')
                                        <p class="text-danger text-center">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select name="category_id" id="category" class="form-select form-control">
                                            <option selected value="">Choose Category...</option>
                                            @foreach ($categories as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach         
                                        </select>
                                    </div>   
                                    @error('category_id')
                                    <p class="text-danger text-center">{{$message}}</p>
                                    @enderror                                  
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