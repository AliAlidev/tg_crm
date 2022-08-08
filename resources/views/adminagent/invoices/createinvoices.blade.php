@extends('layouts.app')

@push('head')
    <title>Create inventory</title>

    <!-- Custom fonts for this template -->

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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




    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;

        }

        * {
            box-sizing: border-box;
        }

        /* Add padding to containers */
        .container {
            padding: 16px;

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
        .custom-file-input {
  color: transparent;
}
.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;
}
.custom-file-input::before {
  content: 'Select some files';
  color: black;
  display: inline-block;
  background: -webkit-linear-gradient(top, #f9f9f9, #e3e3e3);
  border: 1px solid #999;
  border-radius: 3px;
  padding: 5px 8px;
  outline: none;
  white-space: nowrap;
  -webkit-user-select: none;
  cursor: pointer;
  text-shadow: 1px 1px #fff;
  font-weight: 700;
  font-size: 10pt;
}
.custom-file-input:hover::before {
  border-color: black;
}
.custom-file-input:active {
  outline: 0;
}
.custom-file-input:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
}

label.file {
    width: 100%;
    position: relative;
    display: inline-block;
    cursor: pointer;
    height: 2.5rem;
}
label.file input {
    width: 100%;
    margin: 0;
    filter: alpha(opacity=1);
    opacity: 1;
    background-color: transparent!important;
    color: #8b7777!important;
    padding:9px 24px 5px 24px!important;
}
.file-custom {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    z-index: 5;
    height: calc(2.25rem + 2px);
    padding: 0.5rem 1rem;
    line-height: 1.5;
    color: #878b8f;
    font-family: 'Lato-Semibold'!important;
    font-size: 12px!important;
    /*background-color: #fff;*/
    border: 1px solid #184d47;
    /*border-radius: 0.25rem;
    box-shadow: inset 0 0.2rem 0.4rem rgb(0 0 0 / 5%);*/
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.file-custom:before {
    position: absolute;
    top: -0.075rem;
    right: -0.075rem;
    bottom: -0.075rem;
    z-index: 6;
    display: block;
    font-family: 'Lato-Semibold'!important;
    font-size: 12px!important;
    width: 9rem;
    text-align: center;
    content: "Choose File";
    height: calc(2.25rem + 2px);
    padding: 0.5rem 1rem;
    line-height: 1.5;
    color: #fff;
    background:url(img/choose22.png) no-repeat;
    /*border: 0.075rem solid #ddd;
    border-radius: 0 0.25rem 0.25rem 0;*/
    background-size: cover;
}
.file-custom:after {
    content: "No File Choosen";
    display:none;
}
::-webkit-file-upload-button {
   display: none;
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
.sidebar hr.sidebar-divider{
    display: none!important;
}

form#maindata {
    width: 56rem;
    margin: auto;
}
form#maindata2 {
    width: 56rem;
    margin: auto;
}
#import-title{
    font-family: 'Lato-Semibold';
    font-size: 17px;
    color: #000;
}

#import{
    background-color: #6c4d18;
    color: white;
    padding: 5px 30px;
    border-radius: 0;
    font-family: 'Lato-Semibold';
    font-size: 14px;
    border: none;
}
#file{
   background-color: #babec5;
    color: #241d12;
    padding: 5px 24px;
    border-radius: 0;
    font-family: 'Lato-Semibold';
    font-size: 14px;
    border: none;
}

#serial_num, #date_listed, #agent_name,#category,#building_status,#building_status,#client_name,#unit_for_sales,#unit_number,#community_location,#property_type,#bedrooms,#specifications,#property_size,#price_aed,#remarks,#source_of_lead,#developer,#building_name,#property_name,#plot_area,#customer_name,#email_address,#mobile,#comments,#nationality,#furniture,#customer_type,#can_add,#roi,#telephone_number,#telephone_residence,#telephone_office,#general,#property_finder_link,#buyut_link,#dubizzle_link,#wow_propties_link,#other_links,#floors,#service_charge,#payment_plan,#rent,#ready_off,#handover,#bathrooms,#completion,#status {
    font-family: 'Lato-Semibold'!important;
    font-size: 12px!important;
    display: inline-block;
    /* width: 100%; */
    height: calc(2.25rem + 2px);
    padding: 0.375rem 1.75rem 0.375rem 0.75rem;
    line-height: 1.5;
    color: #878b8f;
    vertical-align: middle;
    border-radius: 0!important;
    background: #fff!important;
    border: 1px solid #d1cccc6b!important;
    text-align: left;
    border-right: 3px solid #e4aa47!important;
    box-shadow: 0 4px 2px -2px #d9d1d1;
        margin-bottom: 15px!important;
}

