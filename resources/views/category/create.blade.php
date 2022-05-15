@extends('layouts.app')

@section('title')
    Create New Category
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
                                <form class="user" method="POST" action="/categories" >
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control form-control-user"
                                            id="name" placeholder="Enter Category Name...">
                                            @error('name')
                                            <p class="text-danger text-center">{{$message}}</p>
                                            @enderror
                                    </div>                    
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Submit</button>
                                    <a href="/categories" class="btn btn-secondary btn-user btn-block">Cancel</a>
                                </form>
                             
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

</div>
@endsection