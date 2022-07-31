@extends('layouts.master')
@section('title','Home | Blog Management')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Blog /</span> Home</h4>

    <!-- Examples -->
    <div class="row mb-5">
    @foreach ($blogs as $blog)
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{$blog->title}}</h5>
                    <p class="card-text">
                    {{$blog->short_description}}
                    </p>
                    <a href="/blog/{{$blog->id}}" class="btn btn-outline-primary">Show</a>
                </div>
            </div>
      </div>
    @endforeach    
      
    </div>
    <!-- Examples -->    
    <!--/ Card layout -->
</div>
@endsection
