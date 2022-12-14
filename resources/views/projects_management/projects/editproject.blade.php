@extends('layouts.app')

@push('head')
    <title>Update agent</title>

    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">


    <!-- Custom styles for this page -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.semanticui.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('images/css/dash.css') }}">
 
    <style>
       body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: white;
        }

        * {
            box-sizing: border-box;
        }

        /* Add padding to containers */
        .container {
            padding: 16px;
          /*  background-color: white;*/
        }

        /* Full-width input fields */
        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }

        input[type=text]:focus,
        input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Overwrite default styles of hr */
        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        /* Set a style for the submit button */
        .registerbtn {
            background-color: #70cacc;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border-radius: 20px;
            border: none;
            cursor: pointer;
            width: 10%;
            opacity: 0.9;
        }

        .center {
            margin: 0 100 0 0;
            position: absolute;
            left: 50%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        .registerbtn:hover {
            opacity: 1;
        }

        /* Add a blue text color to links */
        a {
            color: dodgerblue;
        }

        /* Set a grey background color and center the text of the "sign in" section */
        .signin {
            background-color: #f1f1f1;
            text-align: center;
        }

.top-title {
    font-family: 'Lato-Semibold';
    font-size: 20px;
    color: #fff;
    height: 4rem;
    padding: 14px 35px;

    border-radius: 0 0px 55px 0;
    background-image:linear-gradient(to right, #211706, #291d0a, #30230c, #39290f, #412f10, #503913, #5f4416, #6e4f19, #88621f, #a37526, #be892c, #db9d33);
}
.sidebar-divider{
    display: none;
}
.title-input{
    color: #143e39;
    font-family: 'Lato-Bold';
    font-size: 13px;
}

#name,#date,#code,#client,#description,#projecttype{
    font-family: 'Lato-Regular'!important;
    font-size: 12px!important;
    display: inline-block;
     width: 100%; 
    height: calc(2.25rem + 2px);
    padding: 0.375rem 1.75rem 0.375rem 0.75rem;
    line-height: 1.5;
    color: #878b8f;
    vertical-align: middle;
    border-radius: 0!important;
    background: #fff!important;
    border: 1px solid #fff!important;
    text-align: left;
    border-right: 3px solid #e4aa47!important;
    box-shadow: 0 4px 2px -2px #d9d1d1;
}

input[type=text], input[type=password]{
    margin: 0!important;
}
#img-top{
    position: absolute;
    top: -4px;
    right: 20px;
    width: 16rem;
}
#maindata{
    box-shadow: 0px 0px 4px 1px #6c4d18;
    margin: 5px;
    border: 1px solid #e4aa47;
    border-radius: 5px;
    padding: 20px 51px;
        width: 50rem;
    margin: 5rem auto;
}
@font-face {
     font-family: 'Lato-Semibold';
            src: url({{ asset('font/Lato-Semibold.ttf') }});
        }
        @font-face {
     font-family: 'Lato-Bold';
            src: url({{ asset('font/Lato-Bold.ttf') }});
        }
        @font-face {
     font-family: 'Lato-Regular';
            src: url({{ asset('font/Lato-Regular.ttf') }});
        }
#buttonsubmit{
    width: 9rem;
    background: #6c4d18;
    padding: 5px 32px;
    border-radius: 0;
    font-family: 'Lato-Semibold';
}
/*responsive*/
@media(max-width: 1400px){
    #bookslist_filter label::before{
        top: 133px;
    }
    #bookslist_filter label::after{
        top: 127px;
    }
}

@media(max-width: 1350px) and (min-width: 1200px){
.top-title{
    font-size: 16px;
  
}
}
#bg-top {
    width: 116%;
    margin-left: -2rem;
    margin-top: -4rem;
}
#bookslist_filter label::after{
    top: 121px;
    right: 31px;
}
#bookslist_filter label::before{
    top: 126px;
    right: 281px;
}
.label h4{
    font-size: 15px;
}
.top-title{
    font-size: 16px;
}

@media(max-width: 768px){
    #wrapper {
    height: auto;
}
.group-button{
    margin-top: 2rem;
}


}
#wrapper #content-wrapper{
    padding-bottom: 3rem;
}
@media(max-width: 500px){
    .top-title{
        font-size: 15px!important;
           
    }
    #maindata{
            padding: 20px 0px;
    width: auto;
    margin: 3rem 1rem 2rem 1rem;
    }
    #wrapper {
    height: 100%;
}
    #bg-top {
    width: 66%;
    margin-left: 0;
    margin-top: 0;
   }
   .group-button{
    margin-top: 0rem!important;
}
   #bookslist_filter label::before {
    top: 405px!important;
    right: 189px!important;
}}
@media (max-width: 500px){
#bookslist_filter label::after {
    top: 10px!important;
    right: 42px!important;
    position: relative;
}
#bookslist_length{
    background: transparent;
}
#img-top{
    display:none;
}
}
@media (max-width: 1350px) and (min-width: 1200px){
#bookslist_filter label::after {
    top: 127px;
}}
@media (max-width: 768px) and (min-width: 600px){
#bookslist_filter label::after {
    top: 128px;
}
#maindata{
    padding: 20px 35px;
    width: auto!important;
    margin: 6rem 1rem!important;
}
}
/*end responsive*/

    </style>
    <!-- select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
