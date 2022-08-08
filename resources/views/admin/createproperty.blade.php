@extends('layouts.app')

@push('head')
    <title>Create property</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">


    <!-- Custom styles for this page -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css" rel="stylesheet">
    <link rel="stylesheet" href="images/css/dash.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

    <!-- jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
    </script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

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
.sidebar-divider{
    display: none;
}
.title-input{
    color: #143e39;
    font-family: 'Lato-Bold';
    font-size: 13px;
}

#property,#area,#price,#status,#buyerid{
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
            src: url('font/Lato-Semibold.ttf');
        }
#buttonsubmit{
    background:#6c4d18;
    padding: 5px 32px;
    border-radius: 0;
    font-family: 'Lato-Semibold';
}
/*responsive*/
@media(max-width: 1200px) and (min-width: 1000px){
.top-title{
    font-size: 17px;
}
}
@media(max-width: 768px){
    #maindata{
        width: auto;
    margin: 5rem 1rem;
    }
    .top-title{
    font-size: 17px;
}
#wrapper {
    height: auto;
}
}
@media(max-width: 500px){
  #maindata{
    padding: 20px 0px;
  }
  .col-title{
    position: absolute;
    left: 27px;
  }
}
@media(max-width: 390px){
.full-content{
    padding: 0 0 0 23px;
}
.col-title{
    left: 33px;
  }
  .top-title{
    font-size: 15px;
}
}
/*end responsive*/
    </style>
@endpush

