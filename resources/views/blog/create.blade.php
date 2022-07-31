@extends('layouts.master')
@section('title','Create Blog | Blog Management')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Blog /</span> Create Blog</h4>

    <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 id="msg" class="mb-0">Fill Details</h5>
            
          </div>
          <div class="card-body">
            <form id="blogForm" name="blogForm">
              @csrf
              <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter a title" />
                <div id="invalid-title" class="invalid-feedback">
                    Please enter a title.
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Categories</label>
                <select class="form-control" id="categories" name="categories[]" multiple>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                <div id="invalid-categories" class="invalid-feedback">
                    Select any category.
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-default-company">Short Discription</label>
                <input type="text" class="form-control" id="short-description" name="short_description" placeholder="Enter Short Discription (Max: 120 Character)" />
                <div id="invalid-short-description" class="invalid-feedback">
                    Enter Short Discription
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-default-email">Body</label>
                <div class="input-group input-group-merge">
                  <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
                </div>
                <div id="invalid-body" class="invalid-feedback">
                  Enter body content.
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-default-phone">Author</label>
                <input
                  type="text"
                  id="author"
                  name="author"
                  class="form-control"
                  placeholder="Enter auther name"
                />
                <div id="invalid-author" class="invalid-feedback">
                    Enter valid author name.
                </div>
              </div>
              
              <button type="submit" class="btn btn-primary">Create Blog</button>
            </form>
          </div>
        </div>
      </div>
      
    </div>
  </div>
@endsection
@section('js')
<script>
  $("#title").on('input', function(e){
      $("#invalid-title").hide();
  }); 
  $("#categories").on('change', function(e){
      $("#invalid-categories").hide();
  });
  $("#short-description").on('input', function(e){
      $("#invalid-short-description").hide();
  });
  $("#body").on('input', function(e){
      $("#invalid-body").hide();
  });
  $("#author").on('input', function(e){
      $("#invalid-author").hide();
  });

  $("#blogForm").submit(function (e) {
      e.preventDefault();

      var formData = new FormData(this);

      $.ajax({
          url: "{{route('blog.store')}}",
          data: formData,
          type: "POST",
          cache: false,
          contentType: false,
          processData: false,      
          success: (response)=>{
              if(response.status == true){
                  $("#msg").html(response.msg);
                  $(this)[0].reset();
              }
              else{
                  $("#msg").html(response.msg);
              }
          },
          error: (response)=>{
              console.log(response);
              if (response.responseJSON.errors.title) {
                  $("#invalid-title").show();                          
              }
              if (response.responseJSON.errors.categories){
                  $("#invalid-categories").show();                          
              }
              if (response.responseJSON.errors.short_description){
                  $("#invalid-short-description").show();                          
              }
              if (response.responseJSON.errors.body){
                  $("#invalid-body").show();                          
              }
              if (response.responseJSON.errors.author){
                  $("#invalid-author").show();
              }
          },
      });
  }); 
</script>
@endsection