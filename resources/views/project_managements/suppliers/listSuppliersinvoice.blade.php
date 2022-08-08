@extends('layouts.app')
@push('head')
    <title>List Supplier Invoices</title>

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
            font-family: 'Lato-Regular';
            src: url('font/Lato-Regular.ttf');
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
            /* margin-left: -5px; */
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
         #tablebuttonexcel button,#tablebuttoncsv button{
            background: #6d4e18;
            border: #6d4e18;
            font-family: 'Lato-Regular';
            font-size:15px;
            color:#fff;
            width: 6rem;
            border-radius: 9px;
            box-shadow: 0 8px 7px -7px rgb(115 115 115 / 21%), -6px 0 7px -3px rgb(115 115 115 / 34%);
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
            font-size: 12px;
            font-family: 'Lato-Semibold';
            color: #fff;
               /* border-right: 1px solid;*/
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
            right: 50%;
            margin-top: 2rem;
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
    /* margin-left: -2px; */
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
        top: 2px;
    right: 192px;
    }
    #dataTable_filter label::after {
    width: 61px;
    top: 10px;
    right: 58px;
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
        top: 10px!important;
        right: 63px!important;
    }
    #dataTable_filter label::before{
        top: 2px;
        right: 179px;
    }
    #bookslist_info{
        position: inherit;
    }
    #wrapper{
        background-size: cover!important;

    }
    .top-title{
        /* margin-left:20px!important; */
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
#agentname:focus-visible,#userid:focus-visible,#userstatus:focus-visible,#sel1:focus-visible,#daymonthvalue:focus-visible,#rangedate:focus-visible,#datasource:focus-visible{
    outline: none;
}
#sel1,#datasource,#userstatus,#userid,#agentname{
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
#daymonthvalue,#rangedate{
    box-shadow: 0 4px 2px -2px #d9d1d1;
    color: #878b8f;
    vertical-align: middle;
    height: calc(2.25rem + 2px);
    padding: 0.375rem 1.75rem 0.375rem 0.75rem;
        font-size: 12px;
        font-family: 'Lato-Regular'!important;
        border-right: 3px solid #e4aa47!important;
}
#daymonthfilter,#rangefilter{
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
}
.card-header{
        padding: 0 10rem;
}
.pad-row{
    padding: 0 4.7rem;
}
.row3{
    margin-top: -4rem;
}
#img-div{
   margin-top: -15px;
    margin-bottom: 7px;
    margin-left: -7px;
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
    box-shadow:-1px -3px 3px -2px #d9d1d1;
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
    transform: translateX(-50%);
    box-shadow:-1px 3px 2px -2px #d9d1d1;
    /* border-top: 1px solid #d9d1d1;*/
}
#dataTable_length, #dataTable_filter, .dataTables_scroll{
    background: #fff;
}
 .card-body-one{
          margin-top: -7rem!important;
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
/*start*/
.page-item.active .page-link {
    z-index: 3;
    color: #6d4e18!important;
    font-family: 'Lato-Semibold'!important;
    background-color: #ffffff!important;
    /* border-color: #ffffff; */
    top: 0px!important;
    border: none!important;
    border-bottom: 2px solid #6d4e18!important;
}
.page-link:focus{
    box-shadow: inset 0px 2px 0px 0px rgb(115 115 115 / 75%)!important;
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
    background-color: #e9edec87!important;
    /*border-color: #e5e5e5;*/
    color: #114c45!important;
}
.page-link:hover {
    z-index: 2;
    color: #224abe;
    text-decoration: none;
    background-color: #e9edec87!important;
    /* border-color: #e5e5e5; */
    color: #bec7c6!important;
}
/*end*/

i.fa-whatsapp{
    font-size: 19px;
    color: #5fb750;
}

#mobile{
    display: none;
}
/*responsive*/
@media(max-width: 1300px) and (min-width: 1201px){
    .card-header {
    padding: 0 8rem;
}
}
@media(max-width: 1200px) and (min-width: 1025px){
    .card-header {
    padding: 0 5rem;
}
}
@media(max-width: 1024px) and (min-width: 800px){
    .pad-row {
    padding: 0 4.8rem 0 5rem;
}
#datetimepicker2 label{
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
    height: auto!important;
}
#dataTable_filter label {
    margin-top: 0.3rem;
    width: 50%;
}
}
@media(min-width:1024px){
    .top-card-body{margin-top: -7rem !important;}
}
@media(max-width: 768px) and (min-width: 499px){
    .top-card-body{margin-top: -2rem !important;}
.card-header,#container-f{
    padding:0!important;
}
.row3{
        margin-top: -3rem;
}
.pad-row{
    padding: 0 3.5rem!important;
}
#dataTable_length{
    right: 64%;
}
#resid:after,#resid2:before{
    width: 6rem;
}
#pad-row1{
    margin-bottom: 0.7rem!important;
}
#pad-row2{
    margin-top: -2rem
}
#desktop{
        width:20%;
    }
