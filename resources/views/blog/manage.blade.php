@extends('layouts.master')
@section('title','Manage Blogs | Blog Management')
@section('venderCSS')
    <link rel="stylesheet" href="{{ asset( 'assets/vendor/css/pages/jquery.dataTables.min.css')}}" />
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Blog /</span> List with Filter</h4>

    <!-- Table -->
    <div class="card">
      <h5 class="card-header">Blogs List</h5>
      <div class="table-responsive text-nowrap">
        {{ csrf_field() }}
        
        <table id="blogTable"  class="display" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Title</th>
              <th>Author</th>
              <th>Created Date</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach ($blogs as $blog)
            <tr>
                <td>{{$blog->id}}</td>
                <td>{{$blog->title}}</td>
                <td>{{$blog->author}}</td>
                <td>{{$blog->created_at}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        
      </div>
    </div>
    <!--/Table -->

    <hr class="my-5" />
    <h3 class="card-header">Date Filter</h5>

    <table>
        <tr>
          <td>
             <input type='text' id='search_fromdate' class="datepicker form-control" placeholder='From date'>
          </td>
          <td>
             <input type='text' id='search_todate' class="datepicker form-control" placeholder='To date'>
          </td>
          <td>
             <input type='button' class="form-control" id="btn_search" onclick="dateRange()" value="Search">
          </td>
        </tr>
    </table>
  </div>
@endsection
@section('vendorJS')
    <script src="{{ asset( 'assets/vendor/js/jquery.dataTables.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
@endsection
@section('js')
  <script>
    $(document).ready(function () {
        $(function(){
            $( ".datepicker" ).datepicker({
                format: 'yyyy-mm-dd',
                changeYear: true,
            });
        });
        $('#blogTable').DataTable();

    });

    function filterData(from_date,to_date,token) {
        $('#blogTable').DataTable().destroy();
        var dataTable = $('#blogTable').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'POST',
            'searching': true,
            'ajax': {
                'url':"{{route('blog.filter')}}",
                'data': function(data){
                    data._token = token;
                    data.searchByFromdate = from_date;
                    data.searchByTodate = to_date;
                }
            },
            'columns': [
                { data: 'id' },
                { data: 'title' },
                { data: 'author' },
                { data: 'created_at' },
            ]
        });
        
    }

    function dateRange() {
        var from_date = $('#search_fromdate').val();
        var to_date = $('#search_todate').val();
        var _token = $('input[name="_token"]').val();
        if(from_date != "" && to_date != ""){
            
            filterData(from_date,to_date,_token);
        }
        else{
            console.log(1);
        }
    }
    
  </script>
@endsection