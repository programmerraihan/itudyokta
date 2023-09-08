@extends('branch.branch_master')


@section('css')
    <style type="text/css">
        fieldset {
            min-width: 0px;
            padding: 15px;
            margin: 7px;
            border: 2px solid #a66df5;
        }

        legend {
            float: none;
            background-image: linear-gradient(to bottom right, #062689, #5b076f);
            padding: 4px;
            width: 50%;
            color: rgb(255, 255, 255);
            border-radius: 7px;
            font-size: 17px;
            font-weight: 700;
            text-align: center;
        }

        label{
            font-weight: 700;
        }
        <link href=" {{ asset('css/summernote/css/summernote.css') }}" rel="stylesheet"/>
        <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/dataTables.bootstrap4.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom_css/datatables_custom.css') }}">
        </style>
@endsection

@section('admin')
    
        <div class="card">
         
          <form action="#" method="POST" class="form-horizontal" enctype="multipart/form-data">
              @csrf
              <fieldset>
              <legend>Add Group</legend>
              <div class="row">
              <div class="form-group col-md-6">
                  <img src="#" class="right-signe"><label>Group Name:</label>
                  <input type="text" class="form-control" name="group_name" placeholder="Ex: science">
              </div>
            
              <div class="form-group"> 
                  <div class="col-sm-offset-3 col-sm-10">
                      <button type="submit" class="btn btn-success btnconf">Submit</button>
                      <button type="reset" class="btn btn-default">Reset</button>
                  </div>
              </div>
              </fieldset>
          </form> 
        </div>


@endsection
@section('script')
   <script>
    <script type="text/javascript" src="{{ asset('vendors/datatables/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendors/datatables/js/dataTables.bootstrap4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/custom_js/datatables_custom.js') }}"></script>
   </script>
   
@endsection 