div#container-all {
    height: 25rem;
    overflow-y: scroll;
    overflow-x: hidden;
        margin-right: -16px;
    padding-right: 8px;
    margin-bottom: 10px;
}
div#container-all::-webkit-scrollbar {
  width: 5px;
}
div#container-all::-webkit-scrollbar {
  width: 8px!important;

}

/* Track */
div#container-all::-webkit-scrollbar-track {
  background: transparent;!important;
   border-radius: 8px;
}

/* Handle */
div#container-all::-webkit-scrollbar-thumb {
  background: #6c4d18;
  border-radius: 8px;
}

/* Handle on hover */
div#container-all::-webkit-scrollbar-thumb:hover {
  background: #6c4d18;
  border-radius: 8px;
}
#wrapper {
    height: auto;
}
input[type=text], input[type=password]{
    margin: 0!important;
}
.sub-title{
    font-family: 'Lato-Semibold'!important;
    font-size: 12px!important;
    color: #184d47;
}

#wrapper #content-wrapper {
    width: 100%;
    overflow-x: inherit!important;
    padding-bottom: 3rem;
}
#buttonsubmit,#createitem{
    background:#6c4d18;
    padding: 5px 32px;
    border-radius: 0;
    font-family: 'Lato-Semibold';
     width: 11rem;
   /* border-radius: 0;*/
    /* height: 78%; */
    width: auto;
    /* margin: 0;
    font-family: 'Lato-Semibold'; */
    font-size: 15px;
    background-image:linear-gradient(to bottom, #211706, #291d0a, #30230c, #39290f, #412f10, #503913, #5f4416, #6e4f19, #88621f, #a37526, #be892c, #db9d33);
}

