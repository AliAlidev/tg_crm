@extends('layouts.app')
@push('head')

    <title>Show inventories</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

    <!-- Custom styles for this page -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css" rel="stylesheet">
    <link rel="stylesheet" href="images/css/dash.css">
    <style>
        html {
            scroll-behavior: smooth;
        }

        nav.justify-between svg {
            width: 3%;
        }

        nav.justify-between,
        .leading-5 {
            margin-top: 15px;
        }


        .items-center .justify-between {
            display: none;
        }
        @font-face {
            font-family: 'Lato-Semibold';
            src: url('font/Lato-Semibold.ttf');
        }
                @font-face {
            font-family: 'Lato-Bold';
            src: url('font/Lato-Bold.ttf');
        }
        @font-face {
            font-family: 'Lato-Thin';
            src: url('font/Lato-Thin.ttf');
        }
        html {
            scroll-behavior: smooth;
        }

        nav.justify-between svg {
            width: 3%;
        }

        nav.justify-between,
        .leading-5 {
            margin-top: 15px;
        }


        .items-center .justify-between {
            display: none;
        }

        .top-title{
            font-family: 'Lato-Semibold';
            font-size:20px;
            color:#fff;
            height: 4rem;
            padding: 14px 35px;

            border-radius: 0 0px 55px 0;
            background-image:linear-gradient(to right, #211706, #291d0a, #30230c, #39290f, #412f10, #503913, #5f4416, #6e4f19, #88621f, #a37526, #be892c, #db9d33);
        }
        nav ul li:last-child {
            border-bottom: 0!important;
        }
        .content-input{display: flex;align-items: center;}
        .label{
            width: auto;
            padding-right: 12px;}
        .dropdown{width: 55%;}
        .label h4{
            color:#241907;
            font-family: 'Lato-Semibold';
            font-size:17px;
        }
        .dropdown select{
            box-shadow: 0 8px 7px -7px rgb(115 115 115 / 21%), -6px 0 7px -3px rgb(115 115 115 / 34%);
            border-right: 2px solid #db9d33;
            color:#db9d33;
            font-family: 'Lato-Regular';
            font-size:15px;
        }
         #dataTable_filter label::after{
            content: "";
            width: 70px;
    height: 28px;
    background: url(img/search2.jpg) no-repeat;
    top: 10px;
    right: 71px;
    position: relative;
    display: inline-block;
    background-size: cover;
         }
         #dataTable_filter label::before{
            font-family: fontAwesome;
            content: "\f002";
            width: 26px;
    height: 20px;
        top: 1px;
    left: 83px;
    border-right: 2px solid #e3e0e0;
    position: relative;
    display: inline-block;
    color:rgb(228 170 71);
         }
         #dataTable_filter input{
               padding: 0 36px;
               width: 20rem!important;
               outline: none!important;
               box-shadow:inset 0px 2px 2px 0px rgb(115 115 115 / 75%);
               border-radius: 0!important;
               border: 1px solid #d8d5cd;
               height: 2.1rem;
        }
        label{
            font-family: 'Lato-Regular';
        }
         #tablebuttoncsv button,#tablebuttonexcel button{
            margin-right: 13px;
            background: #6d4e18;
            border: #6d4e18;
            font-family: 'Lato-Regular';
            font-size:12px;
            color:#fff;
            width: 6rem;
            height: 2.5rem;
            border-radius: 9px!important;
            box-shadow: 0 8px 7px -7px rgb(115 115 115 / 21%), -6px 0 7px -3px rgb(115 115 115 / 34%);
         }
         .buttons-select-all{
            background: #434a49!important;
            border: #434a49!important;
         }
         #dataTable_length select{
            box-shadow: inset 0px 2px 2px 0px rgb(115 115 115 / 75%);
            border-radius: 0!important;
            height: 2.2rem;
            color: #184d47;
            font-family: 'Lato-Regular';
            padding: 7px 22px 7px 6px;
         }
         button.btn.buttons-csv::after {
           font-family: fontAwesome;
           content: "\f019";
           padding-left: 6px;
           font-size: 14px;
        }
        button.btn.buttons-excel::after {
           font-family: fontAwesome;
           content: "\f019";
           padding-left: 6px;
           font-size: 14px;
        }

        th{

            background: #6d4e18;

            /* width: 25px!important; */
        }
        span.table-title {
            width: 100%;
            font-size: 11px;
            font-family: 'Lato-Semibold';
            color: #fff;
               /* border-right: 1px solid;*/
        }
        .table th{
                /*padding: 0.75rem 10px!important;*/
                text-align: center;
                border-right: 1px solid #d3cece;
        }
        #tableinfo{
          top: 6px;
          left: 18px;
        }
        /* #bookslist_wrapper{
            border: 1px solid #e5d5d5;
            border-radius: 5px;
        } */
        #dataTable_length,#dataTable_filter,.dataTables_scroll{
            background:#fff;
        }
        #dataTable_length{
            position: absolute;
            right: 45%;
            margin-top: 30px;
            /* border: 1px solid #e5d5d5;
            border-bottom: none;
            border-radius: 8px 8px 0 0; */
        }
        #dataTable_filter{
            border-top: 1px solid #e5d5d5;
            border-left: 1px solid #e5d5d5;
            border-right: 1px solid #e5d5d5;
            border-radius: 8px 8px 0 0;
            padding: 1rem;
            height: 5rem;
        }
        #dataTable_filter label{
            margin-top: 0.5rem;
        }
        .dataTables_scroll{
            border-left: 1px solid #e5d5d5;
            border-right: 1px solid #e5d5d5;
            border-bottom: 1px solid #e5d5d5;
            border-radius: 0px 0px 8px 8px;
        }
        .group-button{
            position:relative;
            margin-top: 1.5rem;
            top: 0px;
            left: 18px;
        }
        .first a{
         background:url(img/left.jpg) no-repeat;
         background-position: center;
         background-size: cover;
         width:5rem;
         text-align: left;
         color:#fff!important;
         font-size: 13px!important;
         font-family: 'Lato-Regular'!important;

        }
        .last a{
         background:url(img/right.jpg) no-repeat;
         background-position: center;
         background-size: cover;
         width:5rem;
         text-align: right;
         color:#fff!important;
         font-size: 13px!important;
         font-family: 'Lato-Regular'!important;
        }
        #bookslist_info{
            color:#000!important;
         font-size: 13px!important;
         font-family: 'Lato-Regular'!important;
         position: absolute;
         margin-top: 1rem;
        }
        #bookslist_paginate{
            margin-top: 2rem;
        }
        .pagination li a
        {
            box-shadow: inset 0px 2px 0px 0px rgb(115 115 115 / 75%);
        }
        .odd td{
            background:#e9eaeeb5;
        }

        select::-ms-expand {
display: none;
}
.custom-select{
    background: url('img/select.jpg');
    background-size: contain;
    background-repeat: no-repeat;
    background-position: right;
}
@media(max-width:768px){
    .top-title {
    font-size: 15px;
    color: #fff;
    height: 3rem;
    padding: 11px 30px;

    }

    #tablebuttonexcel button, #tablebuttoncsv button
    {
        font-size: 10px;
    color: #fff;
    width: 4rem;
    padding: 2px;
    }
    #dataTable_filter input{
        width: 14rem!important;
    }
    #dataTable_filter label::before{
        top: 126px;
    right: 192px;
    }
    #dataTable_filter label::after {
    width: 61px;
    top: 121px;
    right: 27px;
    }
    .label h4{
        font-size: 13px;
    }
}
@media(max-width:500px){
    .content-input{
        margin-bottom: 10px;
    }
    .label {
       width: 8rem;
    }
    .group-button {
    position: initial;
    justify-content: center!important;
    }
    #dataTable_length {
    position: inherit;
    }
    #dataTable_filter input{
        width: 11rem!important;
    }
    #dataTable_filter label::after{
        top: 281px!important;
        right: 30px!important;
    }
    #dataTable_filter label::before{
        top: 283px;
        right: 179px;
    }
    #bookslist_info{
        position: inherit;
    }
    #wrapper{
        background-size: cover!important;

    }

    /*sidebar mobile */
    .sidebar .sidebar-brand {
    height: auto;
    }
    .sidebar-brand-icon{
        display: grid;
    }
    .user-name {
    width: 100%;
    }
    nav ul li {
    line-height: 7px!important;
    }
    #sbitem1 .link-content, #sbitem2 .link-content, #sbitem3 .link-content, #sbitem4 .link-content, #sbitem5 .link-content, #sbitem6 .link-content
    {
        height: 4rem;
    padding: 9px 6px;
    }
    .left-title {
    width: 90%;
    font-size: 12px;
    line-height: 1;
    }
    .icon-title{
        font-size: 10px!important;
    }
    #sbitem1_1,#sbitem1_2,#sbitem1_3,#sbitem1_4,#sbitem1_5,#sbitem1_6,#sbitem1_7,#sbitem1_8,#sbitem1_9{
        line-height: 17px!important;
        margin-bottom: 10px;
    }
    #sbitem1_1 a,#sbitem1_2 a,#sbitem1_3 a,#sbitem1_4 a,#sbitem1_5 a,#sbitem1_6 a,#sbitem1_7 a,#sbitem1_8 a,#sbitem1_9 a
        {
            padding-left: 15px!important;
            font-size: 12px!important;
        }
    #sbitem2_1,#sbitem2_2,#sbitem2_3,#sbitem2_4,#sbitem2_5,#sbitem2_6,#sbitem2_7,#sbitem2_8,#sbitem2_9,#sbitem2_10,#sbitem2_11{
        line-height: 17px!important;
        margin-bottom: 10px!important;
    }
    #sbitem2_1 a,#sbitem2_2 a,#sbitem2_3 a,#sbitem2_4 a,#sbitem2_5 a,#sbitem2_6 a,#sbitem2_7 a,#sbitem2_8 a,#sbitem2_9 a,#sbitem2_10 a,#sbitem2_11 a

        {
            padding-left: 15px!important;
            font-size: 12px!important;
        }
}


 #bg-top{
   width: 157%;
    margin-left: -5rem;
    margin-top: -9rem;
}
#sel1:focus-visible,#daymonthvalue:focus-visible,#rangedate:focus-visible,#datasource:focus-visible{
    outline: none;
}
#agentname,#userstatus,#datasource{
    font-family: 'Lato-Regular'!important;
    font-size: 12px!important;
    display: inline-block;
    /*width: 100%;*/
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
#areafilter,#residencecountryfilter{
    box-shadow: 0 4px 2px -2px #d9d1d1;
    color: #878b8f;
    vertical-align: middle;
    height: calc(2.25rem + 2px);
    padding: 0.375rem 1.75rem 0.375rem 0.75rem;
        font-size: 12px;
        font-family: 'Lato-Regular'!important;
}
#daymonthfilter,#rangefilter{
        margin-left: -5px;
   box-shadow: 0 4px 2px -2px #d9d1d1;
       background: #fff;
    height: calc(2.25rem + 2px);
       padding: 0.475rem 5px 0.775rem 5px;
       position: absolute;
    right: 4px;
    z-index: 1000;
    width: 3rem;
}
#border{
        margin-right: -8px;
    margin-left: -5px;
    box-shadow: 0 4px 2px -2px #d9d1d1;
    height: calc(2.25rem + 2px);
    /* padding: 0.475rem 5px 0.775rem 5px; */
    width: 54px;
}
#border img{
        width: 138%;
    margin-right: -25px;
    height: 100%;
    transform: scaleX(1);
}
#border2{
    margin-right: -8px;
    margin-left: -5px;
    box-shadow: 0 4px 2px -2px #d9d1d1;
    height: calc(2.25rem + 2px);
    /* padding: 0.475rem 5px 0.775rem 5px; */
    width: 46px;
}
#border2 img{
    width: 135%;
    margin-right: -21px;
    height: 100%;
        transform: scaleY(-1);
}
#border3{
       margin-right: -39px;
    margin-left: -12px;
    box-shadow: 0 4px 2px -2px #d9d1d1;
    height: calc(2.25rem + 1px);
    /* padding: 0.475rem 5px 0.775rem 5px; */
    width: 46px;
}
#border3 img{
       width: 89%;
    /* margin-right: -21px; */
    height: 103%;
    transform: scaleX(-2);
}
#border4{
 margin-right: -33px;
    margin-left: -20px;
    box-shadow: 0 4px 2px -2px #d9d1d1;
    height: calc(2.25rem + 2px);
    /* padding: 0.475rem 5px 0.775rem 5px; */
    width: 46px;
}
#border4 img{
        width: 89%;
    /* margin-right: -21px; */
    height: 100%;
    transform: scaleX(1.3);
}
#datetimepicker2 label{
    width:21%;
    text-align: left;
    color: #143e39;
    font-family: 'Lato-Bold';
    font-size: 13px;
    margin-left: -10px;
}
.card-header{
        padding: 0 2rem;
       /* margin-top: 3rem;*/
}
.pad-row{
    padding: 0 4.8rem 0 4rem;
}
.pad-row2{
    padding: 0 4.8rem 0 0;
}
.row3{
    margin-top: -4.5rem;
}
#img-div{
margin-top: -20px;
    margin-bottom: 10px;
    margin-left: -10px;
}
#resid:after{
        content: '';
    position: absolute;
    top: 25px;
    border-radius: 100%;
    /* border: 48px solid transparent; */
    border-top: 35px solid #f7f8f8;
    display: block;
    width: 7rem;
    height: 0;
    left: 50%;
    transform: translateX(-50%);
    box-shadow:-1px -5px 3px -3px #d9d1d1;
    /* border-top: 1px solid #d9d1d1;*/
}
#resid2:before{
    content: '';
    position: absolute;
    bottom: 25px;
    border-radius: 100%;
    /* border: 48px solid transparent; */
    border-bottom: 35px solid #f7f8f8;
    display: block;
    width: 7rem;
    height: 0px;
    left: 50%;
    transform: translateX(-43%);
    box-shadow:-1px 4px 4px -3px #d9d1d1;
    /* border-top: 1px solid #d9d1d1;*/
}
#dataTable_length, #dataTable_filter, .dataTables_scroll{
    background: #fff;
}
 .card-body{
          margin-top: -3.5rem!important;
        }
        #wrapper{
            height: 100%!important;
        }



        div.dataTables_scrollBody::-webkit-scrollbar {
  width: 5px;
}
div.dataTables_scrollBody::-webkit-scrollbar {
  width: 3px!important;

}