@endpush

@section('wrapper_content')
    <!-- Content Wrapper -->
    <div class="container-fluid" style="padding-left:0!important">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-8" >
            <h3 class="top-title">Update Project</h3>
        </div>
    </div>
    </div>
    <form id="maindata">
            <div class="container">
                <span id="alertdata"></span>
                <input type="text" name="id" id="" value="{{$project->id}}" hidden>

                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-2">
                        <label class="title-input" for="property">Name</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" value="{{$project->name}}" placeholder="Enter Project Name" name="name"
                            id="name">
                    </div>
                    <div class="col-md-2">
                        <label class="title-input" for="property">Code</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" value="{{$project->code}}" placeholder="Enter Code" name="code"
                            id="code">
                    </div>
                </div>
                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-2">
                        <label class="title-input" for="property">Date</label>
                    </div>
                    <div class="col-md-4">
                        <input type="date" value="{{$project->date}}" placeholder="Enter Date" name="date"
                            id="date">
                    </div>
                    <div class="col-md-2">
                        <label class="title-input" for="property">Client</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" value="{{$project->client}}" placeholder="Enter Client" name="client"
                            id="client">
                    </div>
                </div>
                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-3">
                        <label class="title-input" for="property">Description</label>
                    </div>
                    <div class="col-md-8">
                        <textarea placeholder=" Enter Description" name="description" id="description" required>{{$project->description}}</textarea>
                    </div>
                </div>
                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-3">
                        <label class="title-input" for="property">Contributors</label>
                    </div>
                    <div class="col-md-8">
                    <select class="form-control select2" name="contributors[]"  id="contributors" multiple='multiple'  style="
                        font-family: 'Lato-Regular'!important;
                        font-size: 12px!important;
                        width: 100%;
                        height: calc(2.25rem + 2px);
                        padding: 0.375rem 1.75rem 0.375rem 0.75rem;
                        line-height: 1.5;
                        color: #878b8f;
                        vertical-align: middle;
                        border-radius: 0!important;
                        background: #fff!important;
                        border: 1px solid #fff!important;
                        text-align: left;
                        border-right: 3px solid #e4aa47!important;
                        box-shadow: 0 4px 2px -2px #d9d1d1;">
                            @foreach ($users as $user)
                            @if(in_array($user->id,$project_users))
                                <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                            @else
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-3">
                        <label class="title-input" for="property">Project Type</label>
                    </div>
                    <div class="col-md-8">
                        <select class="form-control" name="projecttype" id="projecttype" required>
                            
                            @foreach ($projecttypes as $projecttype)
                                <option {{($project->project_type == $projecttype->id) ? 'selected' : '' }} value="{{ $projecttype->id }}">{{ $projecttype->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12 text-center">
                        <button id="buttonsubmit" type="button" class="registerbtn">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- End of Content Wrapper -->

@endsection

@section('content')
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

@endsection

@push('scripts')
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('select.custom-select').val($('select.custom-select > option:last').val()).change();

        });
    </script>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
        integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous">
    </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

    <script>
        $('#buttonsubmit').click(function(e) {
            e.preventDefault();
            var formData = new FormData();

            $('#maindata').serializeArray().forEach(function(field) {
                formData.append(field.name, field.value);
            });

            formData.append("_token", "{{ csrf_token() }}");

            $.ajax({
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                enctype: 'multipart/form-data',
                url: "{{ route('update_project') }}",
                success: function(result) {
                    console.log(result);
                    $("#alertdata").empty();
                    $("#alertdata").append("<div class= 'alert alert-success'>" + result.message +
                        "</div>");
                    $("#alertdata").attr('hidden', false);
                },
                error: function(error) {
                    $("#alertdata").empty();
                    $.each(error.responseJSON.errors, function(index, value) {
                        $("#alertdata").append(
                            "<div class= 'alert alert-danger'>" +
                            index +
                            "   " + value + "</div>");
                    });
                    $("#alertdata").attr('hidden', false);
                }
            });
        });
             ///////////////////
             $(document).ready(function () {
            $('#contributors').select2();
             });
    </script>

@endpush