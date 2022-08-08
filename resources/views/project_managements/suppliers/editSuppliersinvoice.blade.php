@extends('layouts.app')

@push('head')
    <title>Create New Supplier Invoices</title>

    <!-- Custom fonts for this template -->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

    <!-- Custom styles for this page -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css" rel="stylesheet">
    <link rel="stylesheet" href="images/css/dash.css">

    <!-- jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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
            /* background-color: white; */
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

        .ui-autocomplete {
            max-height: 200px;
            overflow-y: auto;
            overflow-x: hidden;

            padding-right: 20px;
        }

        html .ui-autocomplete {
            height: 200px;
            width: 40%
        }

        .top-title {
            font-family: 'Lato-Semibold';
            font-size: 20px;
            color: #fff;
            height: 4rem;
            padding: 14px 35px;

            border-radius: 0 0px 55px 0;
            background-image: linear-gradient(to right, #211706, #291d0a, #30230c, #39290f, #412f10, #503913, #5f4416, #6e4f19, #88621f, #a37526, #be892c, #db9d33);
        }

        .sidebar-divider {
            display: none;
        }

        .title-input {
            color: #143e39;
            font-family: 'Lato-Bold';
            font-size: 13px;
        }

        #property,
        #datetimepicker,
        #amount,
        #status,
        #buyerid {
            font-family: 'Lato-Regular' !important;
            font-size: 12px !important;
            display: inline-block;
            width: 100%;
            height: calc(2.25rem + 2px);
            padding: 0.375rem 1.75rem 0.375rem 0.75rem;
            line-height: 1.5;
            color: #878b8f;
            vertical-align: middle;
            border-radius: 0 !important;
            background: #fff !important;
            border: 1px solid #fff !important;
            text-align: left;
            border-right: 3px solid #e4aa47 !important;
            box-shadow: 0 4px 2px -2px #d9d1d1;
        }

        input[type=text],
        input[type=password] {
            margin: 0 !important;
        }

        #maindata {
            box-shadow: 0px 0px 4px 1px #6c4d18;
            margin: 5px;
            border: 1px solid #e4aa47;
            border-radius: 5px;
            padding: 20px 39px;
            width: 50rem;
            margin: 5rem auto;
        }

        @font-face {
            font-family: 'Lato-Semibold';
            src: url('font/Lato-Semibold.ttf');
        }

        #buttonsubmit {
            background: #6c4d18;
            padding: 5px 32px;
            border-radius: 0;
            font-family: 'Lato-Semibold';
        }

        /*responsive*/
        @media(max-width: 1200px) and (min-width: 1000px) {
            .top-title {
                font-size: 17px;
            }
        }

        @media(max-width: 768px) {
            #maindata {
                width: auto;
                margin: 5rem 1rem;
            }

            .top-title {
                font-size: 17px;
            }

            #wrapper {
                height: auto;
            }
        }

        @media(max-width: 500px) {
            #maindata {
                padding: 20px 0px;
            }

            .col-title {
                position: absolute;
                left: 27px;
            }
        }

        @media(max-width: 390px) {
            .full-content {
                padding: 0 0 0 23px;
            }

            .col-title {
                left: 33px;
            }

            .top-title {
                font-size: 15px;
            }
        }




        /*end responsive*/
    </style>
@endpush

@section('wrapper_content')
    <div class="container-fluid" style="padding-left:0!important">
        <div class="row">
            <div class="col-lg-4 col-md-5 col-9">
                <h3 class="top-title">Update Supplier Invoices</h3>
            </div>
        </div>
    </div>
    <div id="content-wrapper" class="d-flex flex-column">
        <form id="maindata" class="mt-5">
            <div class="container">
                <span id="alertdata"></span>
                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-3">
                        <label class="title-input" for="property">Project</label>
                    </div>
                    <div class="col-md-8">
                        <select id ="property" name="project" class="form-control">
                                @foreach ($projects as $project)
                                    <option {{($supplier_invoice->project_id == $project->id ) ? 'selected': ''}} value="{{ $project->id }}">{{ ucfirst($project->name) }}
                                    </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-3">
                        <label class="title-input" for="property">Supplier</label>
                    </div>
                    <div class="col-md-8">
                        <select id ="property" name="supplier" class="form-control">
                            <option value="">Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option {{($supplier_invoice->supplier_id == $supplier->id ) ? 'selected': ''}} value="{{ $supplier->id }}">{{ ucfirst($supplier->name) }}
                                    </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-3">
                        <label class="title-input" for="property">Image</label>
                    </div>
                    <div class="col-md-8">
                        <input type="file" value="{{asset($supplier_invoice->path)}}" placeholder="Supplier Invoice Image" name="image" id="property" >
                    </div>

                </div>
                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-3">
                        <label class="title-input" for="property">Number</label>
                    </div>
                    <div class="col-md-8">
                        <input class="form-control" value="{{$supplier_invoice->number}}" type="text" placeholder="Supplier Invoice Number" name="number"
                            id="property" >
                    </div>
                </div>
                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-3">
                        <label class="title-input" for="property">Advanced Payment</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" value="{{$supplier_invoice->advanced_payment}}" placeholder="Supplier Invoice Advanced Payment" name="advanced_payment"
                            id="property">
                            <input type="text" value="{{$supplier_invoice->id}}"  name="id" hidden
                            id="property">
                    </div>
                </div>
                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-3">
                        <label class="title-input" for="property">Total Payment</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" value="{{$supplier_invoice->total_payment}}" placeholder="Supplier Invoice Total Payment" name="total_payment" id="property" >
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12 text-center">
                        <button id="buttonsubmit" type="submit" class="registerbtn">Update Supplier invoice</button>
                    </div>
                </div>
            </div>
        </form>






    </div>
@endsection

@section('content')
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet"
        type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
        integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous">
    </script>

    <script>
        $(document).on('submit', '#maindata', function(e) {
            $("#alertdata").empty();
            e.preventDefault();
            var formData = new FormData($('#maindata')['0']);
            formData.append("_token", "{{ csrf_token() }}");
            $.ajax({
                enctype: 'multipart/form-data',
                method: 'post',
                dataType: "json",
                processData: false,
                contentType: false,
                data: formData,
                url: "{{ route('updateSupplierinvoice') }}",
                success: function(result) {
                    if (result.state) {
                        $("#alertdata").empty();
                        $("#alertdata").append("<div class= 'alert alert-success'>" + result.message +
                            "</div>");
                        $("#alertdata").attr('hidden', false);
                        $("#maindata")[0].reset();
                    } else {
                        $("#alertdata").empty();
                        $.each(result.message, function(key,value ){
                            $("#alertdata").append("<div class= 'alert alert-danger'>" + value +
                            "</div>");
                  		});
                        $("#alertdata").attr('hidden', false);
                    }
                },

            });
        });
    </script>
@endpush