@section('wrapper_content')
    <!-- Content Wrapper -->
    <div class="container-fluid" style="padding-left:0!important">
    <div class="row">
        <div class="col-lg-4 col-md-5 col-9" >
            <h3 class="top-title">Create New Property</h3>
        </div>
    </div>
    </div>
    <div id="content-wrapper" class="d-flex flex-column" >

        <!-- <h2 style="margin-left: 30%" class="mt-5 mb-5">Create new property</h2> -->
        <form id="maindata" class="">
            <div class="container">
                <span id="alertdata"></span>

                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-2">
                        <label class="title-input" for="property">Name</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text"  placeholder="Enter Name" name="name"
                            id="property">
                    </div>
                    <div class="col-md-2">
                        <label class="title-input" for="property">Email</label>
                    </div>
                    <div class="col-md-4">
                        <input type="email"  placeholder="Enter Email" name="email"
                            id="property">
                    </div>

                </div>
                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-2">
                        <label class="title-input" for="property">Phone</label>
                    </div>
                    <div class="col-md-4">
                        <input type="tell"  placeholder="Enter Phone" name="phone"
                            id="property">
                    </div>
                    <div class="col-md-2">
                        <label class="title-input" for="property">Secondary Mobile</label>
                    </div>
                    <div class="col-md-4">
                        <input type="tell"  placeholder="Enter Secondary Mobile" name="secondary_mobile"
                            id="property">
                    </div>
                </div>

                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-2">
                        <label class="title-input" for="property">Nationality</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text"  placeholder="Enter Nationality" name="nationality"
                            id="property">
                    </div>
                    <div class="col-md-2">
                        <label class="title-input" for="property">Area</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text"  placeholder="Enter Area" name="area"
                            id="property">
                    </div>

                </div>
                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-2">
                        <label class="title-input" for="status">P-Number </label>
                    </div>
                    <div class="col-md-4">
                        <input type="number"  placeholder="Enter P-Number " name="p_number"
                        id="status">
                    </div>
                    <div class="col-md-2">
                        <label class="title-input" for="status">Plot Number </label>
                    </div>
                    <div class="col-md-4">
                        <input type="text"  placeholder="Enter Plot Number " name="plot_number"
                        id="status">
                    </div>

                </div>
                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-2">
                        <label class="title-input" for="property">Building Name </label>
                    </div>
                    <div class="col-md-4">
                        <input type="text"  placeholder="Building Name " name="building_name"
                            id="property" >
                    </div>
                    <div class="col-md-2">
                        <label class="title-input" for="property">Registration Number</label>
                    </div>
                    <div class="col-md-4">
                        <input type="number"  placeholder="Registration Number" name="registration_number"
                            id="status" >
                    </div>
                </div>


                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-2">
                        <label class="title-input" for="property">Flat Number </label>
                    </div>
                    <div class="col-md-4">
                        <input type="number"  placeholder="Enter Flat Number " name="flat_number"
                            id="status" >
                    </div>
                    <div class="col-md-2">
                        <label class="title-input" for="property">Balcony</label>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="balcony" id="flexRadioDefault1 ">
                            <label class="form-check-label" for="flexRadioDefault1">
                              Yes
                            </label>
                        </div>

                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="balcony" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                             No
                            </label>
                          </div>
                    </div>
                </div>
                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-2">
                        <label class="title-input" for="status">Parking Number </label>
                    </div>
                    <div class="col-md-4">
                        <input type="number"  placeholder="Enter Parking Number " name="parking_number"
                            id="status">
                    </div>
                    <div class="col-md-2">
                        <label class="title-input" >Common Area </label>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="common_area" id="flexRadioDefault3 ">
                            <label class="form-check-label" for="flexRadioDefault3">
                              Yes
                            </label>
                        </div>

                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="common_area" id="flexRadioDefault4" checked>
                            <label class="form-check-label" for="flexRadioDefault4">
                             No
                            </label>
                          </div>
                    </div>

                </div>
                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-1">
                        <label class="title-input" for="property">Rooms </label>
                    </div>
                    <div class="col-md-3">
                        <input type="number" placeholder="Enter Rooms Number " name="rooms"
                            id="property" >
                    </div>
                    <div class="col-md-1">
                        <label class="title-input" for="property">Levels</label>
                    </div>
                    <div class="col-md-3">
                        <input type="number" placeholder="Enter Levels Number "   name="levels"
                            id="status" >
                    </div>
                    <div class="col-md-1">
                        <label class="title-input" for="property">Shops</label>
                    </div>
                    <div class="col-md-3">
                        <input type="number" placeholder="Enter Shops Number "  name="shops"
                            id="status" >
                    </div>


                </div>
                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-1">
                        <label class="title-input" for="property">Flats </label>
                    </div>
                    <div class="col-md-3">
                        <input type="number" placeholder="Enter Flats Number " name="flats"
                            id="property" >
                    </div>
                    <div class="col-md-1">
                        <label class="title-input" for="property">Offices</label>
                    </div>
                    <div class="col-md-3">
                        <input type="number" placeholder="Enter Offices Number "   name="offices"
                            id="status" >
                    </div>
                    <div class="col-md-1">
                        <label class="title-input" for="property">Age</label>
                    </div>
                    <div class="col-md-3">
                        <input type="number" placeholder="Enter Age "  name="age"
                            id="status" >
                    </div>


                </div>
                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-2">
                        <label class="title-input" for="property">Municipality Number </label>
                    </div>
                    <div class="col-md-4">
                        <input type="text"  placeholder="Enter Municipality Number " name="municipality_number"
                            id="property">
                    </div>
                    <div class="col-md-2">
                        <label class="title-input" for="property">	Master Project </label>
                    </div>
                    <div class="col-md-4">
                        <input type="text"  placeholder="Enter Master Project " name="master_project"
                            id="property">
                    </div>

                </div>
                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-2">
                        <label class="title-input" for="property">Project </label>
                    </div>
                    <div class="col-md-4">
                        <input type="text"  placeholder="Enter Project " name="project"
                            id="property">
                    </div>
                    <div class="col-md-2">
                        <label class="title-input" for="property">	Property Type  </label>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="property_type" id="property" >
                            <option value="">Property Type</option>
                            @foreach ($property_types as $property_type)
                                <option value="{{ $property_type }}">{{ $property_type }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-2">
                        <label class="title-input" for="property"> Type </label>
                    </div>
                    <div class="col-md-4">
                        <input type="text"  placeholder="Enter Type " name="type"
                            id="property">
                    </div>
                    <div class="col-md-2">
                        <label class="title-input" for="status" >	Villa Number   </label>
                    </div>
                    <div class="col-md-4">
                        <input type="number"  placeholder="Enter Villa Number   " name="villa_number"
                            id="status" >
                    </div>

                </div>
                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-2">
                        <label class="title-input" for="property">Floor </label>
                    </div>
                    <div class="col-md-4">
                        <input type="text"  placeholder="Enter Floor " name="floor"
                        id="property">
                    </div>
                    <div class="col-md-2">
                        <label class="title-input" for="status">Actual Area  </label>
                    </div>
                    <div class="col-md-4">
                        <input type="number" step="0.01"  placeholder="Enter Actual Area " name="actual_area"
                        id="status">
                    </div>

                </div>


                <div class="row mt-5">
                    <div class="col-md-12 text-center">
                        <button id="buttonsubmit" type="submit" class="registerbtn">Create</button>
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

    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    {{-- <script>
        $(document).ready(function() {
            $('select.custom-select').val($('select.custom-select > option:last').val()).change();
        });
        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    </script> --}}

    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet"
        type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
        integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous">
    </script>

    <script>
    $(document).ready(function() {
        $(document).on('submit', '#maindata', function (e) {
            $("#alertdata").empty();
            e.preventDefault();
            var formData = new FormData($('#maindata')['0']);

            // $('#maindata').serializeArray().forEach(function(field) {
            //     formData.append(field.name, field.value);
            // });

            formData.append("_token", "{{ csrf_token() }}");

            $.ajax({
                method: 'post',
                dataType:"json",
                processData: false,
                contentType: false,
                data: formData,
                url: "{{ route('create_new_property') }}",
                success: function(result) {
                    if (result.success) {

                        $("#alertdata").empty();
                        $("#alertdata").append("<div class= 'alert alert-success'>" + result.message +
                            "</div>");
                        $("#alertdata").attr('hidden', false);
                        $("#maindata")[0].reset();
                    }
                    else{
                        $("#alertdata").empty();
                        $("#alertdata").append("<div class= 'alert alert-danger'>" + result.message +
                            "</div>");
                        $("#alertdata").attr('hidden', false);
                    }
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
    });
    </script>

@endpush
