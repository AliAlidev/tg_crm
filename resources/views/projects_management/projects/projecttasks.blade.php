@extends('layouts.app')

@push('head')
    <title>Project task</title>

    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

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

        #maindata,
        #project_de {
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

        #buttonsubmit,
        #update,
        #createitem {
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

        .top-title {
            font-family: 'Lato-Semibold';
            font-size: 20px;
            color: #fff;
            height: 4rem;
            padding: 14px 35px;

            border-radius: 0 0px 55px 0;
            background-image: linear-gradient(to right, #211706, #291d0a, #30230c, #39290f, #412f10, #503913, #5f4416, #6e4f19, #88621f, #a37526, #be892c, #db9d33);
        }

        nav ul li:last-child {
            border-bottom: 0 !important;
        }

        .content-input {
            display: flex;
            align-items: center;
        }

        .label {
            width: auto;
            padding-right: 12px;
        }

        .dropdown {
            width: 55%;
        }

        .label h4 {
            color: #241907;
            font-family: 'Lato-Semibold';
            font-size: 17px;
        }

        .dropdown select {
            box-shadow: 0 8px 7px -7px rgb(115 115 115 / 21%), -6px 0 7px -3px rgb(115 115 115 / 34%);
            border-right: 2px solid #db9d33;
            color: #db9d33;
            font-family: 'Lato-Regular';
            font-size: 15px;
        }

        #dataTable_filter label::after {
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

        #dataTable_filter label::before {
            font-family: fontAwesome;
            content: "\f002";
            width: 26px;
            height: 20px;
            top: 1px;
            left: 83px;
            border-right: 2px solid #e3e0e0;
            position: relative;
            display: inline-block;
            color: rgb(228 170 71);
        }

        #dataTable_filter input {
            padding: 0 36px;
            width: 20rem !important;
            outline: none !important;
            box-shadow: inset 0px 2px 2px 0px rgb(115 115 115 / 75%);
            border-radius: 0 !important;
            border: 1px solid #d8d5cd;
            height: 2.1rem;
        }

        label {
            font-family: 'Lato-Regular';
        }

        #tablebuttoncsv button,
        #tablebuttonexcel button {
            margin-right: 13px;
            background: #6d4e18;
            border: #6d4e18;
            font-family: 'Lato-Regular';
            font-size: 12px;
            color: #fff;
            width: 6rem;
            height: 2.5rem;
            border-radius: 9px !important;
            box-shadow: 0 8px 7px -7px rgb(115 115 115 / 21%), -6px 0 7px -3px rgb(115 115 115 / 34%);
        }

        .buttons-select-all {
            background: #434a49 !important;
            border: #434a49 !important;
        }

        #dataTable_length select {
            box-shadow: inset 0px 2px 2px 0px rgb(115 115 115 / 75%);
            border-radius: 0 !important;
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

        th {

            background: #6d4e18;

            /* width: 25px!important; */
        }

        span.table-title {
            width: 100%;
            font-size: 12px;
            font-family: 'Lato-Semibold';
            color: #fff;
            /* border-right: 1px solid;*/
        }

        /* #bookslist_wrapper{
                        border: 1px solid #e5d5d5;
                        border-radius: 5px;
                    } */
        #dataTable_length,
        #dataTable_filter,
        #.dataTables {
            background: #fff;
        }

        #dataTable_length {
            position: absolute;
            right: 45%;
            margin-top: 30px;
            /* border: 1px solid #e5d5d5;
                        border-bottom: none;
                        border-radius: 8px 8px 0 0; */
        }

        #dataTable_filter {
            border-top: 1px solid #e5d5d5;
            border-left: 1px solid #e5d5d5;
            border-right: 1px solid #e5d5d5;
            border-radius: 8px 8px 0 0;
            padding: 1rem;
            height: 5rem;
        }

        #dataTable_filter label {
            margin-top: 0.5rem;
        }

        .dataTables_scroll {
            border-left: 1px solid #e5d5d5;
            border-right: 1px solid #e5d5d5;
            border-bottom: 1px solid #e5d5d5;
            border-radius: 0px 0px 8px 8px;
        }

        .group-button {
            position: relative;
            margin-top: 1.5rem;
            top: 0px;
            left: 18px;
        }

        .first a {
            background: url(img/left.jpg) no-repeat;
            background-position: center;
            background-size: cover;
            width: 5rem;
            text-align: left;
            color: #fff !important;
            font-size: 13px !important;
            font-family: 'Lato-Regular' !important;

        }

        .last a {
            background: url(img/right.jpg) no-repeat;
            background-position: center;
            background-size: cover;
            width: 5rem;
            text-align: right;
            color: #fff !important;
            font-size: 13px !important;
            font-family: 'Lato-Regular' !important;
        }

        #bookslist_info {
            color: #000 !important;
            font-size: 13px !important;
            font-family: 'Lato-Regular' !important;
            position: absolute;
            margin-top: 1rem;
        }

        #bookslist_paginate {
            margin-top: 2rem;
        }

        .pagination li a {
            box-shadow: inset 0px 2px 0px 0px rgb(115 115 115 / 75%);
        }

        .odd td {
            background: #e9eaeeb5;
        }

        select::-ms-expand {
            display: none;
        }

        .custom-select {
            background: url('img/select.jpg');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: right;
        }

        @media(max-width:768px) {
            .top-title {
                font-size: 15px;
                color: #fff;
                height: 3rem;
                padding: 11px 30px;

            }

            #tablebuttonexcel button,
            #tablebuttoncsv button {
                font-size: 10px;
                color: #fff;
                width: 4rem;
                padding: 2px;
            }

            #dataTable_filter input {
                width: 14rem !important;
            }

            #dataTable_filter label::before {
                top: 126px;
                right: 192px;
            }

            #dataTable_filter label::after {
                width: 61px;
                top: 121px;
                right: 27px;
            }

            .label h4 {
                font-size: 13px;
            }
        }

        #resid:after {
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
            box-shadow: -1px -5px 3px -3px #d9d1d1;
            /* border-top: 1px solid #d9d1d1;*/
        }

        #resid2:before {
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
            box-shadow: -1px 4px 4px -3px #d9d1d1;
            /* border-top: 1px solid #d9d1d1;*/
        }

        #dataTable_length,
        #dataTable_filter,
        .dataTables_scroll {
            background: #fff;
        }

        .card-body {
            margin-top: -3.5rem !important;
        }

        #wrapper {
            height: auto !important;
        }



        div.table-responsive::-webkit-scrollbar {
            width: 5px;
        }

        div.table-responsive::-webkit-scrollbar {
            width: 3px !important;

        }

        /* Track */
        div.table-responsive::-webkit-scrollbar-track {
            background: #c5c5c5 !important;
        }

        /* Handle */
        div.table-responsive::-webkit-scrollbar-thumb {
            background: #6d4e18;
            border-radius: 0px;
            border-radius: 8px;
        }

        /* Handle on hover */
        div.table-responsive::-webkit-scrollbar-thumb:hover {
            background: #6d4e18;
            border-radius: 8px;
        }

        .col-md-3.justify-content-start {
            top: 29px;
            left: 18px;
        }

        .content-input {
            display: flex;
            align-items: center;
        }

        .content-input span {
            width: 28%;
            color: #143e39;
            font-family: 'Lato-Bold';
            font-size: 13px;
        }

        .content-input select {
            width: 55%;
        }

        .bottom-row {
            justify-content: flex-start;
            padding: 0 0 0 3rem;
        }

        .bottom-row .card {
            border-bottom: 1px solid #184d47;
            border-radius: 0;
            display: inline-flex !important;
            margin-left: -5px;
        }


        .bottom-row .card .card-header {
            font-family: 'Lato-Bold';
            font-size: 10px;
            color: #184d47;
            padding: 0.75rem 0.1rem !important;
        }

        .bottom-row .card .card-header .sp {
            padding: 0rem 1rem !important;
            border-right: 1px solid #251a08;
            border-right: 1px solid #251a08;
        }

        .bottom-row .card .card-header .sp2 {
            padding: 0rem 1rem !important;
            /* border-right: 1px solid #184d47;*/
            /*        border-right: 1px solid #184d47;*/
        }

        .bottom-row .card .card-body {
            margin-top: 0 !important
        }


        table.dataTable {
            margin-top: 0 !important;
        }

        #card-bottom .card-body {
            margin-top: 0 !important;
            padding: 10px !important;
        }

        #dataTable_next a::after {
            content: "";
            width: 70px;
            height: 30px;
            background: url(img/right.jpg) no-repeat;
            top: 0px;
            right: -65px;
            position: absolute;
            display: inline-block;
            background-size: contain;
        }

        #dataTable_previous a::before {
            content: "";
            width: 70px;
            height: 30px;
            background: url(img/left.jpg) no-repeat;
            top: 0px;
            left: -49px;
            position: absolute;
            display: inline-block;
            background-size: contain;
        }

        #tablepaginate {
            padding-right: 4rem;
        }

        /*start*/
        .page-item.active .page-link {
            z-index: 3;
            color: #6d4e18 !important;
            font-family: 'Lato-Semibold' !important;
            background-color: #ffffff !important;
            /* border-color: #ffffff; */
            top: 0px !important;
            border: none !important;
            border-bottom: 2px solid #6d4e18 !important;
        }

        .page-link:focus {
            box-shadow: inset 0px 2px 0px 0px rgb(115 115 115 / 75%) !important;
        }

        .page-link {
            position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #114c45;
            background-color: #fff;
            border: none;
        }

        .page-link:hover {
            z-index: 2;
            color: #224abe;
            text-decoration: none;
            background-color: #e9edec87 !important;
            /*border-color: #e5e5e5;*/
            color: #114c45 !important;
        }

        .page-link:hover {
            z-index: 2;
            color: #224abe;
            text-decoration: none;
            background-color: #e9edec87 !important;
            /* border-color: #e5e5e5; */
            color: #bec7c6 !important;
        }










        .mod {
            width: 50%;
            margin: auto;
            padding: 30px;
            position: fixed;
            box-shadow: 0px 0px 4px 1px #6c4d18;
            border: 1px solid #e4aa47;
            top: 40%;
            background-color: white;
            transform: translate(-50%, -50%);
            left: 60%;
            display: none;
        }

        #times {
            position: absolute;
            left: 90%;
            top: 5%;
            /* margin: 10px; */
            z-index: 10;
            cursor: pointer;

        }
    </style>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/date-1.1.0/fh-3.1.9/sb-1.1.0/sp-1.3.0/sl-1.3.3/datatables.min.css" />

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/date-1.1.0/fh-3.1.9/sb-1.1.0/sp-1.3.0/sl-1.3.3/datatables.min.js">
    </script>
