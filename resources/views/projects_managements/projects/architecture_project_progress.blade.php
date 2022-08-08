@extends('layouts.app')

@push('head')
    <title>Home</title>

    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this page -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('images/css/dash.css') }}">
    <style>
        #filter-title {
            font-family: 'Lato-Semibold';
            color: #164741;
        }

        .before-row {
            padding: 0 0px;
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

        /* add model */
        .openBtn {
            display: flex;
            justify-content: left;
        }


        .openButton {
            border: none;
            border-radius: 5px;
            background-color: #70cacc;
            color: white;
            padding: 14px 20px;
            cursor: pointer;
            position: fixed;
        }

        .loginPopup {
            position: relative;
            text-align: center;
            width: 100%;
        }

        .formPopup {
            display: none;
            position: fixed;
            left: 45%;
            top: 5%;
            transform: translate(-50%, 5%);
            border: 3px solid #999999;
            z-index: 9;
        }

        .formContainer {
            max-width: 300px;
            padding: 20px;
            background-color: #fff;
        }

        .formContainer input[type=text],
        .formContainer input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 20px 0;
            border: none;
            background: #eee;
        }

        .formContainer input[type=text]:focus,
        .formContainer input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        .formContainer .btn {
            padding: 12px 20px;
            border: none;
            background-color: #8ebf42;
            color: #fff;
            cursor: pointer;
            width: 100%;
            margin-bottom: 15px;
            opacity: 0.8;
        }

        .formContainer .cancel {
            background-color: #cc0000;
        }

        .formContainer .btn:hover,
        .openButton:hover {
            opacity: 1;
        }

        /* end add model */

        /*Hidden class for adding and removing*/
        .lds-dual-ring.hidden {
            display: none;
        }

        /*Add an overlay to the entire page blocking any further presses to buttons or other elements.*/
        .overlay {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, .8);
            z-index: 999;
            opacity: 1;
            transition: all 0.5s;
        }

        /*Spinner Styles*/
        .lds-dual-ring {
            display: inline-block;
            width: 80px;
            height: 80px;
        }

        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 64px;
            height: 64px;
            margin: 5% auto;
            border-radius: 50%;
            border: 6px solid #fff;
            border-color: #fff transparent #fff transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }

        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .disabledbutton {
            pointer-events: none;
            opacity: 0.4;
        }

        .top-title {
            font-family: 'Lato-Semibold';
            font-size: 20px;
            color: #fff;
            height: 4rem;
            padding: 14px 35px;
            /* margin-left: -5px; */
            border-radius: 0 0px 55px 0;
            background-image: linear-gradient(to right, #211706, #291d0a, #30230c, #39290f, #412f10, #503913, #5f4416, #6e4f19, #88621f, #a37526, #be892c, #db9d33);
        }

        nav ul li:last-child {
            border-bottom: 0 !important;
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
            z-index: 1000;
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
        .mod1 {
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
            z-index: 1000;
            display: none;
        }

        #times1 {
            position: absolute;
            left: 90%;
            top: 5%;
            /* margin: 10px; */
            z-index: 10;
            cursor: pointer;

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

        #tablebuttonexcel button,
        #tablebuttoncsv button {
            background: #6d4e18;
            border: #6d4e18;
            font-family: 'Lato-Regular';
            font-size: 15px;
            color: #fff;
            width: 6rem;
            border-radius: 9px;
            box-shadow: 0 8px 7px -7px rgb(115 115 115 / 21%), -6px 0 7px -3px rgb(115 115 115 / 34%);
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
        .dataTables_scroll {
            background: #fff;
        }

        #dataTable_length {
            position: absolute;
            right: 50%;
            margin-top: 2rem;
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
                /* margin-left: -2px; */
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
                top: 2px;
                right: 192px;
            }

            #dataTable_filter label::after {
                width: 61px;
                top: 10px;
                right: 58px;
            }

            .label h4 {
                font-size: 13px;
            }

        }

        @media(max-width:500px) {
            .content-input {
                margin-bottom: 10px;
            }

            .label {
                width: 8rem;
            }

            .group-button {
                position: initial;
                justify-content: center !important;
            }

            #dataTable_length {
                position: inherit;
            }

            #dataTable_filter input {
                width: 11rem !important;
            }

            #dataTable_filter label::after {
                top: 10px !important;
                right: 63px !important;
            }

            #dataTable_filter label::before {
                top: 2px;
                right: 179px;
            }

            #bookslist_info {
                position: inherit;
            }

            #wrapper {
                background-size: cover !important;

            }

            .top-title {
                /* margin-left:20px!important; */
            }

            /*sidebar mobile */
            .sidebar .sidebar-brand {
                height: auto;
            }

            .sidebar-brand-icon {
                display: grid;
            }

            .user-name {
                width: 100%;
            }

            nav ul li {
                line-height: 7px !important;
            }

            #sbitem1 .link-content,
            #sbitem2 .link-content,
            #sbitem3 .link-content,
            #sbitem4 .link-content,
            #sbitem5 .link-content,
            #sbitem6 .link-content {
                height: 4rem;
                padding: 9px 6px;
            }

            .left-title {
                width: 90%;
                font-size: 12px;
                line-height: 1;
            }

            .icon-title {
                font-size: 10px !important;
            }

            #sbitem1_1,
            #sbitem1_2,
            #sbitem1_3,
            #sbitem1_4,
            #sbitem1_5,
            #sbitem1_6,
            #sbitem1_7,
            #sbitem1_8,
            #sbitem1_9 {
                line-height: 17px !important;
                margin-bottom: 10px;
            }

            #sbitem1_1 a,
            #sbitem1_2 a,
            #sbitem1_3 a,
            #sbitem1_4 a,
            #sbitem1_5 a,
            #sbitem1_6 a,
            #sbitem1_7 a,
            #sbitem1_8 a,
            #sbitem1_9 a {
                padding-left: 15px !important;
                font-size: 12px !important;
            }

            #sbitem2_1,
            #sbitem2_2,
            #sbitem2_3,
            #sbitem2_4,
            #sbitem2_5,
            #sbitem2_6,
            #sbitem2_7,
            #sbitem2_8,
            #sbitem2_9,
            #sbitem2_10,
            #sbitem2_11 {
                line-height: 17px !important;
                margin-bottom: 10px !important;
            }

            #sbitem2_1 a,
            #sbitem2_2 a,
            #sbitem2_3 a,
            #sbitem2_4 a,
            #sbitem2_5 a,
            #sbitem2_6 a,
            #sbitem2_7 a,
            #sbitem2_8 a,
            #sbitem2_9 a,
            #sbitem2_10 a,
            #sbitem2_11 a {
                padding-left: 15px !important;
                font-size: 12px !important;
            }
        }


        #bg-top {
            width: 157%;
            margin-left: -5rem;
            margin-top: -9rem;
        }

        #sel1:focus-visible,
        #daymonthvalue:focus-visible,
        #rangedate:focus-visible,
        #datasource:focus-visible {
            outline: none;
        }
        .accordion {
  /* background-color: #eee; */
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.active, .accordion:hover {
  background-color: #ccc;
}

.panel {
  padding: 0 18px;
  display: none;
  background-color: white;
  overflow: hidden;
}

        #sel1,
        #datasource {
            font-family: 'Lato-Regular' !important;
            font-size: 12px !important;
            display: inline-block;
            /*width: 100%;*/
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

        #daymonthvalue,
        #rangedate {
            border-right: 3px solid #e4aa47 !important;
            box-shadow: 0 4px 2px -2px #d9d1d1;
            color: #878b8f;
            border-radius: 0 !important;
            vertical-align: middle;
            height: calc(2.25rem + 2px);
            padding: 0.375rem 1.75rem 0.375rem 0.75rem;
            font-size: 12px;
            font-family: 'Lato-Regular' !important;
        }

        #daymonthfilter,
        #rangefilter {
            margin-left: -5px;
            box-shadow: 0 4px 2px -2px #d9d1d1;
            background: #fff;
            height: calc(2.25rem + 2px);
            padding: 0.475rem 5px 0.775rem 5px;
            position: absolute;
            right: 3px;
            z-index: 1000;
            width: 3rem;
        }

        #border {
            margin-right: -8px;
            margin-left: -5px;
            box-shadow: 0 4px 2px -2px #d9d1d1;
            height: calc(2.25rem + 2px);
            /* padding: 0.475rem 5px 0.775rem 5px; */
            width: 54px;
        }

        #border img {
            width: 138%;
            margin-right: -25px;
            height: 100%;
            transform: scaleX(1);
        }

        #border2 {
            margin-right: -8px;
            margin-left: -5px;
            box-shadow: 0 4px 2px -2px #d9d1d1;
            height: calc(2.25rem + 2px);
            /* padding: 0.475rem 5px 0.775rem 5px; */
            width: 46px;
        }

        #border2 img {
            width: 135%;
            margin-right: -21px;
            height: 100%;
            transform: scaleY(-1);
        }

        #border3 {
            margin-right: -39px;
            margin-left: -12px;
            box-shadow: 0 4px 2px -2px #d9d1d1;
            height: calc(2.25rem + 1px);
            /* padding: 0.475rem 5px 0.775rem 5px; */
            width: 46px;
        }

        #border3 img {
            width: 89%;
            /* margin-right: -21px; */
            height: 103%;
            transform: scaleX(-2);
        }

        #border4 {
            margin-right: -33px;
            margin-left: -20px;
            box-shadow: 0 4px 2px -2px #d9d1d1;
            height: calc(2.25rem + 2px);
            /* padding: 0.475rem 5px 0.775rem 5px; */
            width: 46px;
        }

        #border4 img {
            width: 89%;
            /* margin-right: -21px; */
            height: 100%;
            transform: scaleX(1.3);
        }

        #datetimepicker2 label {
            width: 21%;
            text-align: left;
            color: #143e39;
            font-family: 'Lato-Bold';
            font-size: 13px;
        }

        .card-header {
            padding: 0 10rem;
        }

        .pad-row {
            padding: 0 4.8rem;
        }

        .row3 {
            margin-top: -4rem;
        }

        #img-div {
            margin-top: -15px;
            margin-bottom: 7px;
            margin-left: -7px;
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
            box-shadow: -1px -3px 3px -2px #d9d1d1;
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
            transform: translateX(-50%);
            box-shadow: -1px 3px 2px -2px #d9d1d1;
            /* border-top: 1px solid #d9d1d1;*/
        }

        #dataTable_length,
        #dataTable_filter,
        .dataTables_scroll {
            background: #fff;
        }

        .card-body {
            margin-top: -5.3rem !important;
            padding-bottom: 4rem;
        }

        #wrapper {
            height: 100% !important;
        }



        div.dataTables_scrollBody::-webkit-scrollbar {
            width: 5px;
        }

        div.dataTables_scrollBody::-webkit-scrollbar {
            width: 3px !important;

        }

        /* Track */
        div.dataTables_scrollBody::-webkit-scrollbar-track {
            background: #c5c5c5 !important;
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

        /*end*/

        i.fa-whatsapp {
            font-size: 19px;
            color: #5fb750;
        }

        #mobile {
            display: block;
        }

        /*responsive*/
        @media(max-width: 1300px) and (min-width: 1201px) {
            .card-header {
                padding: 0 8rem;
            }
        }

        @media(max-width: 1295px) and (min-width: 1210px) {
            .pad-row {
                padding: 0 4.6rem 0 5.3rem;
            }

            /* label#desktop {
                                                    font-size: 12px;
                                                } */
            #datetimepicker2 label {
                width: 23%;
            }
        }

        @media(max-width: 1200px) and (min-width: 1025px) {
            .card-header {
                padding: 0 5rem;
            }
        }

        @media(max-width: 1024px) and (min-width: 800px) {
            .pad-row {
                padding: 0 4.8rem 0 5rem;
            }

            #datetimepicker2 label {
                width: 26%;
            }

            .row3 {
                margin-top: -4rem;
            }

            /*#resid:after,#resid2:before{
                                                    width: 7rem;
                                                    transform: translateX(-58%);
                                                }*/
            #img-div {
                margin-top: -14px;
                margin-bottom: 7px;
                margin-left: -7px;
            }

            .card-header {
                padding: 0
            }

            #wrapper {
                height: auto !important;
            }

            #dataTable_filter label {
                margin-top: 0.3rem;
                width: 50%;
            }
        }

        @media(max-width:1450px) and (min-width:1300px) {
            .first-label {
                width: 23%;
                margin-left: -9px;
                margin-bottom: 0 !important;
            }
        }

        div#left-input {
            align-items: center;
        }

        @media(max-width: 768px) and (min-width: 499px) {

            .card-header,
            #container-f {
                padding: 0 !important;
            }

            .row3 {
                margin-top: -3rem;
            }

            .pad-row {
                padding: 0 3.5rem !important;
            }

            #dataTable_length {
                right: 42%;
            }

            #resid:after,
            #resid2:before {
                width: 6rem;
            }

            #pad-row1 {
                margin-bottom: 0.7rem !important;
            }

            #pad-row2 {
                margin-top: -1rem
            }

            #datetimepicker2 {
                margin-bottom: 0.7rem !important;
                margin-top: 0.3rem;
            }

            #desktop {
                width: 20%;
            }

            #img-div {
                margin-top: -7px;
                margin-bottom: 5px;
                margin-left: -7px;
            }

            #wrapper {
                height: auto !important;
            }

            #dataTable_filter label {

                margin-top: 0.3rem !important;
                width: 55%;
            }
        }



        @media(max-width: 500px) {
            #rangedate {
                margin-bottom: 1rem !important;
            }

            .pagination li .page-link {
                font-size: 10px !important;
                padding: 0.5rem 0.15rem !important;
            }

            .page-item.disabled .page-link {
                text-align: center !important;
            }

            .justify-content-end {
                justify-content: center !important;
            }

            .card-header,
            .pad-row {
                padding: 0 !important;
            }

            #resid:after,
            #border img,
            #border2,
            #resid2:before,
            #border4 img,
            #border3,
            .none,
            #border4,
            #border {
                display: none;
            }

            #img-div {
                display: none;
            }

            #img-div img {
                width: 100% !important;
            }

            .row3,
            .card-body {
                margin-top: 0 !important;
            }

            #daymonthfilter,
            #rangefilter {
                right: 4px;
                top: 0;
            }

            .before-row {
                padding: 0 0;
            }

            .justify-content-start {
                justify-content: center !important;
            }

            nav ul .leads-show.show li a {
                padding-left: 11px !important;
                line-height: 1.3 !important;
                font-family: 'Lato-Regular' !important;
                font-size: 12px !important;
            }

            #daymonthvalue,
            #rangedate {
                border-right: 3px solid #e4aa47 !important;
            }

            #wrapper {
                height: auto !important;
            }

            /* #desktop{ */
            display: block;
        }

        #mobile {
            display: block;
            padding-left: 10px;
            text-align: left;
            color: #143e39;
            font-family: 'Lato-Bold';
            font-size: 13px;
        }

        #container-f {
            padding-right: 0 !important;
        }

        #dataTable_length {
            background: transparent;
            margin-top: 29px;
        }

        #left-input {
            margin-bottom: 0 !important;
        }

        }

        .accordion {
            width: 800px;
            margin: 90px auto;
            color: black;
            background-color: white;
            padding: 45px 45px;
        }

        .accordion .container {
            position: relative;
            margin: 10px 10px;
        }

        /* Positions the labels relative to the .container. Adds padding to the top and bottom and increases font size. Also makes its cursor a pointer */

        .accordion .label {
            position: relative;
            padding: 10px 0;
            font-size: 1.07142857rem;
            color: black;
            cursor: pointer;
        }

        /* Positions the plus sign 5px from the right. Centers it using the transform property. */

        .accordion .label::before {
            content: '+';
            color: black;
            position: absolute;
            top: 50%;
            right: -5px;
            font-size: 15px;
            transform: translateY(-50%);
        }

        /* Hides the content (height: 0), decreases font size, justifies text and adds transition */

        .accordion .content {
            position: relative;
            height: 0;
            font-size: 20px;
            text-align: justify;
            width: 780px;
            overflow: hidden;
            z-index: 100;
            transition: 0.5s;
        }

        .div1 {
            overflow-y: scroll;
            overflow-x: scroll;
            height: 250px;
        }

        /* Adds a horizontal line between the contents */

        .accordion hr {
            width: 100;
            margin-left: 0;
            border: 1px solid grey;
        }

        /* Unhides the content part when active. Sets the height */

        .accordion .container.active .content {
            height: 850px;
        }

        /* Changes from plus sign to negative sign once active */

        .accordion .container.active .label::before {
            content: '-';
            font-size: 20px;
        }


        .formdata {
            box-shadow: 0px 0px 4px 1px #6c4d18;
            margin: 5px;
            border: 1px solid #e4aa47;
            border-radius: 5px;
        }

        .customeinput {
            border: #000
        }

        .buttonsubmit {
            width: 9rem;
            background: #977c4d;
            padding: 5px 32px;
            border-radius: 0;
            font-family: 'Lato-Semibold';
            cursor: pointer;
        }

        .buttonsubmit1 {
            width: 9rem;
            background: #f1b245;
            padding: 5px 32px;
            border-radius: 0;
            font-family: 'Lato-Semibold';
            margin-bottom: 20px;
            cursor: pointer;
        }

        #architecture_tax_invoice_download_btn,#architecture_tax_invoice_list_download_btn1,
        #design_service_download_btn,
        #scope_of_work_download_btn {
            width: 9rem;
            background: #086317;
            padding: 5px 32px;
            border-radius: 0;
            font-family: 'Lato-Semibold';
            margin-bottom: 20px;
            cursor: pointer;
        }

        #design_service_paid_btn {
            width: 9rem;
            background: #f89e03;
            padding: 5px 32px;
            border-radius: 0;
            font-family: 'Lato-Semibold';
            margin-bottom: 20px;
            cursor: pointer;
        }

        input[type=checkbox],
        input[type=date],
        input[type=number],
        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 5px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
            border-right: 3px solid #e4aa47 !important;
        }

        input[type=text]:focus,
        input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        .disable-div {
            pointer-events: none;
        }


        /* progress bar */
        progress {
            text-align: center;
            border-radius: 7px;
            width: 80%;
            height: 22px;
            margin-top: 5%;
            box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2);
            margin-left: 10%
        }

        progress::-webkit-progress-bar {
            background-color: #f1b245;
            border-radius: 7px;
        }

        progress::-webkit-progress-value {
            background-color: #f89e03;
            border-radius: 7px;
            box-shadow: 1px 1px 5px 3px rgba(255, 0, 0, 0.8);
        }

        progress::-moz-progress-bar {
            /* style rules */
        }

        progress:after {
            content: attr(value)'%';
        }

        /* progress bar */
        #progress {
            position: relative;
            margin-bottom: 30px;
        }

        #progress-bar {
            position: absolute;
            background: rgb(245, 181, 4);
            height: 5px;
            width: 0%;
            top: 50%;
            left: 0;
        }

        #progress-num {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            justify-content: space-between;
        }

        #progress-num::before {
            content: "";
            background-color: lightgray;
            position: absolute;
            top: 50%;
            left: 0;
            height: 5px;
            width: 100%;
            z-index: -1;
        }

        #progress-num .step {
            border: 20px solid rgb(248, 209, 101);
            border-radius: 200%;
            width: 100;
            height: 5px;
            line-height: 5px;
            text-align: center;
            color: #fff;
            background-color: #fff;
            font-family: sans-serif;
            font-size: 14px;
            position: relative;
            z-index: 1;
        }

        #progress-num .step.active {
            border-color: rgb(245, 181, 4);;
            background-color: rgb(245, 181, 4);;
            color: #fff;
            margin-top: 7%;
        }


    </style>

    <!-- Page level plugins -->

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.css"
        crossorigin="anonymous" />

    <!--datatable-->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/date-1.1.0/fh-3.1.9/sb-1.1.0/sp-1.3.0/sl-1.3.3/datatables.min.css" />


    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker-standalone.css">
