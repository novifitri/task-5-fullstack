@extends('layouts.app')

@section('title')
Categories
@endsection
@section('content')

@section('create-button')
<a href="{{route('categories.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Create New Category<i class="fas fa-plus ml-2"></i></a>
@endsection
    
@include('components.alert')

    <!-- DataTales -->
    <div class="card shadow mb-4 col-lg-10">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Categories</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $key => $category)
                        <tr>
                            <td>{{$categories->firstItem()+$key}}</td>
                            <td>{{$category->name}}</td>
                            <td>          
                                <a href="/categories/{{$category->id}}" class="btn btn-circle btn-info" title="Detail"><i class="fas fa-info mx-1" ></i></a>
                                <a href="/categories/{{$category->id}}/edit" class="btn btn-circle btn-warning" title="Edit"><i class="fas fa-pen mx-1"></i></a>
                                <button class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteModal{{$category->id}}" title="Delete"><i class="fas fa-trash mx-1"></i></button>             
                            </td>
                        </tr>
                        @include('components.modal')                
                        @empty
                        <h4>Anda belum menambahkan kategori</h4>
                         @endforelse 
                    </tbody>
                </table>     
                <div> 
                    <small>
                    Showing {{$categories->firstItem()}} to {{$categories->lastItem()}} of {{$categories->total()}} data
                    </small>
                </div>
            </div>
        </div>
       
    </div>
   
    <div class="d-flex justify-content-center">
        {{$categories->links()}}
    </div>
@endsection