/* Track */
div.dataTables_scrollBody::-webkit-scrollbar-track {
  background: #c5c5c5!important;
}

/* Handle */
div.dataTables_scrollBody::-webkit-scrollbar-thumb {
  background: #6d4e18;
  border-radius: 0px;
  border-radius: 8px;
}

/* Handle on hover */
div.dataTables_scrollBody::-webkit-scrollbar-thumb:hover {
  background: #6d4e18;
  border-radius: 8px;
}

.justify-content-start{
    top: 47px;
    left: 18px;
}
.content-input{
        display: flex;
    align-items: center;
}
.content-input span{
    width: 28%;
    color: #143e39;
    font-family: 'Lato-Bold';
    font-size: 13px;
}
.content-input select{
        width: 55%;
}
#wrapper #content-wrapper {
    width: 100%;
    overflow-x: inherit!important;
    padding-bottom:3rem;
    }
    .btn-group{
        top: 60px;
    left: 15px;
    }
    .btn-group button{
        background: #5c4215;
    }
/*responsive*/
@media(max-width: 500px){
    .justify-content-start{
        top: 0!important;
        left: 0!important;
        justify-content: center!important;
    }
    .card-body{
        padding: 0;
        margin-top: -1.5rem!important;
    }
    #dataTable_length{
        background: transparent;
    }
    #dataTable_filter label::after{
        top: 10px!important;
    }
    #dataTable_filter label::before{
        top: 1px!important;
    }
    .table td, .table th{
        padding: .35rem!important;
    }
    .justify-content-end{
        justify-content: center!important;
    }
    .btn-group {
    top: 0;
    left: 0;
    position: inherit!important;
}

}
@media(max-width: 768px) and (min-width: 550px){
    .btn-group {
    top: 0;
    left: 0;
    position: inherit!important;
    margin-bottom: 1rem;
}
    .justify-content-start{
        top: -34px;
    }
    #dataTable_length{
        right: 67%;
    }
    #dataTable_filter label::before{
        top: 2px!important;
    }
    #dataTable_filter label::after{
        height: 29px!important;
        top: 11px!important;
    }

}
@media(max-width: 1024px) and (min-width: 780px){
    #dataTable_length{
        right: 49%;
    }
    #dataTable_filter label::after{
        top: 11px!important;
    }
}
/*end responsive*/
    </style>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->

    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
    </script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.js"
        crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.css"
        crossorigin="anonymous" />

    <!--datatable-->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/date-1.1.0/fh-3.1.9/sb-1.1.0/sp-1.3.0/sl-1.3.3/datatables.min.css" />

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/date-1.1.0/fh-3.1.9/sb-1.1.0/sp-1.3.0/sl-1.3.3/datatables.min.js">
    </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.5.0/css/colReorder.bootstrap.min.css">
    <script src="https://cdn.datatables.net/colreorder/1.5.0/js/dataTables.colReorder.min.js"></script>

    <!--  datetime range -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    {{-- swal alert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@endpush

@section('wrapper_content')

    <!-- Content Wrapper -->
    <div class="container-fluid" style="padding-left:0!important">
    <div class="row">
        <div class="col-lg-4 col-md-5 col-8" >
            <h3 class="top-title">Show inventories</h3>
        </div>
    </div>
    </div>
    <div id="content-wrapper" class="d-flex flex-column" >

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid" style="margin-top:1.5rem">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800"></h1>

                <!-- DataTales Example -->
                <div id="parent" class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class=" pb-3 mt-3" role="alert" id="alert" hidden>
                        </div>

                    </div>
                    <div class="card-body mt-3">
                        <table class="table table-bordered table-hover"  id="dataTable">
                            <thead style="background: #70cacc;color: aliceblue;">
                                <tr>
                                <th><span class="table-title">id</span></th>
                                    <th><span class="table-title">Client Name</span></th>
                                    <th><span class="table-title">Address 1</span></th>
                                    <th><span class="table-title">Second Address</span></th>
                                    <th><span class="table-title">Country</span></th>
                                    <th><span class="table-title">Date</span></th>
                                    <th><span class="table-title">L.P.O.N.O</span></th>
                                    <th><span class="table-title">Description</span></th>
                                    <th><span class="table-title">Note</span></th>
                                    <th><span class="table-title">Items</span></th>
                                    <th><span class="table-title">Action</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <input id="startdate" type="text" hidden>
                                <input id="enddate" type="text" hidden>
                            </tbody>
                        </table>

                        <div class="row mt-2">
                            <div id="tableinfo" class="col-md-6 d-flex justify-content-start"></div>
                            <div id="tablepaginate" class="col-md-6 d-flex justify-content-end"></div>
                        </div>
                    </div>


                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->



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
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'center',
                ranges: {
                    '1900-1950': ['1/1/1900', '1/1/1950'],
                    '1950-2000': ['1/1/1950', '1/1/2000'],
                    '2000-2050': ['1/1/2000', '1/1/2050'],
                    '2050-3000': ['1/1/2050', '1/1/3000'],
                },
                "showDropdowns": false,
                "startDate": "01/01/1900",
                "endDate": Date.now(),
                "minYear": 1900,
                "maxYear": 3000,
            }, function(start, end, label) {
                $('#startdate').val(start.format('YYYY-MM-DD'));
                $('#enddate').val(end.format('YYYY-MM-DD'));
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            let table = $('#dataTable').DataTable({
                colReorder: true,
                "ordering": false,
                "processing": true,
                "serverSide": true,
                scrollY: 500,
                scrollX: true,
                scrollCollapse: true,
                "pageLength": 100,
                "paging": true,
                "pagingType": "full_numbers",
                "ajax": {
                    "url": "{{ route('get_invoices') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d._token = "{{ csrf_token() }}";
                    },
                    beforeSend: function() {
                        $("#parent").LoadingOverlay("show", {
                            background: "rgba(78, 115, 223, 0.5)"
                        });
                    },
                    complete: function() {
                        $("#parent").LoadingOverlay("hide", true);
                    }
                },
                "columns": [{
                        data: "id",
                        width: '50px',

                    },
                    {
                        data: "client_name",
                        width: '200px',

                    },
                    {
                        data: "address1",
                        width: '200px',
                    },
                    {
                        data: "address2",
                        width: '200px'
                    },
                    {
                        data: "country",
                        width: '200px'
                    },
                    {
                        data: "date",
                        width: '200px'
                    },
                    {
                        data: "LPONO",
                        width: '200px'
                    },
                    {
                        data: "description",
                        width: '200px'
                    },
                    {
                        data: "note",
                        width: '200px'
                    },
                    {
                        data: "items",
                        width: '600px',

                    },

                    {
                        data: "action",
                        width: '250px'
                    }
                ],
                "lengthMenu": [
                    [100, 500, 1000, 2000, 5000, 10000],
                    [100, 500, 1000, 2000, 5000, 10000]
                ],
                "language":{
                    searchPlaceholder:"Type and press Enter"
                },
                dom: 'lftipB',
                "paging": true,
                    "buttons": [

                    ],
                    initComplete: (settings, json) => {
                        $('#tablepaginate').empty();
                        $('#dataTable_paginate').appendTo('#tablepaginate');
                        $('#tableinfo').empty();
                        $('#dataTable_info').appendTo('#tableinfo');
                        $('#tablebuttoncsv').empty();
                        $('.btn.btn-secondary.buttons-csv.buttons-html5').appendTo(
                            '#tablebuttoncsv');
                        $('#tablebuttonexcel').empty();
                        $('.btn.btn-secondary.buttons-excel.buttons-html5').appendTo(
                            '#tablebuttonexcel');
                        $('#tablebuttonpdf').empty();
                        $('.btn.btn-secondary.buttons-pdf.buttons-html5').appendTo(
                            '#tablebuttonpdf');
                    }
                });

                $("div.dataTables_filter input").unbind();
                $("div.dataTables_filter input").keyup(function(
                    e) {
                    console.log(e.keyCode);
                    if (e.keyCode == 13) {
                        table.search(this.value).draw();
                    }
                });

                $('#dataTable').DataTable().draw();

                function newexportaction(e, dt, button, config) {
                    var self = this;
                    var oldStart = dt.settings()[0]._iDisplayStart;
                    dt.one('preXhr', function(e, s, data) {
                        // Just this once, load all data from the server...
                        data.start = 0;
                        data.length = 2147483647;
                        dt.one('preDraw', function(e, settings) {
                            // Call the original action function
                            if (button[0].className.indexOf('buttons-copy') >= 0) {
                                $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt,
                                    button, config);
                            } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                                $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt,
                                        button, config) :
                                    $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt,
                                        button, config);
                            } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                                $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt,
                                        button, config) :
                                    $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt,
                                        button, config);
                            } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                                $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt,
                                        button, config) :
                                    $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt,
                                        button, config);
                            } else if (button[0].className.indexOf('buttons-print') >= 0) {
                                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                            }
                            dt.one('preXhr', function(e, s, data) {
                                // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                                // Set the property to what it was before exporting.
                                settings._iDisplayStart = oldStart;
                                data.start = oldStart;
                            });
                            // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                            setTimeout(dt.ajax.reload, 0);
                            // Prevent rendering of the full data to the DOM
                            return false;
                        });
                    });
                    // Requery the server with the new one-time export settings
                    dt.ajax.reload();
                }

                $('#dataTable').on('search.dt', function() {
                    var value = $('.dataTables_filter input').val();
                    var s = $('#filter:text').val(value);
                    $('#alertdiv').attr('hidden', true);
                });
            $('body').on('click', '.download', function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                var id = table.row(this.closest('tr')).data()['id'];
                $.ajax({
                    type: "POST",
                    url: "{{ route('downloadInvoices') }}",
                    data: {
                            id: id
                        },
                        success: function(result) {
                            window.open("/Invoice"+ "{{ Auth::user()->id }}" + ".pdf",'_blank');
                        },
                        error: function(erorr) {
                            console.log(erorr);
                        }
                    });
                });
                $('body').on('click', '.delete', function() {
                    var id = table.row(this.closest('tr')).data()['id'];
                    swal({
                        title: 'Are you sure?',
                        text: 'This record and it`s details will be permanantly deleted!',
                        icon: 'warning',
                        buttons: ["Cancel", "Yes!"],
                    }).then(function(value) {
                        if (value) {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                type: "POST",
                                url: "{{ route('DELETE_INVOICE') }}",
                                data: {
                                    id: id
                                },
                                dataType: 'json',
                                success: function(result) {
                                    if (result.success) {
                                        $('#alert').empty();
                                        $('#alert').append(
                                            "<div class= 'alert alert-success'>" +
                                            result
                                            .message +
                                            "</div>");
                                        $('#alert').attr('hidden', false);
                                        table.clear().draw();
                                    } else {
                                        $('#alert').empty();
                                        $('#alert').append(
                                            "<div class= 'alert alert-danger'>" +
                                            result
                                            .message +
                                            "</div>");
                                        $('#alert').attr('hidden', false);
                                    }
                                },
                            });
                        }
                    });
                });
            });

    </script>

    <!-- jQuery library -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
        integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous">
    </script>

@endpush