@endpush

@section('wrapper_content')
    <div class="container-fluid" style="padding-left:0!important">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-7">
                <h3 class="top-title">Project Progress</h3>
            </div>
        </div>
    </div>
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- update_contac_section -->
            <div class="mod">
                <h5>Update Contact</h5>
                <hr>
                <i class=" fa fa-times" id="times"></i>
                <div class="container">
                    <div id="alertdata"></div>
                    <div class="row mt-4 mb-4" style="align-items: center;">

                        <div class="col-md-2">
                            <label class="title-input" for="property">Name</label>
                        </div>
                        <div id="task_update" class="col-md-10 ">
                            <input class="form-control ml-1" type="text"
                                 name="name_contact" >
                                 <input class="form-control ml-1" type="text"
                                 name="id_contact_update" hidden>

                            <p id="Name_update_p" class="mt-1" style="color:rosybrown;display:none">Name is required</p>

                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-2">
                            <label class="title-input" for="property">Position</label>
                        </div>
                        <div id="contributors_update" class="col-md-10">

                            <input class="form-control ml-1" type="text" id="property"
                                 name="Position_update" >
                            <p id="Position_update_p" class="mt-1" style="color:rosybrown;display:none">Position is
                                required</p>
                        </div>
                        <div id="id_update" class="col-md-10" style="color:rosybrown;display:none">

                            <input class="form-control ml-1" type="text" id="row_id"
                                 name="row_id" value="" hidden>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12 text-center">
                            <button id="" class="update_contact buttonsubmit1">update</button>
                        </div>
                    </div>
                </div>



            </div>
            <div class="mod1">
                <h5>Update List Row</h5>
                <hr>
                <i class=" fa fa-times" id="times1"></i>
                <form class="formdata_m_a_f_update  mr-4">
                    <div class="alert" hidden id="Update_List_Row_alert"></div>
                    <div class="row ml-5">
                         <div class="col-md-2">
                             <input class="form-control customeinput" type="text" name="S.NO_upate" placeholder="S.NO.">
                         </div>
                         <div class="col-md-2">
                             <input class="form-control" type="text" name="item_category_update" placeholder="Item Category">
                         </div>
                         <div class="col-md-2">
                            <input class="form-control" type="text" name="list_size_update" placeholder="Size">
                         </div>
                          <div class="col-md-6">
                              <input class="form-control" type="text" name="list_material_description_update" placeholder="Material Description">
                          </div>
                    </div>
                    <div class="row m-5">
                        <div class="col-md-4">
                            <input class="form-control" type="file" name="list_file_update">
                        </div>
                         <div class="col-md-2">
                             <input class="form-control" type="text" name="list_unit_update" placeholder="Unit">
                             <input class="form-control" type="text" name="list_id_update" placeholder="Unit" hidden>

                         </div>
                         <div class="col-md-2">
                            <input class="form-control" type="number" name="list_qty_update" placeholder="QTY">
                         </div>
                         <div class="col-md-2">
                             <input class="form-control" type="text" name="lsit_currency_update" placeholder="Currency">
                         </div>
                         <div class="col-md-2">
                             <input class="form-control" type="text" name="list_unit_price_update" placeholder="Unit Price">
                         </div>
                    </div>
                    <div class="row m-5">
                        <div class="col-md-2">
                            <input class="form-control" type="text" name="list_brands_update" placeholder="Brands">
                        </div>
                        <div class="col-md-4">
                            <input class="form-control" type="text" name="list_website_links_update" placeholder="Website Links">
                        </div>
                    </div>
                    <div class="row m-5 d-flex justify-content-center">
                        <div class="col-md-2">
                            <input  type="button" value="update" class="material_and_furniture_alert_list_update_row buttonsubmit1 btn-sm">
                        </div>
                    </div>
                </form>
            </div>
            {{-- ////////////////////////////////////////////// Project Stage Progress ////////////////////////////////////////// --}}
            <section class="mt-5">
               <div class="col-md-12">

                    <div id="progress">
                        <div id="progress-bar"></div>
                        <ul id="progress-num">
                        <li @if($project->stage)  class="step active" @else class="step active" @endif >New</li>
                        <li @if($project->stage == 'Design Service' || $project->stage == 'Material Proposal' || $project->stage == 'Tax Invoice'||$project->stage == 'Inventory List' || $project->stage == 'Scope Of Works' )  class="step active" @else class="step" @endif>Design Service</li>
                        <li @if($project->stage == 'Material Proposal' || $project->stage == 'Tax Invoice'||$project->stage == 'Inventory List' || $project->stage == 'Scope Of Works' )  class="step active" @else class="step" @endif>Material Proposal</li>
                        <li @if( $project->stage == 'Tax Invoice'||$project->stage == 'Inventory List' || $project->stage == 'Scope Of Works' )  class="step active" @else class="step" @endif>Tax Invoice</li>
                        <li @if($project->stage == 'Inventory List' || $project->stage == 'Scope Of Works' )  class="step active" @else class="step" @endif>Inventory List</li>
                        <li @if( $project->stage == 'Scope Of Works' )  class="step active" @else class="step" @endif>Scope Of Works</li>
                        </ul>
                    </div>
               </div>
            </section>

            {{-- ////////////////////////////////////////////// Project Details ////////////////////////////////////////// --}}
            <section class="mt-5 ml-5 mr-5">
                <div class="col-md-12">
                    <h1>Project Details</h1>
                    <div class="ml-5 mt-4">
                        <div class="row mt-3">
                            <div style="font-weight: bolder;">Name: &nbsp; </div>
                            <div>{{ $project->name }}</div>
                        </div>
                        <div class="row mt-3">
                            <div style="font-weight: bolder;">Code: &nbsp; </div>
                            <div>{{ $project->code }}</div>
                        </div>
                        <div class="row mt-3">
                            <div style="font-weight: bolder;">Date: &nbsp; </div>
                            <div>{{ $project->date }}</div>
                        </div>
                        <div class="row mt-3">
                            <div style="font-weight: bolder;">Client: &nbsp; </div>
                            <div>{{ $project->client }}</div>
                        </div>
                        <div class="row mt-3">
                            <div style="font-weight: bolder;">Description: &nbsp; </div>
                            <div>{{ $project->description }}</div>
                        </div>
                        <div class="row mt-3">
                            <div style="font-weight: bolder;">Stage: &nbsp; </div>
                            <div>{{$project->stage}}</div>
                        </div>
                        <div class="row mt-3">
                            <div style="font-weight: bolder;">Project Type: &nbsp; </div>
                            <div>{{$project_type->name}}</div>
                        </div>
                        <div class="row mt-3">
                            <div style="font-weight: bolder;">Contributors: &nbsp; </div>
                            @foreach ($project_users as $user)
                            <div>{{ $user->name }}</div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </section>

            {{-- ////////////////////////////////////////////// Design Services ////////////////////////////////////////// --}}
            <section class="mt-5 ml-5 mr-5">
                <div class="col-md-12">
                    <h1>Design Services</h1>
                    <form class="formdata6">
                        <div id="design_services_alert_div" class="alert alert-danger" hidden></div>
                        <div id="alert_div" class="alert" hidden></div>
                        <input value="{{$project->id}}" type="text" name="project_id" hidden>

                        <div @if($project_service || ($project_service && $project_service->is_paid == "1"))  class="disable-div" @else class="" @endif id="design_services_section">
                            <div class="row mt-4 ml-4">
                                <div class="col-md-6">
                                    <label for="">Subtotal </label>
                                    <input id="design_service_subtotal_div"@if($project_service) value="{{$project_service->Subtotal}}" @endif  type="number" name="subtotal"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row mt-3 ml-4 mr-4">
                                <div id="design_service_stage_div" class="col-md-12">
                                    <label for="">Stage A</label>
                                    <textarea rows="15" cols="105" placeholder="" type="text" id="design_service_stage_texteditor"
                                        name="stage_a">{{$Design_Service_stage_a->value}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12" style="text-align: center">
                            @if($project_service && $project_service->is_paid == "0")
                                <input id="design_service_edit_btn" type="button" value="Edit" class="buttonsubmit" style="cursor: pointer">
                                <input id="design_service_save_btn" type="button" value="Save" class="buttonsubmit1"style="cursor: default" disabled>
                            @elseif ($project_service && $project_service->is_paid == "1")
                            <input id="design_service_edit_btn" type="button" value="Edit" class="buttonsubmit" style="cursor: default" disabled>
                            <input id="design_service_save_btn" type="button" value="Save" class="buttonsubmit1"style="cursor: default" disabled>
                            @else
                            <input id="design_service_edit_btn" type="button" value="Edit" class="buttonsubmit" style="cursor: default" disabled>
                            <input id="design_service_save_btn" type="button" value="Save" class="buttonsubmit1">
                            @endif
                            </div>
                        </div>
                    </form>
                    <div id="alert_div_paid_design_service" class="alert" hidden></div>
                    <div class="row mt-3 mr-2 d-flex justify-content-end">
                        @if ($project_service && $project_service->is_paid == "1")
                        <input class="disable-div" id="design_service_paid_btn"type="button" value="Paid" style="cursor: default" disabled>
                        <input id="design_service_download_btn" type="button" value="Download">
                        @else
                        <input id="design_service_paid_btn"type="button" value="Paid">
                        <input id="design_service_download_btn" type="button" value="Download">
                        @endif

                    </div>
                </div>
            </section>

            {{-- ////////////////////////////////////////////// Materials And Furniture Proposal ////////////////////////////////////////// --}}

            <section @if($project_service && $project_service->is_paid == "1") l @else  hidden @endif  id="materials_and_furniture_proposal_section"  class="mt-5 ml-5 mr-5">
                <div class="col-md-12">
                    <h1>Materials And Furniture Proposal</h1>
                    {{-- ////////////////////////////////////////////// Create Material And Furniture Proposal ////////////////////////////////////////// --}}
                    <section class="mt-5">
                        <h3>Create Material And Furniture</h3>
                        <form class="formdata7" >
                            <div id="material_and_furniture_alert_div" class="alert alert-danger" hidden></div>
                            <div id="material_and_furniture_alert_div_create" class="alert" hidden></div>
                            <div class="row mt-4 ml-4">
                                <div class="col-md-6">
                                    <label for="">Date</label>
                                    <input @if($material_and_furniture != null) disabled @else "" @endif id="create_material_and_furniture_date_div" @if($material_and_furniture) value="{{$material_and_furniture->date}}" @endif type="date" name="date"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row mt-3 ml-4 mr-4">
                                <div class="col-md-12">
                                    <div @if($material_and_furniture != null) class="disable-div" @else class=""  @endif id="create_material_and_furniture_div" class="col-md-12">
                                        <label for="">Note</label>
                                        <textarea  rows="15" cols="105" placeholder="" type="text" id="create_material_and_furniture_texteditor"
                                            name="body">@if($material_and_furniture) {{$material_and_furniture->note}} @endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12" style="text-align: center">
                                    @if($material_and_furniture)
                                    <input id="create_material_and_furniture_edit_btn" type="button" value="Edit"
                                        class="buttonsubmit" >
                                        <input id="create_material_and_furniture_create_btn" type="button" value="Create"
                                        class="buttonsubmit1" style="cursor: default" disabled>
                                    @else
                                    <input id="create_material_and_furniture_edit_btn" type="button" value="Edit"
                                        class="buttonsubmit" style="cursor: default" disabled>
                                    <input id="create_material_and_furniture_create_btn" type="button" value="Create"
                                        class="buttonsubmit1">
                                    @endif
                                </div>
                            </div>
                        </form>
                    </section>

                    {{-- ////////////////////////////////////////////// Contact Section ////////////////////////////////////////// --}}
                    <section @if($material_and_furniture != null) l @else  hidden @endif id="contact_section_section" class="mt-5" >
                        <h3>Contact Section</h3>

                        <form class="formdata8">
                            <div id="contact_section_alert_div" class="alert alert-danger" hidden></div>
                            <div id="contact_section_create" class="alert " hidden></div>
                            <div class="row mt-4 ml-4">
                                <div class="col-md-6">
                                    <input type="text" @if($material_and_furniture != null) value="{{$material_and_furniture->id}}"  @else  value="" @endif name="material_and_furniture_id"
                                        class="form-control" hidden>
                                    <label for="">Name</label>
                                    <input id="contact_section_name_div" type="text" name="name"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row mt-3 ml-4 mr-4">
                                <div class="col-md-12">
                                    <label for="">Position</label>
                                    <input id="contact_section_position_div" type="text" name="position"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12" style="text-align: center">
                                    <input id="contact_section_create_btn" type="button" value="Create"
                                        class="buttonsubmit1">
                                </div>
                            </div>
                        </form>
                        <div id="contact_section_delete" class="alert " hidden></div>
                        <h4 class="mt-4">Contacts List</h4>
                        <table id="contact_section_table" class="table table-striped table-bordered table-sm"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="th-sm">Name</th>
                                    <th class="th-sm">Position</th>
                                    <th class="th-sm">ACtions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                <tr class="row{{$contact->id}}">
                                    <td class="th-sm">{{$contact->name}}</th>
                                    <td class="th-sm">{{$contact->position}}</th>
                                    <td class="th-sm">
                                        <button id="" class="Delete_contact btn btn-danger" data-id="{{ $contact->id }}" >Delete</button>
                                        <button  data-id="{{ $contact->id }}"  class="Edit_contact btn btn-info ml-3">Edit</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </section>



                    {{-- ////////////////////////////////////////////// Create Material And Furniture List ////////////////////////////////////////// --}}

                    <section @if($material_and_furniture != null) l @else  hidden @endif id="material_and_furniture_list_section" class="mt-5" >
                        <h3>Create Material And Furniture List</h3>
                        <div id="material_and_furniture_alert_list_create" class="alert" hidden></div>
                        <form action="" class="formdata10">
                            <div id="material_and_furniture_list_alert_div" class="alert alert-danger" hidden></div>
                            <div class="row mt-4 ml-4 mr-4">
                                <div class="col-md-6">
                                    <label for="">List Title</label>
                                    <input id="material_and_furniture__id_for_list" type="text" name="material_and_furniture_id_for_list"
                                        class="form-control" hidden @if($material_and_furniture) value="{{$material_and_furniture->id}}"@endif>
                                    <input id="material_and_furniture_list_title" type="text" name="list_title"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row mt-3 ml-4 mr-4">
                                <div class="col-md-12">
                                    <label for="">Note</label>
                                    <input id="material_and_furniture_list_title_note" type="text" name="list_note"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12" style="text-align: center">
                                    <input id="create_material_and_furniture_list_button_id" type="button"
                                        value="Create" class="buttonsubmit1">
                                </div>
                            </div>
                        </form>

                        <div class="mt-5" id="furnituer_list_items">

                        @foreach ($material_and_furniture_lists as $material_and_furniture_list)
                        <button class="accordion mt-5" >{{$material_and_furniture_list->title}} &nbsp;&nbsp;({{$material_and_furniture_list->note}})</button>
                        <div class="panel">
                            <div>
                            <form class="formdata_m_a_f_l_r{{$material_and_furniture_list->id}} mr-4">
                                <div class="alert" hidden id="{{$material_and_furniture_list->id}}"></div>
                                <div class="row ml-5">
                                    <h3 class="mt-4">Add List Row</h3></div><div class="row m-5">
                                     <div class="col-md-2">
                                         <input class="form-control customeinput" type="text" name="S.NO"placeholder="S.NO.">
                                     </div>
                                     <div class="col-md-2">
                                         <input class="form-control" type="text" name="item_category" placeholder="Item Category">
                                     </div>
                                     <div class="col-md-2">
                                        <input class="form-control" type="text" name="list_size" placeholder="Size">
                                     </div>
                                      <div class="col-md-6">
                                          <input class="form-control" type="text" name="list_material_description" placeholder="Material Description">
                                      </div>
                                </div>
                                <div class="row m-5">
                                    <div class="col-md-4">
                                        <input class="form-control" type="file" name="list_file">
                                    </div>
                                     <div class="col-md-2">
                                         <input class="form-control" type="text" name="list_unit" placeholder="Unit">
                                     </div>
                                     <div class="col-md-2">
                                        <input class="form-control" type="number" name="list_qty" placeholder="QTY">
                                     </div>
                                     <div class="col-md-2">
                                         <input class="form-control" type="text" name="lsit_currency" placeholder="Currency">
                                     </div>
                                     <div class="col-md-2">
                                         <input class="form-control" type="text" name="list_unit_price" placeholder="Unit Price">
                                     </div>
                                </div>
                                <div class="row m-5">
                                    <div class="col-md-2">
                                        <input class="form-control" type="text" name="list_brands" placeholder="Brands">
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" type="text" name="list_website_links" placeholder="Website Links">
                                    </div>
                                </div>
                                <div class="row m-5 d-flex justify-content-center">
                                    <div class="col-md-2">
                                        <input data-id="{{$material_and_furniture_list->id}}" type="button" value="create" class="material_and_furniture_alert_list_create_row buttonsubmit1 btn-sm">
                                    </div>
                                </div>
                            </form>
                            </div>
                            <div>
                                <h4 class="mt-5">List Items</h4>
                                <div class="alert delete_update_alert" hidden id=""></div>
                                <table id="" class="table table_mater_list_row{{$material_and_furniture_list->id}}  mt-2" style="max-height: 300px;overflow: auto;display:inline-block;">
                                    <thead style="font-size:15px">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">S.NO.</th>
                                            <th scope="col">Item Category</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Material Description</th>
                                            <th scope="col">image</th>
                                            <th scope="col">Unit</th>
                                            <th scope="col">QTY</th>
                                            <th scope="col">Currency</th>
                                            <th scope="col">Unit Price</th>
                                            <th scope="col">Brands</th>
                                            <th scope="col">Website Links</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size:15px">
                                        @foreach ($material_and_furniture_list->MaterialAndFurnitureListrow as  $key)
                                            <tr class="table_row_for{{$key->id}}">
                                                <td></td>
                                                <td>{{$key->s_no}}</td>
                                                <td>{{$key->item_category}}</td>
                                                <td>{{$key->size}}</td>
                                                <td>{{$key->material_description}}</td>
                                                <td>
                                                    <img src="{{asset($key->photo)}}" width=200 height=150 />
                                                </td>
                                                <td>{{$key->unit}}</td>
                                                <td>{{$key->qty}}</td>
                                                <td>{{$key->currency}}</td>
                                                <td>{{$key->unit_price}}</td>
                                                <td>{{$key->brands}}</td>
                                                <td>{{$key->website_links}}</td>
                                                <td>
                                                    <button  class="Delete_m_a_f_l_r btn btn-danger" data-id="{{ $key->id }}" >Delete</button>
                                                    <button  data-id="{{ $key->id }}"  class="Edit__m_a_f_l_r btn btn-info ml-3">Edit</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                         @endforeach
                        </div>
                    </section>


                    {{-- ////////////////////////////////////////////// Create Costs ////////////////////////////////////////// --}}
                    <section @if($material_and_furniture != null) l @else  hidden @endif id="create_costs_section" class="mt-5" >
                        <h3>Create Costs</h3>
                        <form class="formdata_costs">
                            <div id="create_costs_alert_div" class="alert alert-danger" hidden></div>
                            <div id="create_costs_alert" class="" hidden></div>
                            <div class="row mt-4 ml-4">
                                <div class="col-md-6">
                                    <label for="">Installation Fees</label>
                                    <input @if($cost != null) value="{{$cost->installation_fees}}" disabled @endif id="create_costs_installation_fees_div" type="number"
                                        name="installation_fees" class="form-control">
                                        <input type="text" @if($material_and_furniture != null) value="{{$material_and_furniture->id}}"  @else  value="" @endif name="material_and_furniture_id_for_costs"
                                        class="form-control" hidden>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12" style="text-align: center">
                                    <input @if($cost != null) style="cursor:pointer" @else style="cursor: default" disabled @endif id="create_costs_edit_btn" type="button" value="Edit"
                                        class="buttonsubmit">
                                    <input @if($cost != null) style="cursor:default"disabled @endif id="create_costs_save_btn" type="button" value="Save"
                                        class="buttonsubmit1">
                                </div>
                            </div>
                        </form>

                        <div class="ml-5 mt-4">
                            <div class="row mt-3">
                                <div style="font-weight: bolder;">Furniture Total: &nbsp; </div>
                                <div id="furniture_total" >@if($cost != null) {{$cost->furniture_total}} @endif</div>
                            </div>
                            <div class="row mt-3">
                                <div style="font-weight: bolder;">Design Fee: &nbsp; </div>
                                <div id="design_fee" >@if($cost != null) {{$cost->design_fee}} @endif</div>
                            </div>
                            <div class="row mt-3">
                                <div style="font-weight: bolder;">Total Amount: &nbsp; </div>
                                <div id="total_amount">@if($cost != null) {{$cost->total_amount}} @endif</div>
                            </div>
                            <div class="row mt-3">
                                <div style="font-weight: bolder;">VAT Fee: &nbsp; </div>
                                <div id="vat_fee" >@if($cost != null) {{$cost->vat_fee}} @endif</div>
                            </div>
                            <div class="row mt-3">
                                <div style="font-weight: bolder;">Installation Fees: &nbsp; </div>
                                <div id="installation_fees" >@if($cost != null) {{$cost->installation_fees}} @endif</div>
                            </div>
                            <div class="row mt-3">
                                <div style="font-weight: bolder;">Grand Total: &nbsp; </div>
                                <div id="grand_total">@if($cost != null) {{$cost->grand_total}} @endif</div>
                            </div>
                        </div>
                    </section>

                </div>
            </section>



            {{-- ////////////////////////////////////////////// Architecture Tax Invoice ////////////////////////////////////////// --}}
            <section id="architecture_tax_invoice_section_section" @if($project_service && $project_service->is_paid == "1") l @else  hidden @endif class="mt-5 ml-5 mr-5" >
                <div class="col-md-12">
                    <h1>Architecture Tax Invoice</h1>
                    <form class="formdata">
                        <div id="architecture_tax_invoice_alert_div" class="alert alert-danger" hidden></div>
                        <div id="architecture_tax_invoice_alert" class="alert" hidden></div>
                        <div id="architecture_tax_invoice_section" @if($tax_invoice != null) class="disable-div"  @endif>
                            <div class="row mt-4 ml-4 mr-4">
                                <div class="col-md-6">
                                    <label for="">Code </label>
                                    <input id="architecture_tax_invoice_code_div" @if($tax_invoice != null) value="{{$tax_invoice->code}}"  @endif type="text" name="code"
                                        class="form-control">
                                        <input type="text" @if($material_and_furniture != null) value="{{$material_and_furniture->id}}"  @else  value="" @endif name="material_and_furniture_id_for_text_invoice"
                                        class="form-control" hidden>
                                        <input type="text" @if($tax_invoice != null) value="{{$tax_invoice->id}}" @endif name="text_invoice_id"
                                        class="form-control" hidden>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Date </label>
                                    <input @if($tax_invoice != null) value="{{$tax_invoice->date}}" @endif  id="architecture_tax_invoice_date_div" type="date" name="date"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row mt-3 ml-4 mr-4">
                                <div id="architecture_tax_invoice_div" class="col-md-12">
                                    <label for="">Terms & Conditions</label>
                                    <textarea rows="15" cols="105" placeholder="" type="text" id="architecture_tax_invoice_texteditor"
                                        name="architecture_tax_invoice_terms_conditions">@if($tax_invoice != null) {{$tax_invoice->terms_and_conditions}} @endif</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12" style="text-align: center">
                                <input id="architecture_tax_invoice_edit_btn" @if($tax_invoice != null)  @else style="cursor: default" disabled  @endif type="button" value="Edit"
                                    class="buttonsubmit">
                                <input id="architecture_tax_invoice_save_btn" type="button" value="Save" @if($tax_invoice != null) style="cursor: default" disabled @endif
                                    class="buttonsubmit1">
                                <input id="architecture_tax_invoice_download_btn" type="button" value="Download" @if($tax_invoice == null) style="cursor: default" disabled @endif>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            {{-- ////////////////////////////////////////////// Inventory List ////////////////////////////////////////// --}}
            <section id="inventory_list_section_section" class="mt-5 ml-5 mr-5"@if($project_service && $project_service->is_paid == "1") l @else  hidden @endif  >
                <h1>Inventory List</h1>
                <div class="col-md-12">
                    <progress value="100" max="100" title="dd">50%</progress>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12" style="text-align: center">
                        <input id="architecture_tax_invoice_show_btn" type="button" value="Show"
                            class="buttonsubmit">
                        <input id="architecture_tax_invoice_list_download_btn1" type="button" value="Download">
                    </div>
                </div>

                {{-- ////////////////////////////////////////////// Inventory List ////////////////////////////////////////// --}}
                <section id="inventory_list_section" class="mt2" hidden>
                    <h3>Show Inventory List</h3>
                    <div class="col-md-12">
                        <table id="inventory_list_table" class="table table-striped table-bordered table-sm"
                            cellspacing="0"
                            style="max-height: 280px; max-width:100%;overflow: auto;display:inline-block;">
                            <thead>
                                <tr>
                                    <th class="col-md-1">S.NO.</th>
                                    <th class="col-md-2">Item Category</th>
                                    <th class="col-md-1">Size</th>
                                    <th class="col-md-3">Material Description</th>
                                    <th class="col-md-4">image</th>
                                    <th class="col-md-1">Unit</th>
                                    <th class="col-md-1">QTY</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($material_and_furniture_lists as $material_and_furniture_list)
                                <tr>
                                    <td>1.{{$material_and_furniture_list->id}}</td>
                                    <td style="text-align: left; font-weight: bolder; padding-left: 10px" colspan="6">
                                        {{$material_and_furniture_list->title}}</td>
                                </tr>
                                @foreach ($material_and_furniture_list->MaterialAndFurnitureListrow as  $key)
                                @if($key->delivery_status)
                                <tr>
                                    <td>{{$key->s_no}}</td>
                                     <td>{{$key->item_category}}</td>
                                     <td>{{$key->size}}</td>
                                     <td>{{$key->material_description}}</td>
                                     <td>
                                         <img src="{{asset($key->photo)}}" width=200 height=150 />
                                     </td>
                                     <td>{{$key->unit}}</td>
                                     <td>{{$key->qty}}</td>
                                </tr>
                                @endif
                               @endforeach
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </section>

            {{-- ////////////////////////////////////////////// Scope Of Work ////////////////////////////////////////// --}}
            <section id="scope_of_work_section_Section" class="mt-5 ml-5 mr-5" @if($project_service && $project_service->is_paid == "1") l @else  hidden @endif >
                <div class="col-md-12">
                    <h1>Scope Of Work</h1>
                    <form class="formdata">
                        <div id="scope_of_work_alert_div" class="alert alert-danger" hidden></div>
                        <div id="scope_of_work_section">
                            <div class="row mt-4 ml-4">
                                <div class="col-md-6">
                                    <label for="">Starting Date </label>
                                    <input id="scope_of_work_starting_date_div" type="date" name="starting_date"
                                        class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Note</label>
                                    <input id="scope_of_work_note_div" type="text" name="note"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4 d-flex justify-content-center">
                                <label><input type="checkbox" name="checkbox" value="value" class="form-control">Has
                                    Permit</label>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12" style="text-align: center">
                                <input id="scope_of_work_edit_btn" type="button" value="Edit" class="buttonsubmit" style="cursor: default" disabled>
                                <input id="scope_of_work_create_btn" type="button" value="Create"
                                    class="buttonsubmit1">
                                <input id="scope_of_work_download_btn" type="button" value="Download">
                            </div>
                        </div>
                    </form>

                    {{-- ////////////////////////////////////////////// Scope Of Work Sections ////////////////////////////////////////// --}}
                    <section id="scope_of_work_sections_section" class="mt-5" hidden>
                        <h3>Scope Of Work Sections</h3>
                        <form class="formdata">
                            <div id="scope_of_work_section_alert_div" class="alert alert-danger" hidden></div>
                            <div id="scope_of_work_section">
                                <div class="row mt-4 ml-4">
                                    <div class="col-md-6">
                                        <label for="">Title </label>
                                        <input id="scope_of_work_title_div" type="text" name="title"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-3 ml-4 mr-4">
                                    <label for="">Description</label>
                                    <textarea rows="15" cols="105" placeholder="" type="text"
                                        id="scope_of_work_description_texteditor" name="description"></textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12" style="text-align: center">
                                    <input id="scope_of_work_add_btn" type="button" value="Add"
                                        class="buttonsubmit1">
                                </div>
                            </div>
                        </form>

                        <h3>Scope Of Work Sections List</h3>
                        <table id="scope_of_work_table" class="table table-striped table-bordered table-sm"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="th-sm">Title</th>
                                    <th class="th-sm">Description</th>
                                    <th class="th-sm">ACtions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </section>
                </div>
            </section>




        </div>
    </div>
@endsection

@push('scripts')
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
    </script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.js"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/date-1.1.0/fh-3.1.9/sb-1.1.0/sp-1.3.0/sl-1.3.3/datatables.min.js">
    </script>
    <!--  datetime range -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    {{-- <link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.css"> --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
        integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous">
    </script>

    <script src='{{ asset('tinymce/tinymce.min.js') }}'></script>

    {{-- progress bar script --}}
    <script>
        const progressBar = document.getElementById("progress-bar");
        const progressNext = document.getElementById("progress-next");
        const progressPrev = document.getElementById("progress-prev");
        const steps = document.querySelectorAll(".step");
        let active = 1;

        progressNext.addEventListener("click", () => {
            active++;
            if (active > steps.length) {
                active = steps.length;
            }
            updateProgress();
            });

            progressPrev.addEventListener("click", () => {
            active--;
            if (active < 1) {
                active = 1;
            }
            updateProgress();
        });

        const updateProgress = () => {
            // toggle active class on list items
            steps.forEach((step, i) => {
                if (i < active) {
                step.classList.add("active");
                } else {
                step.classList.remove("active");
                }
            });
            // set progress bar width
            progressBar.style.width =
                ((active - 1) / (steps.length - 1)) * 100 + "%";
            // enable disable prev and next buttons
            if (active === 1) {
                progressPrev.disabled = true;
            } else if (active === steps.length) {
                progressNext.disabled = true;
            } else {
                progressPrev.disabled = false;
                progressNext.disabled = false;
            }
        };

    </script>

    <script>
        function accordion_initilize_by_id(id) {
            $('#' + id).bind('click', function() {
                if (!$(this).parent().hasClass('active')) {
                    $('.container').removeClass('active');
                    $(this).parent().addClass('active');
                } else {
                    $('.container').removeClass('active');
                }
            });
        }
    </script>

     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: [
                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help',
                'wordcount'
            ],
            toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
        });
        $('#design_service_edit_btn').click(function() {
            $('#design_services_section').removeClass('disable-div');
            $('#design_service_subtotal_div').attr('disabled',false);
            $('#design_service_edit_btn').attr('disabled', true);
            $('#design_service_edit_btn').css('cursor', 'default');
            $('#design_service_save_btn').attr('disabled', false);
            $('#design_service_save_btn').css('cursor', 'pointer');
        });

        $('#design_service_save_btn').click(function() {
            $('#alert_div').empty();
            var formData = new FormData($('.formdata6')['0']);
            formData.append("_token", "{{ csrf_token() }}");
            var design_service_subtotal = $('#design_service_subtotal_div').val();
            var design_service_stage_a = tinyMCE.get('design_service_stage_texteditor').getContent();
            formData.append("design_service_stage_a", design_service_stage_a);

            if(design_service_subtotal == '' || design_service_stage_a==''){
                $('#design_services_alert_div').empty();
                $('#design_services_alert_div').attr('hidden', false);
                $('#design_services_alert_div').append('You should enter data');
                setTimeout(() => {
                    $('#design_services_alert_div').attr('hidden', true);
                }, 5000);
            }else{
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
                    data:formData ,
                     url: "{{ route('save_design_service') }}",
                    success: function(result) {
                        if (result.state) {
                            $('#alert_div').empty();
                            $('#alert_div').append("<div class= 'alert alert-success'>" +result.message +"</div>");
                            $('#alert_div').attr('hidden', false).delay(5000).fadeOut();
                        } else {
                            $('#alert_div').empty();
                            $('#alert_div').append("<div class= 'alert alert-danger'>" +result.message +"</div>");
                            $('#alert_div').attr('hidden', false).delay(5000).fadeOut();
                        }
                    },

                });
                $('#design_service_stage_div').addClass('disable-div');
                $('#design_service_subtotal_div').attr('disabled', true);
                $('#design_service_edit_btn').attr('disabled', false);
                $('#design_service_edit_btn').css('cursor', 'pointer');
                $('#design_service_save_btn').attr('disabled', true);
                $('#design_service_save_btn').css('cursor', 'default');
                $('#design_service_paid_btn').attr('disabled', false);
                $('#design_service_paid_btn').css('cursor', 'pointer');

            }
        });

        $('#design_service_paid_btn').click(function() {
            var id = $('input[name="project_id"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'post',
                dataType: "json",
                data: {
                    'id':id
                },
                 url: "{{ route('Change_paid_design_service') }}",
                success: function(result) {
                    if (result.state) {
                        $('#alert_div_paid_design_service').empty();
                        $('#alert_div_paid_design_service').append("<div class= 'alert alert-success'>" +result.message +"</div>");
                        $('#alert_div_paid_design_service').attr('hidden', false).delay(5000).fadeOut();
                    } else {
                        $('#alert_div_paid_design_service').empty();
                        $('#alert_div_paid_design_service').append("<div class= 'alert alert-danger'>" +result.message +"</div>");
                        $('#alert_div').attr('hidden', false).delay(5000).fadeOut();
                    }
                },
            });
            $('#design_service_paid_btn').attr('disabled', true);
            $('#design_service_paid_btn').css('cursor', 'default');
            $('#materials_and_furniture_proposal_section').attr('hidden',false);
        });
        $('#create_material_and_furniture_edit_btn').click(function() {
            $('#create_material_and_furniture_div').removeClass('disable-div');
            $('#create_material_and_furniture_date_div').attr('disabled', false)
            $('#create_material_and_furniture_edit_btn').attr('disabled', true);
            $('#create_material_and_furniture_edit_btn').css('cursor', 'default');
            $('#create_material_and_furniture_create_btn').attr('disabled', false);
            $('#create_material_and_furniture_create_btn').css('cursor', 'pointer');
        });

        $('#create_material_and_furniture_create_btn').click(function() {
            var id = $('input[name="project_id"]').val();
            var formData = new FormData($('.formdata7')['0']);
            formData.append("_token", "{{ csrf_token() }}");
            var create_material_and_furniture_texteditor = tinyMCE.get('create_material_and_furniture_texteditor').getContent();
            formData.append("create_material_and_furniture_texteditor", create_material_and_furniture_texteditor);
            var create_material_and_furniture_date = $('#create_material_and_furniture_date_div').val();
            formData.append("id", id);
            if(create_material_and_furniture_date == '' || create_material_and_furniture_texteditor==''){
                $('#material_and_furniture_alert_div').empty();
                $('#material_and_furniture_alert_div').attr('hidden', false);
                $('#material_and_furniture_alert_div').append('You should enter data');
                setTimeout(() => {
                    $('#material_and_furniture_alert_div').attr('hidden', true);
                }, 5000);
            }
            else{
                $.ajax({
                    method: 'post',
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    data:formData ,
                     url: "{{ route('create_material_and_furniture')}}",
                    success: function(result) {
                        if (result.state) {
                            $('#material_and_furniture_alert_div_create').empty();
                            $('input[name="material_and_furniture_id_for_list"]').val(result.data);
                            $('input[name="material_and_furniture_id"]').val(result.data);
                            $('input[name="material_and_furniture_id_for_costs"]').val(result.data);
                            $('input[name="material_and_furniture_id_for_text_invoice"]').val(result.data);
                            $('#material_and_furniture_alert_div_create').append("<div class= 'alert alert-success'>" +result.message +"</div>");
                            $('#material_and_furniture_alert_div_create').attr('hidden', false).delay(5000).fadeOut();
                        } else {
                            $('#material_and_furniture_alert_div_create').empty();
                            $('#material_and_furniture_alert_div_create').append("<div class= 'alert alert-danger'>" +result.message +"</div>");
                            $('#material_and_furniture_alert_div_create').attr('hidden', false).delay(5000).fadeOut();
                        }
                    },

                });
                $('#create_material_and_furniture_div').addClass('disable-div');//
                $('#create_material_and_furniture_date_div').attr('disabled', true);////input data
                $('#material_and_furniture_list_section').attr('hidden', false);
                $('#create_material_and_furniture_create_btn').css('cursor', 'default');
                $('#create_material_and_furniture_create_btn').attr('disabled', true);
                $('#create_material_and_furniture_edit_btn').css('cursor', 'pointer');
                $('#create_material_and_furniture_edit_btn').attr('disabled', false);
                $('#contact_section_section').attr('hidden', false);
                $('#create_costs_section').attr('hidden', false);
                $('#architecture_tax_invoice_section_section').attr('hidden', false);
                $('#inventory_list_section_section').attr('hidden', false);
                $('#scope_of_work_section_Section').attr('hidden', false);
            }
        });

        $('#contact_section_create_btn').click(function() {
            var contact_name = $('#contact_section_name_div').val();
            var contact_position = $('#contact_section_position_div').val();
            var formData = new FormData($('.formdata8')['0']);
            formData.append("_token", "{{ csrf_token() }}");
            if (contact_name == '' && contact_position == '') {
                $('#contact_section_alert_div').empty();
                $('#contact_section_alert_div').attr('hidden', false);
                $('#contact_section_alert_div').append('You should enter data');
                setTimeout(() => {
                    $('#contact_section_alert_div').attr('hidden', true);
                }, 5000);
            } else {
                $.ajax({
                    method: 'post',
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    data:formData ,
                     url: "{{ route('create_contact_section')}}",
                    success: function(result) {
                        if (result.state) {
                            var contact_row = '<tr class="row'+result.data.id+'"><td>' + result.data.name + '</td>' +
                                 '<td>' + result.data.position + '</td>' +
                                 '<td>' +
                                 '<div class="row d-flex justify-content-center">' +
                                '<button id="" class="Delete_contact btn btn-danger" data-id="'+result.data.id+'" >Delete</button>'+
                                '<button  data-id="'+result.data.id+'"  class="Edit_contact btn btn-info ml-3">Edit</button>'+
                                 '</div>' +
                                 '</td></tr>';
                             $('#contact_section_table').append(contact_row);
                             $('#contact_section_name_div').val('');
                             $('#contact_section_position_div').val('');

                            $('#contact_section_create').empty();
                            $('#contact_section_create').append("<div class= 'alert alert-success'>" +result.message +"</div>");
                            $('#contact_section_create').attr('hidden', false).delay(5000).fadeOut();
                        } else {
                            $('#contact_section_create').empty();
                            $('#contact_section_create').append("<div class= 'alert alert-danger'>" +result.message +"</div>");
                            $('#contact_section_create').attr('hidden', false).delay(5000).fadeOut();
                        }
                    },
                });
            }
        });

        $('#scope_of_work_add_btn').click(function() {
            var scope_of_work_title = $('#scope_of_work_title_div').val();
            var scope_of_work_description = tinyMCE.get('scope_of_work_description_texteditor').getContent();
            if (scope_of_work_title == '' && scope_of_work_description == '') {
                $('#scope_of_work_section_alert_div').empty();
                $('#scope_of_work_section_alert_div').attr('hidden', false);
                $('#scope_of_work_section_alert_div').append('You should enter data');
                setTimeout(() => {
                    $('#scope_of_work_section_alert_div').attr('hidden', true);
                }, 5000);

            }else{
                var scope_of_work_row = '<tr><td class="col-md-3">' + scope_of_work_title +
                    '</td><td class="col-md-6">' + scope_of_work_description +
                    '</td><td><div class="row d-flex justify-content-center">' +
                    '<input type="button" value="Delete" class="btn btn-danger">' +
                    '<input type="button" value="Edit" class="btn btn-info ml-3">' +
                    '</div></td></tr>';
                $('#scope_of_work_table').append(scope_of_work_row);

                $('#scope_of_work_title_div').val('');
                tinyMCE.get('scope_of_work_description_texteditor').setContent('');
            }

        });


        $('#create_costs_save_btn').click(function() {
            var create_costs_installation_fees = $('#create_costs_installation_fees_div').val();
            var materal_and_f_id=$('input[name="material_and_furniture_id_for_costs"]').val();
            if(create_costs_installation_fees == ''){
                $('#create_costs_alert_div').empty();
                $('#create_costs_alert_div').attr('hidden', false);
                $('#create_costs_alert_div').append('You should enter installation fees');
                setTimeout(() => {
                    $('#create_costs_alert_div').attr('hidden', true);
                }, 5000);
            }else{
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                $.ajax({
                    type: "POST",
                    url: "{{ route('create_costs') }}",
                    data:{
                        costs_installation_fees:create_costs_installation_fees,
                        materal_and_f_id:materal_and_f_id
                    },
                    success: function(data) {
                        if (data.state) {
                            $('#create_costs_alert').empty();
                            $('#installation_fees').text(data.data.installation_fees);
                            $('#grand_total').text(data.data.grand_total);
                            $('#vat_fee').text(data.data.vat_fee);
                            $('#total_amount').text(data.data.total_amount);
                            $('#design_fee').text(data.data.design_fee);
                            $('#furniture_total').text(data.data.furniture_total);
                            $('#create_costs_alert').append("<div class= 'alert alert-success'>" +data.message +"</div>");
                            $('#create_costs_alert').attr('hidden', false).delay(5000).fadeOut();
                        }
                    },
                });
                $('#create_costs_installation_fees_div').attr('disabled', true);
                $('#create_costs_edit_btn').attr('disabled',false);
                $('#create_costs_edit_btn').css('cursor','pointer');
                $('#create_costs_save_btn').attr('disabled',true);
                $('#create_costs_save_btn').css('cursor','default');
            }
        });

        $('#create_costs_edit_btn').click(function() {
            $('#create_costs_installation_fees_div').attr('disabled', false);
            $('#create_costs_edit_btn').attr('disabled',true);
            $('#create_costs_edit_btn').css('cursor','default');
            $('#create_costs_save_btn').attr('disabled',false);
            $('#create_costs_save_btn').css('cursor','pointer');
        });

        $('#architecture_tax_invoice_show_btn').click(function() {
            if ($('#architecture_tax_invoice_show_btn').val() == 'Show') {
                $('#inventory_list_section').attr('hidden', false);
                $('#architecture_tax_invoice_show_btn').val('Hide');
            } else {
                $('#inventory_list_section').attr('hidden', true);
                $('#architecture_tax_invoice_show_btn').val('Show');
            }
        });


        $('#scope_of_work_edit_btn').click(function() {
            $('#scope_of_work_edit_btn').css('cursor','default');
            $('#scope_of_work_edit_btn').attr('disabled',true);
            $('#scope_of_work_create_btn').css('cursor','pointer');
            $('#scope_of_work_create_btn').attr('disabled',false);

            $('#scope_of_work_section').removeClass('disable-div');
        });

        $('#scope_of_work_create_btn').click(function() {
            var scope_of_work_starting_date = $('#scope_of_work_starting_date_div').val();
            var scope_of_work_note = $('#scope_of_work_note_div').val();
            if(scope_of_work_starting_date =='' && scope_of_work_note ==''){
                $('#scope_of_work_alert_div').empty();
                $('#scope_of_work_alert_div').attr('hidden', false);
                $('#scope_of_work_alert_div').append('You should enter data');
                setTimeout(() => {
                    $('#scope_of_work_alert_div').attr('hidden', true);
                }, 5000);
            }
            else{
                $('#scope_of_work_edit_btn').css('cursor','pointer');
                $('#scope_of_work_edit_btn').attr('disabled',false);
                $('#scope_of_work_create_btn').css('cursor','default');
                $('#scope_of_work_create_btn').attr('disabled',true);

                $('#scope_of_work_section').addClass('disable-div');
                $('#scope_of_work_sections_section').attr('hidden', false);
            }


        });

        $('#architecture_tax_invoice_save_btn').click(function() {
            var architecture_tax_invoice_code = $('#architecture_tax_invoice_code_div').val();
            var architecture_tax_invoice_date = $('#architecture_tax_invoice_date_div').val();
            var architecture_tax_invoice_texteditor = tinyMCE.get('architecture_tax_invoice_texteditor').getContent();
            var material_and_furniture_id_for_text_invoice =$('input[name="material_and_furniture_id_for_text_invoice"]').val();
            if(architecture_tax_invoice_code == '' && architecture_tax_invoice_date == '' && architecture_tax_invoice_texteditor ==''){
                $('#architecture_tax_invoice_alert_div').empty();
                $('#architecture_tax_invoice_alert_div').attr('hidden', false);
                $('#architecture_tax_invoice_alert_div').append('You should enter data');
                setTimeout(() => {
                    $('#architecture_tax_invoice_alert_div').attr('hidden', true);
                }, 5000);
            }
            else{
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                $.ajax({
                    type: "POST",
                    url: "{{ route('create_architecture_tax_invoice') }}",
                    data:{
                        'code':architecture_tax_invoice_code,
                        'date':architecture_tax_invoice_date,
                        'terms':architecture_tax_invoice_texteditor,
                        'material_and_furniture_id':material_and_furniture_id_for_text_invoice
                    },
                    success: function(data) {
                        if (data.state) {
                            $('input[name="text_invoice_id"]').val(data.data);
                            $('#architecture_tax_invoice_alert').empty();
                            $('#architecture_tax_invoice_alert').append("<div class= 'alert alert-success'>" +data.message +"</div>");
                            $('#architecture_tax_invoice_alert').attr('hidden', false).delay(5000).fadeOut();
                        }
                    },
                });
                $('#architecture_tax_invoice_section').addClass('disable-div');
                $('#architecture_tax_invoice_edit_btn').css('cursor','pointer');
                $('#architecture_tax_invoice_edit_btn').attr('disabled',false);
                $('#architecture_tax_invoice_save_btn').css('cursor','default');
                $('#architecture_tax_invoice_save_btn').attr('disabled',true);
            }
        });
        $('#architecture_tax_invoice_edit_btn').click(function() {
            $('#architecture_tax_invoice_section').removeClass('disable-div');
            $('#architecture_tax_invoice_edit_btn').css('cursor','default');
            $('#architecture_tax_invoice_edit_btn').attr('disabled',true);
            $('#architecture_tax_invoice_save_btn').css('cursor','pointer');
            $('#architecture_tax_invoice_save_btn').attr('disabled',false);
        });

        $('#create_material_and_furniture_list_button_id').click(function() {
            var title = $('#material_and_furniture_list_title').val();
            var note = $('#material_and_furniture_list_title_note').val();
            var formData = new FormData($('.formdata10')['0']);
            formData.append("_token", "{{ csrf_token() }}");

            if(title == ''){
                $('#material_and_furniture_list_alert_div').empty();
                $('#material_and_furniture_list_alert_div').attr('hidden', false);
                $('#material_and_furniture_list_alert_div').append('You should enter data');
                setTimeout(() => {
                    $('#material_and_furniture_list_alert_div').attr('hidden', true);
                }, 5000);

            }else{

                $.ajax({
                    method: 'post',
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    data:formData,
                     url: "{{ route('create_material_and_furniture_list')}}",
                    success: function(result) {
                        if (result.state) {
                            $(".formdata10")[0].reset();
                            $('#material_and_furniture_alert_list_create').empty();
                            $('#material_and_furniture_alert_list_create').append("<div class= 'alert alert-success'>" +result.message +"</div>");
                            $('#material_and_furniture_alert_list_create').attr('hidden', false).delay(5000).fadeOut();
                            $('#furnituer_list_items').append(
                                '<button class="accordion mt-5" >'+result.data.title+'   ('+result.data.note+')</button>'+
                                ' <div class="panel">'+
                                    '<div>'+
                                        '<form class="formdata_m_a_f_l_r' + result.data.id+' mr-4">'+
                                            '<div class="alert " hidden id="' + result.data.id+'"></div>'+
                                                '<div class="row ml-5">'+
                                                        '<h3 class="mt-4">Add List Row</h3></div><div class="row m-5">'+
                                                '<div class="col-md-2">'+
                                                    '<input class="form-control customeinput" type="text" name="S.NO"placeholder="S.NO.">'+
                                                '</div>'+
                                                '<div class="col-md-2">'+
                                                    '<input class="form-control" type="text" name="item_category" placeholder="Item Category">'+
                                                '</div>'+
                                                '<div class="col-md-2">'+
                                                   '<input class="form-control" type="text" name="list_size" placeholder="Size">'+
                                                '</div>'+
                                                '<div class="col-md-6">'+
                                                    '<input class="form-control" type="text" name="list_material_description" placeholder="Material Description">'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="row m-5">'+
                                                '<div class="col-md-4">'+
                                                    '<input class="form-control" type="file" name="list_file">'+
                                                '</div>'+
                                                 '<div class="col-md-2">'+
                                                    '<input class="form-control" type="text" name="list_unit" placeholder="Unit">'+
                                                 '</div>'+
                                                  '<div class="col-md-2">'+
                                                     '<input class="form-control" type="number" name="list_qty" placeholder="QTY">'+
                                                  '</div>'+
                                                  '<div class="col-md-2">'+
                                                      '<input class="form-control" type="text" name="lsit_currency" placeholder="Currency">'+
                                                  '</div>'+
                                                  '<div class="col-md-2">'+
                                                      '<input class="form-control" type="text" name="list_unit_price" placeholder="Unit Price">'+
                                                  '</div>'+
                                            '</div>'+
                                             '<div class="row m-5">'+
                                                 '<div class="col-md-2">'+
                                                     '<input class="form-control" type="text" name="list_brands" placeholder="Brands">'+
                                                 '</div>'+
                                                 '<div class="col-md-4">'+
                                                     '<input class="form-control" type="text" name="list_website_links" placeholder="Website Links">'+
                                                 '</div>'+
                                             '</div>'+
                                             '<div class="row m-5 d-flex justify-content-center">'+
                                                 '<div class="col-md-2">'+
                                                     '<input data-id="'+result.data.id+'" type="button" value="create" class="material_and_furniture_alert_list_create_row buttonsubmit1 btn-sm">'+
                                                 '</div>'+
                                             '</div>'+
                                        '</form>'+
                                      '</div>'+
                                     '<div>'+
                                    '<h4 class="mt-5">List Items</h4>'+
                                    '<div class="alert delete_update_alert" hidden id=""></div>'+
                                     '<table id="" class="table_mater_list_row'+result.data.id+' table  mt-2" style="max-height: 300px;overflow: auto;display:inline-block;">'+
                                        '<thead style="font-size:15px">'+
                                            '<tr>'+
                                                '<th scope="col">#</th>'+
                                                '<th scope="col">S.NO.</th>'+
                                                '<th scope="col">Item Category</th>'+
                                                '<th scope="col">Size</th>'+
                                                '<th scope="col">Material Description</th>'+
                                                '<th scope="col">image</th>'+
                                                '<th scope="col">Unit</th>'+
                                                '<th scope="col">QTY</th>'+
                                                '<th scope="col">Currency</th>'+
                                                '<th scope="col">Unit Price</th>'+
                                                '<th scope="col">Brands</th>'+
                                                '<th scope="col">Website Links</th>'+
                                                '<th scope="col">Actions</th>'+
                                            '</tr>'+
                                        '</thead>'+
                                        '<tbody style="font-size:15px">'+
                                        '</tbody>'+
                                    '</table>'+
                                 '</div>'+
                                '</div>');
                                fun();

                        } else {
                            $('#material_and_furniture_alert_list_create').empty();
                            $('#material_and_furniture_alert_list_create').append("<div class= 'alert alert-danger'>" +result.message +"</div>");
                            $('#material_and_furniture_alert_list_create').attr('hidden', false).delay(5000).fadeOut();
                        }
                    },

                });

            }
        });
        $('#design_service_download_btn').click(function(e){
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            var id = $('input[name="project_id"]').val();
            $.ajax({
                type: "POST",
                url: "{{ route('DownloadDesignServices') }}",
                data: {
                         id: id
                    },
                 success: function(result) {
                     window.open("/DesignServices"+ "{{ Auth::user()->id }}" + ".pdf",'_blank');
                 },
                 error: function(erorr) {
                     console.log(erorr);
                 }
            });
        });
        $(document).on('click','.Delete_contact',function(e){
           var id = $(this).data("id");
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
                        url: "{{ route('Delete_contact') }}",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            if (data.state) {
                                $('.row'+data.data).remove();
                                $('#contact_section_delete').empty();
                                $('#contact_section_delete').append("<div class= 'alert alert-success'>" +data.message +"</div>");
                                $('#contact_section_delete').attr('hidden', false).delay(5000).fadeOut();
                            } else {
                                $('#contact_section_delete').empty();
                                $('#contact_section_delete').append("<div class= 'alert alert-success'>" +data.message +"</div>");
                                $('#contact_section_delete').attr('hidden', false).delay(5000).fadeOut();
                             }
                        },
                    });
                }
            });
        });
        $(document).on('click', '#times', function() {
            $('.mod').css('display', 'none');
        })
        $(document).on('click', '#times1', function() {
            $('.mod1').css('display', 'none');
        })

        $(document).on('click','.Edit_contact',function(e){
            var id = $(this).data("id");
            $('.mod').css('display', 'block');
            var name=$('.row'+id).find("td:eq(0)").text();
            var position=$('.row'+id).find("td:eq(1)").text()
            var name_update=$('input[name="name_contact"]').val(name);
            var position_update=$('input[name="Position_update"]').val(position);
            var id_contact=$('input[name="id_contact_update"]').val(id);
        });
        $('.update_contact').click(function(e){
            var name_update=$('input[name="name_contact"]').val();
            var position_update=$('input[name="Position_update"]').val();
            var id_contact=$('input[name="id_contact_update"]').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('update_contact') }}",
                data: {
                    id: id_contact,
                    name:name_update,
                    position:position_update
                },
                success: function(data) {
                    if (data.state) {
                        // $('.row'+data.data.id).updateData();
                        $('.row'+data.data.id).find("td:eq(0)").text(data.data.name);
                        $('.row'+data.data.id).find("td:eq(1)").text(data.data.position);
                        $('.mod').css('display', 'none');
                        $('#contact_section_delete').empty();
                        $('#contact_section_delete').append("<div class= 'alert alert-success'>" +data.message +"</div>");
                        $('#contact_section_delete').attr('hidden', false).delay(5000).fadeOut();
                    } else {
                        $("#alertdata").empty();
                        $.each(data.message, function(key,value ){
                            $("#alertdata").append(
                            "<div class= 'alert alert-danger'>"+ value + "</div>");
                  		});
                        $("#alertdata").attr('hidden', false);
                    }
                },
            });
        });
        $(document).on('click','.material_and_furniture_alert_list_create_row',function(e){
            var id = $(this).data("id");
            var formData = new FormData($('.formdata_m_a_f_l_r'+id)['0']);
            formData.append("_token", "{{ csrf_token() }}");
            formData.append("id",id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                enctype: 'multipart/form-data',
                method: 'post',
                dataType: "json",
                processData: false,
                contentType: false,
                data: formData,
                url: "{{ route('create_material_and_furniture_alert_list_create_row') }}",
                data:formData,
                success: function(data) {
                    if (data.state) {
                        $('.formdata_m_a_f_l_r'+id)[0].reset();
                        $('.table_mater_list_row'+data.data.material_and_furniture_list_row_id).append(
                            '<tr class="table_row_for'+data.data.id+'">'+
                                '<td></td>'+
                                '<td>'+data.data.s_no+'</td>'+
                                '<td>'+data.data.item_category+'</td>'+
                                '<td>'+data.data.size+'</td>'+
                                '<td>'+data.data.material_description+'</td>'+
                                '<td>'+
                                    '<img src="" width=200 height=150 />'+
                                '</td>'+
                                '<td>'+data.data.unit+'</td>'+
                                '<td>'+data.data.qty+'</td>'+
                                '<td>'+data.data.currency+'</td>'+
                                '<td>'+data.data.unit_price+'</td>'+
                                '<td>'+data.data.brands+'</td>'+
                                '<td>'+data.data.website_links+'</td>'+
                                '<td>'+
                                    '<button  class="Delete_m_a_f_l_r btn btn-danger" data-id="'+data.data.id+'" >Delete</button>'+
                                    '<button  data-id="'+data.data.id+'"  class="Edit__m_a_f_l_r btn btn-info ml-3">Edit</button>'+
                                '</td>'+
                            '</tr>');
                        $('#'+id).empty();
                        $('#'+id).append("<div class= 'alert alert-success'>" +data.message +"</div>");
                        $('#'+id).attr('hidden', false);
                    } else {
                        $('#'+id).empty();
                        $('#'+id).append("<div class= 'alert alert-danger'>" +data.message +"</div>");
                        $('#'+id).attr('hidden', false);
                    }
                },
            });

        });
        $(document).on('click','.Delete_m_a_f_l_r',function(e){
            var id = $(this).data("id");
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
                        url: "{{ route('Delete_material_and_furniture_alert_list_create_row') }}",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            if (data.state) {
                                $('.table_row_for'+data.data).remove();
                                $('.delete_update_alert').empty();
                                $('.delete_update_alert').append("<div class= 'alert alert-success'>" +data.message +"</div>");
                                $('.delete_update_alert').attr('hidden', false).delay(5000).fadeOut();
                            } else {
                                $('.delete_update_alert').empty();
                                $('.delete_update_alert').append("<div class= 'alert alert-success'>" +data.message +"</div>");
                                $('.delete_update_alert').attr('hidden', false).delay(5000).fadeOut();
                            }
                        },
                    });
                }
            });

        });
        $(document).on('click','.Edit__m_a_f_l_r',function(e){
            var id = $(this).data("id");
            $('.mod1').css('display', 'block');
            var sno=$('.table_row_for'+id).find("td:eq(1)").text();
            var Category=$('.table_row_for'+id).find("td:eq(2)").text();
            var Size=$('.table_row_for'+id).find("td:eq(3)").text();
            var Description=$('.table_row_for'+id).find("td:eq(4)").text();
            // var image=$('.table_row_for'+id).find("td:eq(5)").html();
            var Unit=$('.table_row_for'+id).find("td:eq(6)").text();
            // console.log(image);
            var QTY=$('.table_row_for'+id).find("td:eq(7)").text();
            var Currency=$('.table_row_for'+id).find("td:eq(8)").text();
            var Price=$('.table_row_for'+id).find("td:eq(9)").text();
            var Brands=$('.table_row_for'+id).find("td:eq(10)").text();
            var Links=$('.table_row_for'+id).find("td:eq(11)").text();
            $('input[name="S.NO_upate"]').val(sno);
            $('input[name="item_category_update"]').val(Category);
            $('input[name="list_size_update"]').val(Size);
            $('input[name="list_material_description_update"]').val(Description);
            $('input[name="list_unit_update"]').val(Unit);
            $('input[name="list_qty_update"]').val(QTY);
            $('input[name="lsit_currency_update"]').val(Currency);
            $('input[name="list_unit_price_update"]').val(Price);
            $('input[name="list_brands_update"]').val(Brands);
            $('input[name="list_website_links_update"]').val(Links);
            $('input[name="list_id_update"]').val(id);

        });
        $(document).on('click','.material_and_furniture_alert_list_update_row',function(e){
            var formData = new FormData($('.formdata_m_a_f_update')['0']);
            formData.append("_token", "{{ csrf_token() }}");
            $.ajax({
                enctype: 'multipart/form-data',
                method: 'post',
                dataType: "json",
                processData: false,
                contentType: false,
                url: "{{ route('update_material_and_furniture_alert_list_create_row') }}",
                data: formData,
                success: function(data) {
                    if (data.state) {
                        $('.table_row_for'+data.data.id).find("td:eq(1)").text(data.data.s_no);
                        $('.table_row_for'+data.data.id).find("td:eq(2)").text(data.data.item_category);
                        $('.table_row_for'+data.data.id).find("td:eq(3)").text(data.data.size);
                        $('.table_row_for'+data.data.id).find("td:eq(4)").text(data.data.material_description);
                        $('.table_row_for'+data.data.id).find("td:eq(5)").html('<img scr="'+data.data.photo+'" width="200" height="150"');
                        $('.table_row_for'+data.data.id).find("td:eq(6)").text(data.data.unit);
                        $('.table_row_for'+data.data.id).find("td:eq(7)").text(data.data.qty);
                        $('.table_row_for'+data.data.id).find("td:eq(8)").text(data.data.currency);
                        $('.table_row_for'+data.data.id).find("td:eq(9)").text(data.data.unit_price);
                        $('.table_row_for'+data.data.id).find("td:eq(10)").text(data.data.brands);
                        $('.table_row_for'+data.data.id).find("td:eq(11)").text(data.data.website_links);
                        $('.mod1').css('display', 'none');
                        $('.delete_update_alert').empty();
                        $('.delete_update_alert').append("<div class= 'alert alert-success'>" +data.message +"</div>");
                        $('.delete_update_alert').attr('hidden', false).delay(5000).fadeOut();
                    } else {
                        $('#Update_List_Row_alert').empty();
                        $('#Update_List_Row_alert').append("<div class= 'alert alert-danger'>" +data.message +"</div>");
                        $('#Update_List_Row_alert').attr('hidden', false).delay(5000).fadeOut();
                    }
                },
            });

        });
        $('#architecture_tax_invoice_download_btn').click(function(e){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var id = $('input[name="text_invoice_id"]').val();
            $.ajax({
                type: "POST",
                url: "{{ route('DownloadArchitectureTaxInvoice') }}",
                data: {
                         id: id
                    },
                 success: function(result) {
                     window.open("/ArchitectureTaxInvoicepdf"+ "{{ Auth::user()->id }}" + ".pdf",'_blank');
                 },
                 error: function(erorr) {
                     console.log(erorr);
                 }
            });
        });
        $('#architecture_tax_invoice_list_download_btn1').click(function(e){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var id = $('input[name="project_id"]').val();
            $.ajax({
                type: "POST",
                url: "{{ route('DownloadTaxInvoice') }}",
                data: {
                         id: id
                    },
                 success: function(result) {
                     window.open("/taxinvoice"+ "{{ Auth::user()->id }}" + ".pdf",'_blank');
                 },
                 error: function(erorr) {
                     console.log(erorr);
                 }
            });
        });


    </script>
    <script>
        function fun(){
            var acc = document.getElementsByClassName("accordion");
        var i;
        for (i = 0; i < acc.length; i++) {
          acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
              panel.style.display = "none";
            } else {
              panel.style.display = "block";
            }
          });
        }

        }

    </script>
    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;
        for (i = 0; i < acc.length; i++) {
          acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
              panel.style.display = "none";
            } else {
              panel.style.display = "block";
            }
          });
        }



    </script>
@endpush