#img-div {
    margin-top: -10px;
    margin-bottom: 9px;
    margin-left: -7px;
}
.btn-group{
    top: 0;
    left: 0;
    margin-bottom: 1rem;
    margin-top: 1rem;
    position: inherit;
}
#wrapper {
    height: auto!important;
}
#dataTable_filter label{

    margin-top: 0.3rem!important;
    width: 55%;
}
.desc{
    width:100%!important;
}
.group-button {
    position: inherit;
}
.card-body-one {
    margin-top: -2rem!important;
}
}



@media(max-width: 500px){
    .justify-content-start,.justify-content-end {
    justify-content: center!important;
}
    .btn-group{
    position: inherit!important;
    }
    .card-header ,.pad-row{
    padding: 0!important;
}
#resid:after,#border img,#border2,#resid2:before,#border4 img,#border3,.none,#border4,#border{
    display: none;
}
#img-div {
     display: none;
    }
    #img-div img{
        width: 100%!important;
    }
    .row3,.card-body{
        margin-top: 0!important;
    }
    #daymonthfilter, #rangefilter{
        right: 4px;
    }
    #daymonthvalue, #rangedate{
            border-right: 3px solid #143e39!important;
    }
    #wrapper {
    height: auto!important;
}
#desktop{
    display: none;
}
#mobile{
    display: block;
    padding-left: 10px;
    text-align: left;
    color: #143e39;
    font-family: 'Lato-Bold';
    font-size: 13px;
}
#container-f{
    padding-right: 0!important;
}
#dataTable_length{
    background: transparent;
    margin-top: 0;
}
#left-input{
    margin-bottom: 0!important;
}

}
.dt-buttons button {
    margin-right: 1px;
    background: #6d4e18;
    border: #6d4e18;
    font-family: 'Lato-Regular';
    font-size: 12px;
    color: #fff;
    width: 6rem;
    height: 2.5rem;
    /* border-radius: 9px!important; */
    box-shadow: 0 8px 7px -7px rgb(115 115 115 / 21%), -6px 0 7px -3px rgb(115 115 115 / 34%);
}
.btn-group{
    top: 59px;
    left: 10px;
}
th.headtable {
    background: orange!important;
    }