/*responsive*/
@media(max-width: 768px){
    form#maindata{
        width: auto!important;
            margin-top: 4rem;
    }
    form#maindata2{
        width: auto!important;
            margin-top: 4rem;
    }

}
@media(max-width: 500px){
    form#maindata{
        width: auto!important;
            margin-top: 4rem;
    }
    form#maindata2{
        width: auto!important;
            margin-top: 4rem;
    }
    .col-title{
    position: absolute;
    left: 27px;
  }
  #buttonsubmit,#createitem{
    height: 2rem;
    background:#6c4d18;
    padding: 5px 32px;
    border-radius: 0;
    font-family: 'Lato-Semibold';
  }
}
@media(max-width: 390px){
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
        <div class="col-lg-4 col-md-5 col-8" >
            <h3 class="top-title">Create Invoice
            </h3>
        </div>
    </div>
    </div>
    <div id="content-wrapper" class="d-flex flex-column">
        <form id="maindata">
            <div class="container">
                <span id="alertdata"></span>

                <div id="">
                    <label class="" >Invoice :</label>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <input type="text" placeholder="Client Name" name="client_name" id="client_name">
                    </div>
                    <div class="col-md-6 col-12">
                        <select class="form-control" name="country" id="category" >
                            <option value="">Country</option>
                            @foreach ($countries as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <input type="text" placeholder="Address" name="address1" id="agent_name" >
                    </div>
                    <div class="col-md-6 col-12">
                        <input type="text" placeholder="Second Address" name="address2" id="agent_name" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <input type="text" placeholder="L.P.O.N.O" name="LPONO" id="client_name" >
                    </div>
                    <div class="col-md-6 col-12">
                        <input class="form-control ml-1" type="date" id="client_name"  placeholder="Date invoice"
                        maxlength="5" name="date">
                    </div>

                </div>
                <div class="row" style="text-align: center">
                    <div class="form-outline col-md-6 col-12"style="text-align: center">
                        <textarea class="form-control" name="description" id="client_name" placeholder="Description" rows="20"></textarea>
                      </div>
                      <div class="form-outline col-md-6 col-12"style="text-align: center">
                        <textarea class="form-control" name="note" id="client_name" placeholder="Enter Your Note" rows="20"></textarea>
                      </div>
                </div>
                <label class="" >Items :</label>

                    <div class="table_responsive">
                        <table class="table" id="table">
                            <thead>
                                <th></th>
                                <th>Serial Num</th>
                                <th>Quanttity</th>
                                <th>Amount</th>
                                <th>Description Item</th>
                            </thead>
                            <tbody>
                                <tr class="row1" id="-1">
                                    <td>#</td>
                                    <td>
                                        <input type="text" placeholder="Serial Number" name="serial_num[]" id="client_name" >
                                        <p id="serial_num0" style="display: none">Serial Number is required</p>
                                    </td>
                                    <td>
                                        <input type="text" placeholder="Quanttity" name="quanttity[]" id="client_name">
                                        <p id="quanttity0" style="display: none">Quanttity is required</p>

                                    </td>
                                    <td>
                                        <input type="text" placeholder="Amount" name="amount[]" id="client_name" >
                                        <p id="amount0" style="display: none">Amount is required</p>
                                    </td>
                                    <td>
                                        <textarea class="form-control" name="description_item[]" id="client_name" placeholder="Description Items" rows="20"></textarea>
                                        <p id="description_item" style="display: none">Description itemis required</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <button id="createitem" type="button" class="registerbtn">Add Item</button>
                                    </td>
                                </tr>

                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>

                <div class="row mt-5">
                    <div class="col-md-12 ">
                        <button id="buttonsubmit" type="submit" class="registerbtn">Create Invoices</button>
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
<script>

    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>




    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet"
        type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
        integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous">
    </script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("input[name='date']", {});
    </script>

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

    <!-- Autocomplete -->
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>




    <script>

        $(document).on('click','#createitem',function(e){
            var count=$('#table').find('tr.row1:last').length;
            var last_id=parseInt($('#table').find('tr.row1:last').attr('id'));
            // console.log(last_id);
            var incr= count > 0 ? last_id+1 : 0;
            var Serial_Number=$('input[name="serial_num[]"]').val();
            var quanttity=$('input[name="quanttity[]"]').val();
            var amount=$('input[name="amount[]"]').val();
            var description_item=$('textarea[name="description_item[]"]').val();
            if(Serial_Number == '' && quanttity == '' && amount == '' && description_item == ''){
                $('#serial_num0').css('display','block');
                $('#quanttity0').css('display','block');
                $('#amount0').css('display','block');
                $('#description_item').css('display','block');

            }else if(Serial_Number == ''){
                $('#serial_num0').css('display','block');
                $('#quanttity0').css('display','none');
                $('#amount0').css('display','none');
                $('#description_item').css('display','none');
            }
            else if(quanttity == ''){
                $('#quanttity0').css('display','block');
                $('#serial_num0').css('display','none');
                $('#amount0').css('display','none');
                $('#description_item').css('display','none');
            }else if(amount == ''){
                $('#quanttity0').css('display','none');
                $('#serial_num0').css('display','none');
                $('#amount0').css('display','block');
                $('#description_item').css('display','none');
            }else if(description_item == ''){
                $('#quanttity0').css('display','none');
                $('#serial_num0').css('display','none');
                $('#amount0').css('display','none');
                $('#description_item').css('display','block');

            }
            else{
                $('#table').find('tbody').append($(''+
                    '<tr class="row1" id="'+incr+'">'+
                        "<td></td>"+
                        '<td>'+
                            '<input type="text" placeholder="Serial Number" value="'+Serial_Number+'" name="serial_num['+incr+']"  readonly >'+
                        '</td>'+
                        '<td>'+
                            '<input type="text" placeholder="Quanttity"  value ="'+quanttity+'"name="quanttity['+incr+']"  readonly>'+
                        '</td>'+
                        '<td>'+
                            '<input type="text" placeholder="Amount" value="'+amount+'" name="amount['+incr+']"  readonly >'+
                        '</td>'+
                        '<td>'+
                            '<textarea class="form-control"  name="description_item['+incr+']" style="height: calc(2.25rem + 2px)" placeholder="Description Items"  rows="20" readonly>'+description_item+'</textarea>'+
                        '</td>'+
                    '</tr>'+

                ''));
                $('#serial_num0').css('display','none');
                $('#quanttity0').css('display','none');
                $('#amount0').css('display','none');
                $('#description_item').css('display','none');
                $('input[name="serial_num[]"]').val('');
                $('input[name="quanttity[]"]').val('');
                $('input[name="amount[]"]').val('');
                $('textarea[name="description_item[]"]').val('');
            }
        });
        </script>
        <script>



       $(document).on('submit', '#maindata', function (e) {
            $("#alertdata").empty();
            e.preventDefault();
            var formData = new FormData($('#maindata')['0']);
            formData.append("_token", "{{ csrf_token() }}");
            $.ajax({
                method: 'post',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                url: "{{ route('create_new_invoices') }}",
                success: function(result) {

                    if (result.success) {
                        $("#alertdata").empty();
                        $("#alertdata").append("<div class= 'alert alert-success'>" + result.message +
                            "</div>");
                        $("#alertdata").attr('hidden', false);
                        $("#maindata")[0].reset();
                        $("#table").find('tbody').find("tr:gt(1)").remove();
                    } else {
                        $("#alertdata").empty();
                        result.message.forEach(element => {

                            $("#alertdata").append("<div class= 'alert alert-danger'  role='alert' >" +element+
                                "</div>");
                        });
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



    </script>
@endpush