@endpush

@section('wrapper_content')
    <div class="container-fluid" style="padding-left:0!important">
        <div class="row">
            <div class="col-lg-4 col-md-5 col-9">
                <h3 class="top-title">Project Tasks</h3>
            </div>
        </div>
    </div>
    <div id="content-wrapper" class="d-flex flex-column">
        <form id="project_de">
            <div class="container">
                {{-- <span id="alertdata"></span> --}}
                <h2 class="m-0">Project Details</h2>

                <div class="row mt-4 " style="align-items: center;">
                    <div class="col-md-3">
                        <label class="title-input" for="property">Name</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{{ $project_de->name }}" readonly id="name">
                    </div>
                    {{-- <p class=""><b>Name:</b>name</p> --}}
                </div>
                <div class="row mt-4" style="align-items: center;">
                    {{-- <p class=""><b>Code:</b>name</p> --}}
                    <div class="col-md-3">
                        <label class="title-input" for="property">Code</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{{ $project_de->code }}" readonly id="name">
                    </div>
                </div>
                <div class="row mt-4" style="align-items: center;">
                    {{-- <p class=""><b>Date:</b>name</p> --}}
                    <div class="col-md-3">
                        <label class="title-input" for="property">Date</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{{ $project_de->date }}" readonly id="name">
                    </div>
                </div>
                <div class="row mt-4" style="align-items: center;">
                    {{-- <p class=""><b>Client:</b>name</p> --}}
                    <div class="col-md-3">
                        <label class="title-input" for="property">Client</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{{ $project_de->client }}" readonly id="name">
                    </div>
                </div>
                <div class="row mt-4" style="align-items: center;">
                    {{-- <p class=""><b>Description:</b>name</p> --}}
                    <div class="col-md-3">
                        <label class="title-input" for="property">Description</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{{ $project_de->description }}" readonly id="name">
                    </div>
                </div>
                <div class="row mt-3" style="align-items: center;">
                    {{-- <p class=""><b>Contributors:</b> name</p> --}}
                    <div class="col-md-3">
                        <label class="title-input" for="property">Contributors</label>
                    </div>
                    <div class="col-md-8">
                        @foreach ($project_users as $user)
                            <input type="text" value="{{ $user->name }}" readonly id="name">
                        @endforeach
                    </div>

                </div>
                <div class="row mt-4" style="align-items: center;">
                    {{-- <p class=""><b>Project Type: </b> name</p> --}}
                    <div class="col-md-3">
                        <label class="title-input" for="property">Project Type</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{{ $project_type->name }}" readonly id="name">
                    </div>
                </div>
            </div>
        </form>
        <form id="maindata1">

            <div id="maindata" width="90%" class="mt-5">
                <div class="container">
                    <span id="alertdata"></span>
                    <h2 class="m-0">Create Task</h2>
                    <div class="row mt-4 mb-4" style="align-items: center;">
                        <input class="form-control ml-1" type="text"value="{{ $project_de->id }}" name="project_id"
                            hidden>
                        <div class="col-md-2">
                            <label class="title-input" for="property">Task</label>
                        </div>
                        <div class="col-md-10 ">
                            <input class="form-control ml-1" type="text" id="property" placeholder="Enter Task"
                                name="task[]">
                            <p id="task" class="mt-1" style="color:rosybrown;display:none">Task is required</p>
                        </div>

                    </div>
                    <div class="row mt-4 mb-4" style="align-items: center;">
                        <div class="col-md-2 ">
                            <label class="title-input" for="property">Start Date</label>
                        </div>
                        <div class="col-md-4 ">
                            <input class="form-control ml-1" type="date" id="property"
                                placeholder="Enter Start Date" name="start_date[]">
                            <p id="start_date" class="mt-1" style="color:rosybrown;display:none">Start Date is required
                            </p>
                        </div>
                        <div class="col-md-2">
                            <label class="title-input" for="property">End Date</label>
                        </div>
                        <div class="col-md-4 ">
                            <input class="form-control ml-1" type="date" id="property" placeholder="Enter End Date"
                                name="end_task[]">
                            <p id="end_task" class="mt-1" style="color:rosybrown;display:none">End Date is required
                            </p>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-2">
                            <label class="title-input" for="property">Contributors</label>
                        </div>
                        <div class="col-md-10 mb-3 ">
                            <input class="form-control ml-1" type="text" id="property"
                                placeholder="Enter Contributors" name="contributors[]">
                            <p id="contributors" class="mt-1" style="color:rosybrown;display:none">Contributors is
                                required</p>
                        </div>
                        <div class="col-md-12 text-center mb-5">
                            <button id="createitem" type="button" class="registerbtn">Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="car mb-5 " style="height:50%">
                <div style="width: 90%;margin:auto" class="table-responsive" style="height:auto;overflow:scroll">
                    <h2 class="m-0">List Tasks</h2>
                    <table class="table table-bordered table-hover" id="table">
                        <thead style="background: #70cacc;color: aliceblue;">
                            <tr>
                                <th><span class="table-title">id</span></th>
                                <th><span class="table-title">Task</span></th>
                                <th><span class="table-title">Start Date</span></th>
                                <th><span class="table-title">End Date </span></th>
                                <th><span class="table-title">Contributors </span></th>
                                <th><span class="table-title">Action</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projectTasks as $key => $task)
                                <tr class="row1" id="{{ $key+1 }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <input type="text" value="{{ $task->task }}"
                                            name="task[{{ $key + 1 }}]" id="property" readonly>
                                    </td>
                                    <td>
                                        <input type="date" value="{{ $task->start_date }}"
                                            name="start_date[{{ $key + 1 }}]" id="property" readonly>
                                    </td>
                                    <td>
                                        <input type="date" value="{{ $task->end_date }}"
                                            name="end_task[{{ $key + 1 }}]" id="property" readonly>
                                    </td>
                                    <td>
                                        <input type="text" value="{{ $task->contributors }}"
                                            name="contributors[{{ $key + 1 }}]" id="property" readonly>
                                    </td>
                                    <td><a class=" delete btn-danger btn btn-sm">Delete</a><a
                                            class=" edit ml-1 btn-info btn btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row mb-5">
                    <div class="col-md-12 text-center">
                        <button id="buttonsubmit" type="submit" class="registerbtn">Create Tasks</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="mod">
            <h5>Update Task</h5>
            <hr>
            <i class=" fa fa-times" id="times"></i>
            <div class="container">
                <div id="alertdata1"></div>
                <div class="row mt-4 mb-4" style="align-items: center;">

                    <div class="col-md-2">
                        <label class="title-input" for="property">Task</label>
                    </div>
                    <div id="task_update" class="col-md-10 ">
                        <input class="form-control ml-1" type="text" id="task1"
                             name="task1" >
                        <p id="task_update_p" class="mt-1" style="color:rosybrown;display:none">Task is required</p>

                    </div>
                </div>
                <div class="row mt-4 mb-4" style="align-items: center;">
                    <div class="col-md-2 ">
                        <label class="title-input" for="property">Start Date</label>
                    </div>
                    <div id="start_update" class="col-md-4 ">
                        <input class="form-control ml-1" type="date" id="property"
                             name="start_date1" >
                        <p id="start_date_update_p" class="mt-1" style="color:rosybrown;display:none">Start Date is
                            required</p>
                    </div>
                    <div class="col-md-2">
                        <label class="title-input" for="property">End Date</label>
                    </div>
                    <div id="end_update" class="col-md-4 ">
                        <input  class="form-control ml-1" type="date" id="property"
                             name="end_task1" >
                        <p id="end_task_update_p" class="mt-1" style="color:rosybrown;display:none">End Date is
                            required</p>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-2">
                        <label class="title-input" for="property">Contributors</label>
                    </div>
                    <div id="contributors_update" class="col-md-10">

                        <input class="form-control ml-1" type="text" id="property"
                             name="contributors1" >
                        <p id="contributors_update_p" class="mt-1" style="color:rosybrown;display:none">Contributors is
                            required</p>
                    </div>
                    <div id="id_update" class="col-md-10" style="color:rosybrown;display:none">

                        <input class="form-control ml-1" type="text" id="row_id"
                             name="row_id" value="" hidden>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12 text-center">
                        <button id="update" class="registerbtn">update Task</button>
                    </div>
                </div>
            </div>



        </div>
    @endsection

    @section('content')
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
    @endsection

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet"
            type="text/css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
            integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous">
        </script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script>
            $(document).on('click', '#times', function() {
                $('.mod').css('display', 'none');
                $("#alertdata1").empty()
            })

            $(document).on('submit', '#maindata1', function(e) {
                $("#alertdata").empty();
                e.preventDefault();
                var formData = new FormData($('#maindata1')['0']);
                formData.append("_token", "{{ csrf_token() }}");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'post',
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    data: formData,
                    url: "{{ route('storeTask') }}",
                    success: function(result) {
                        if (result.state) {
                            $("#alertdata").empty();
                            $("#alertdata").append("<div class= 'alert alert-success'>" + result.message +
                                "</div>");
                            $("#alertdata").attr('hidden', false);
                            $("#maindata")[0].reset();
                            $('#dataTable').DataTable().draw();
                            $("#table").find('tbody').find("tr:gt(0)").remove();
                            $('.car').css('display', 'none');
                        } else {
                            $("#alertdata").empty();
                            $.each(result.message, function(key, value) {
                                $("#alertdata").append("<div class= 'alert alert-danger'>" + value +
                                    "</div>");
                            });
                            $("#alertdata").attr('hidden', false);
                        }
                    },

                });
            })

            $('body').on('click', '.edit', function() {
                var id = $(this).parents("tr").find("td:eq(0)").text();
                var task = $(this).parents("tr").find("td:eq(1)").find("input").val();
                $('#task_update :input').val(task);
                $('#id_update').find("input").val(id);

                var start = $(this).parents("tr").find("td:eq(2)").find("input").val();
                $('#start_update :input').val(start);
                var end = $(this).parents("tr").find("td:eq(3)").find("input").val();
                $('#end_update :input').val(end);
                var contributors = $(this).parents("tr").find("td:eq(4)").find("input").val();
                $('#contributors_update :input').val(contributors);
                $('.mod').css('display', 'block');

            });
            $('body').on('click', '#update', function(e) {
                var row_id = $('#id_update').find("input").val();

                $("#alertdata1").empty();

                var task = $('#task_update :input').val();
                var end_date = $('#start_update :input').val();
                var start_date = $('#end_update :input').val();
                var contributors = $('#contributors_update :input').val();


                 $('#table tr:eq('+row_id+') td:eq(1)').find("input").val(task);

                $('#table tr:eq('+row_id+') td:eq(2)').find("input").val(end_date);

                $('#table tr:eq('+row_id+') td:eq(3)').find("input").val(start_date);

                $('#table tr:eq('+row_id+') td:eq(4)').find("input").val(contributors);

                var id = $('#id_update').text();
                var int_id = parseInt(id);
                e.preventDefault();
                if (task == '' && end_date == '' && start_date == '' && contributors == '') {
                    $('#task_update_p').css('display', 'block');
                    $('#end_task_update_p').css('display', 'block');
                    $('#start_date_update_p').css('display', 'block');
                    $('#contributors_update_p').css('display', 'block');
                } else if (task == '') {
                    $('#task_update_p').css('display', 'block');
                    $('#end_task_update_p').css('display', 'none');
                    $('#start_date_update_p').css('display', 'none');
                    $('#contributors').css('display', 'none');
                } else if (end_date == '') {
                    $('#task_update_p').css('display', 'none');
                    $('#end_task_update_p').css('display', 'block');
                    $('#start_date_update_p').css('display', 'none');
                    $('#contributors').css('display', 'none');
                } else if (start_date == '') {
                    $('#task_update_p').css('display', 'none');
                    $('#end_task_update_p').css('display', 'none');
                    $('#start_date_update_p').css('display', 'block');
                    $('#contributors').css('display', 'none');
                } else if (contributors == '') {
                    $('#task_update_p').css('display', 'none');
                    $('#end_task_update_p').css('display', 'none');
                    $('#start_date_update_p').css('display', 'none');
                    $('#contributors_update_p').css('display', 'block');
                } else {
                    // $(this).parent().parent().closest('tr');

                    $('.mod').css('display', 'none');
                }

            });
            $('body').on('click', '.delete', function(e) {
                // swal({
                // title: 'Are you sure?',
                // text: 'This record and it`s details will be permanantly deleted!',
                // icon: 'warning',
                // buttons: ["Cancel", "Yes!"],
                // }).then(function(value) {
                // if (value) {
                $(this).parent().parent().remove();
                // }
                // });
            });

            $('body').on('click', '#createitem', function(e) {
                var count = $('#table tr').length;
                var incr = count > 0 ? count : 1;
                var task = $('input[name="task[]"]').val();
                var endtask = $('input[name="end_task[]"] ').val();
                var startdata = $('input[name="start_date[]"] ').val();
                var contributors = $('input[name="contributors[]"] ').val();
                if (task == '' && endtask == '' && startdata == '' && contributors == '') {
                    $('#task').css('display', 'block');
                    $('#end_task').css('display', 'block');
                    $('#start_date').css('display', 'block');
                    $('#contributors').css('display', 'block');
                } else if (task == '') {
                    $('#task').css('display', 'block');
                    $('#end_task').css('display', 'none');
                    $('#start_date').css('display', 'none');
                    $('#contributors').css('display', 'none');
                } else if (endtask == '') {
                    $('#task').css('display', 'none');
                    $('#end_task').css('display', 'block');
                    $('#start_date').css('display', 'none');
                    $('#contributors').css('display', 'none');
                } else if (startdata == '') {
                    $('#task').css('display', 'none');
                    $('#end_task').css('display', 'none');
                    $('#start_date').css('display', 'block');
                    $('#contributors').css('display', 'none');
                } else if (contributors == '') {
                    $('#task').css('display', 'none');
                    $('#end_task').css('display', 'none');
                    $('#start_date').css('display', 'none');
                    $('#contributors').css('display', 'block');
                } else {
                    $('.car').css('display', 'block');
                    $('#table').find('tbody').append($('' +
                        '<tr class="row1" id="' + incr + '">' +
                        "<td>" + incr + "</td>" +
                        '<td>' +
                        '<input type="text"  value="' + task + '" name="task[' + incr + ']" id="property"  readonly>' +
                        '</td>' +
                        '<td>' +
                        '<input type="date"   value ="' + startdata + '"name="start_date[' + incr +
                        ']"  id="property" readonly>' +
                        '</td>' +
                        '<td>' +
                        '<input type="date"  value="' + endtask + '" name="end_task[' + incr +
                        ']"  id="property" readonly>' +
                        '</td>' +
                        '<td>' +
                        '<input type="text"  value="' + contributors + '" name="contributors[' + incr +
                        ']" id="property" readonly>' +
                        '</td>' +
                        '<td><a class=" delete btn-danger btn btn-sm" >Delete</a><a class=" edit ml-1 btn-info btn btn-sm">Edit</a></td>' +
                        '</tr>' +
                        ''));
                    $('#task').css('display', 'none');
                    $('#endtask').css('display', 'none');
                    $('#startdata').css('display', 'none');
                    $('#contributors').css('display', 'none');
                    $('input[name="task[]"]').val('');
                    $('input[name="end_task[]"] ').val('');
                    $('input[name="start_date[]"] ').val('');
                    $('input[name="contributors[]"] ').val('');
                }


            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
            integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous">
        </script>
    @endpush