span.sp {
    color: #3b2a0f;
    font-family: 'Lato-Regular';
    font-weight: 300;
    font-size: 12px;
}
#bottom-table{
    display: none;
}
#div1{
    justify-content: left!important;
    margin-left: 0.5rem;
}
@media(max-width: 1200px){
    #div1{
    justify-content: center!important;
    margin-left: 0rem;
}
   #bottom-table{
    display: block;
    width: auto;
}
td.bodytable {
    height: 3rem;
    background: #fff;
}
th.headtable{
    width: 10rem!important;
    text-align: center;
}
th.headtable span.sp {
    color: #3b2a0f;
    font-family: 'Lato-Regular';
    font-weight: 300;
    font-size: 12px;
}
/* #div1{
    display: none;
} */
.scroll{
    overflow-x: hidden;
    margin-top: 3rem;
}
}
.bottom-row .card{
border-bottom: 1px solid #184d47;
    border-radius: 0;
    width: auto;
}
.bottom-row .card .card-header{
 font-family: 'Lato-Bold';
 font-size: 10px;
 color: #184d47;
 padding: 0.75rem 0.1rem!important;
}
.bottom-row .card .card-header .sp{
    padding: 0rem 4px!important;
    border-right: 1px solid #251a08;
        border-right: 1px solid #251a08;
        font-size:11px;
}
.mod{
    width: 50%;
    margin: auto;
    padding: 30px;
    position: fixed;
    box-shadow: 0px 0px 4px 1px #6c4d18;
    border: 1px solid #e4aa47;
    top:40%;
    background-color: white;
    transform: translate(-50%,-50%);
    left:60%;
    display: none;
    z-index: 100;
}
#times{
    position: absolute;
    left: 90%;
    top: 5%;
    /* margin: 10px; */
    z-index: 10;
    cursor: pointer;

}





.toggle-rect-bw{
    width: 60%;
    margin: auto;
    text-align: center;
}
.toggle-rect-bw input[type="checkbox"] {
  display: none;
}
.toggle-rect-bw input[type="checkbox"] + label {
  display: block;
  position: relative;
  width: 4em;
  height: 1.6em;
  background: #b07205;
  border-radius: 1em;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
}
.toggle-rect-bw input[type="checkbox"] + label:before {
  content: "";
  display: block;
  width: 2em;
  height: 1.2em;
  border-radius: 1em;
  background: #f7f2f2;
  position: absolute;
  left: 0.2em;
  top: 0.2em;
  -webkit-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
}
.toggle-rect-bw input[type="checkbox"]:checked + label {
  background: #6d4e18;
}
.toggle-rect-bw input[type="checkbox"]:checked + label:before {
  left: 1.6em;
}

td{
    vertical-align: middle !important;
}
    </style>

    <!--datatable-->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/date-1.1.0/fh-3.1.9/sb-1.1.0/sp-1.3.0/sl-1.3.3/datatables.min.css" />

    <!--datatable-->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.css"
        crossorigin="anonymous" />

    {{-- date range --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@section('wrapper_content')
<div class="mod" >
    <h5 >Show Image</h5>
    <hr>
    <i class=" fa fa-times" id="times"></i>
    <div class="container">
        <div class="row mt-4 mb-4" style="align-items: center;margin:auto">
            <img id="supplier_in_image"src="" width="100%" height="350px" style="align-items: center;margin:auto"/>
        </div>
    </div>
</div>
    <!-- Content Wrapper -->
    <div class="container-fluid" style="padding-left:0!important">
    <div class="row">
        <div class="col-lg-6 col-md-7 col-11" >
            <h3 class="top-title">List Supplier Invoices</h3>
        </div>
    </div>
    </div>
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid" style="margin-top:1.5rem">

                {{-- alert section --}}
                <div class="alert " role="alert" id="alertdiv" hidden>
                </div>

                <div id="parent" class="card shadow mb-4">
                    <div class="card-header py-3 mb-5">
                        <h3 class="m-0 font-weight-bold" style="color: #70cacc;display:none">
                            List Supplier Invoices
                        </h3>


                        <div class="row mt-5 mb-5">
                            <div class="col-lg-4 col-md-6 col-12">
                            <label id="mobile" for="daymonthvalue" class="mt-2">Number</label>
                                <div class="col-md-12 col-12">
                                   <label id="desktop" for="rangedate" class="desc mt-2">Number</label>
                                </div>
                                <select id="number" class="form-control mt-2">
                                    <option value="ALL">All</option>
                                    @foreach ($supplier_invoices as $supplier_invoice)
                                        <option value="{{ $supplier_invoice->number }}">{{ ucfirst($supplier_invoice->number) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                            <label id="mobile" for="daymonthvalue" class="mt-2">Projects</label>
                                <div class="col-md-12 col-12">
                                   <label id="desktop" for="rangedate" class="desc mt-2">Projects</label>
                                </div>
                                <select id="project" class="form-control mt-2">
                                    <option value="ALL">All</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ ucfirst($project->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                            <label id="mobile" for="daymonthvalue" class="mt-2">Suppliers</label>
                                <div class="col-md-12 col-12">
                                    <label id="desktop" for="rangedate" class="desc mt-2">Suppliers</label>
                                </div>
                                <select id="suppliers" class="form-control mt-2">
                                    <option value="ALL">All</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ ucfirst($supplier->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-body top-card-body mt-5">
                        <div id="loader" class="lds-dual-ring hidden overlay"></div>


                        <table class="table table-bordered table-hover" style="width: 250%" id="dataTable">
                            <thead style="background: #70cacc;color: aliceblue;">
                                <tr>
                                <th><span class="table-title">Project</span></th>
                                    <th><span class="table-title">Supplier</span></th>
                                    <th><span class="table-title">Number</span></th>
                                    <th><span class="table-title">Path</span></th>
                                    <th><span class="table-title">Total Payment</span></th>
                                    <th><span class="table-title">Advanced Payment</span></th>
                                    <th><span class="table-title">Is Delivered</span></th>
                                    <th><span class="table-title">Action</span></th>
                                    <th><span class="table-title">Change Status</span></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="row mt-2">
                            <div id="tableinfo" class="col-md-6 d-flex justify-content-start"></div>
                            <div id="tablepaginate" class="col-md-6 d-flex justify-content-end"></div>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/date-1.1.0/fh-3.1.9/sb-1.1.0/sp-1.3.0/sl-1.3.3/datatables.min.js">
    </script>

    {{-- swal alert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!--  datetime range -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>



    <script>
        $(document).on('click','#times',function(){
            $('.mod').css('display','none');
        })
        $(document).ready(function() {
            let table = $('#dataTable').DataTable({
                "processing": true,
                "serverSide": true,
                scrollY: 500,
                scrollX: true,
                scrollCollapse: true,
                "pageLength": 100,
                "deferRender": true,
                "paging": true,
                "pagingType": "full_numbers",
                "ajax": {
                    "url": "{{ route('show_Supplier_invoice') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        return $.extend({}, d, {
                            _token: "{{ csrf_token() }}",
                            "number": $('#number').val(),
                            "suppliers": $('#suppliers').val(),
                            "project": $('#project').val(),
                        });
                    },
                    beforeSend: function() {
                        $("#parent").LoadingOverlay("show", {
                            background: "rgba(78, 115, 223, 0.5)"
                        });
                    },
                    complete: function() {
                        $("#parent").LoadingOverlay("hide", true);
                    },
                    error: function(res) {
                        console.log(res);
                    },
                },
                "columns": [{
                        data: 'projectsname',
                        name: 'projectsname',
                        width: 100
                    },
                    {
                        data: 'suppliersname',
                        name: 'suppliersname',
                        width: 100
                    },
                    {
                        data: 'number',
                        name: 'number',
                        width: 100
                    },
                    {
                        data: 'image',
                        name: 'image',
                        width: 200,

                    },
                    {
                        data: 'total_payment',
                        name: 'total_payment',
                        width: 100,

                    },
                    {
                    data: 'advanced_payment',
                    name: 'advanced_payment',
                    width: 100,

                },
                {
                    data: 'status',
                    name: 'status',
                    width: 100,

                },
                {
                    data: 'action',
                    name: 'action',
                    width: 200,

                },
                {
                    data: 'change',
                    name: 'change',
                    width: 50,

                },

                ],
                "lengthMenu": [
                    [100, 500, 1000, 2000, 5000, 10000],
                    [100, 500, 1000, 2000, 5000, 10000],
                ],
                "language":{
                    searchPlaceholder:"Type and press Enter"
                },
                "dom": 'Blftip',
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
            $("div.dataTables_filter input").keyup(function(e) {
                if (e.keyCode == 13) {
                    table.search(this.value).draw();
                }
            });
            $('#number').change(function() {
                $('#dataTable').data("dt_params", {
                    _token: "{{ csrf_token() }}",
                    "number": $('#number').val(),
                    "suppliers": $('#suppliers').val(),
                    "project": $('#project').val(),
                }, );
                $('#dataTable').DataTable().draw();
            });
            $('#suppliers').change(function() {
                $('#dataTable').data("dt_params", {
                    _token: "{{ csrf_token() }}",
                    "number": $('#number').val(),
                    "suppliers": $('#suppliers').val(),
                    "project": $('#project').val(),
                }, );
                $('#dataTable').DataTable().draw();
            });
            $('#project').change(function() {
                $('#dataTable').data("dt_params", {
                    _token: "{{ csrf_token() }}",
                    "number": $('#number').val(),
                    "suppliers": $('#suppliers').val(),
                    "project": $('#project').val(),
                }, );
                $('#dataTable').DataTable().draw();
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
                                url: "{{ route('deleteSupplierInvoice') }}",
                                data: {
                                    id: id
                                },
                                dataType: 'json',
                                success: function(result) {
                                    if (result.state) {
                                        $('#alertdiv').empty();
                                        $('#alertdiv').append(
                                            "<div class= 'alert alert-success'>" +
                                            result
                                            .message +
                                            "</div>");
                                        $('#alertdiv').attr('hidden', false).delay(5000).fadeOut();
                                        $('#dataTable').DataTable().draw();
                                    } else {
                                        $('#alertdiv').empty();
                                        $('#alertdiv').append(
                                            "<div class= 'alert alert-danger'>" +
                                            result
                                            .message +
                                            "</div>");
                                        $('#alertdiv').attr('hidden', false).delay(5000).fadeOut();
                                    }
                                },
                            });
                        }
                    });
                });

                $('body').on('click', '.show_image', function(e) {
                    var image = table.row(this.closest('tr')).data()['path'];
                    console.log(image);
                    $('.mod').css('display','block');

                    document.getElementById("supplier_in_image").src=image;

                });
                $('body').on('click', '.change', function(e) {
                    var id = table.row(this.closest('tr')).data()['id'];
                    document.getElementById(id).value=this.checked?'1':'0';
                    var change = document.getElementById(id).value;
                    console.log(change);
                    $.ajaxSetup({
                         headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('change_status') }}",
                        data: {
                             id: id,
                             change :change
                        },
                        dataType: 'json',
                        success: function(result) {
                                if (result.state) {
                                $('#alertdiv').empty();
                                $('#alertdiv').append(
                                    "<div class= 'alert alert-success'>" +
                                     result
                                    .message +
                                     "</div>");
                                 $('#alertdiv').attr('hidden', false).delay(5000).fadeOut();
                                 $('#dataTable').DataTable().draw();
                             } else {
                                $('#alertdiv').empty();
                                $('#alertdiv').append(
                                    "<div class= 'alert alert-danger'>" +
                                    result
                                    .message +
                                     "</div>");
                                 $('#alertdiv').attr('hidden', false).delay(5000).fadeOut();
                             }
                         },
                    });
                });
                $('body').on('click', '.edit', function() {
                    var id = table.row(this.closest('tr')).data()['id'];
                    $.ajaxSetup({
                         headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "get",
                        url: "{{ route('editSupplierinvoice') }}/" + id,
                        dataType: 'html',
                        success: function(result) {
                            window.location.href = "{{ route('editSupplierinvoice') }}/" +id;
                        },
                    });
                });
        });

    </script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
        integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous">
    </script>
@endpush
