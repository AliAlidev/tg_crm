@extends('layouts.app')
@push('head')

    <title>Show follow up leads data comments</title>

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
            #filter-title{
    font-family: 'Lato-Semibold';
    color: #164741;
}
.before-row{
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
        .top-title{
            font-family: 'Lato-Semibold';
            font-size:20px;
            color:#fff;
            height: 4rem;
            padding: 14px 35px;
            /* margin-left: -5px; */
            border-radius: 0 0px 55px 0;
            background-image: linear-gradient(to right, #211706, #291d0a, #30230c, #39290f, #412f10, #503913, #5f4416, #6e4f19, #88621f, #a37526, #be892c, #db9d33);
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
            right: 53%;
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
#sel1:focus-visible,#userstatus:focus-visible,#daymonthvalue:focus-visible,#rangedate:focus-visible,#datasource:focus-visible{
    outline: none;
}
#sel1,#datasource,#userstatus{
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
.btn-group{
    top: 58px;
    left: 14px;
}
.btn-group button {
    background: #5c4215!important;
    font-family: 'Lato-Regular'!important;
}
#daymonthvalue,#rangedate{
    border-right: 3px solid #e4aa47!important;
    box-shadow: 0 4px 2px -2px #d9d1d1;
    color: #878b8f;
    border-radius: 0!important;
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
    padding: 0 4.8rem;
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
 .card-body{
          margin-top: 0rem!important;
          padding-bottom: 4rem;
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
    display: block;
}
/*responsive*/
@media(max-width: 1300px) and (min-width: 1201px){
    .card-header {
    padding: 0 8rem;
}
}
@media(max-width: 1295px) and (min-width: 1210px){
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
@media(max-width: 1200px){
   #bottom-table{
    display: block;
    width: 77rem;
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
    overflow-x: scroll;
    margin-top: 3rem;
}
}

.bottom-row .card{
border-bottom: 1px solid #184d47;
    border-radius: 0;
    width: auto;
}
.bottom-row .headtable{
    background: #fab100!important;
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
.bottom-row .card .card-body{
    padding-bottom: 1rem!important;
}
@media(max-width:1450px) and (min-width:1300px){
    .first-label{
    width: 23%;
    margin-left: -9px;
    margin-bottom:0!important;
}
}
div#left-input {
    align-items: center;
}
@media(max-width: 768px) and (min-width: 499px){
    .btn-group {
    top: 0;
    left: 0;
    position: inherit!important;
    margin-bottom: 1rem;
}
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
    left:10%;
}
#resid:after,#resid2:before{
    width: 6rem;
}
#pad-row1{
    margin-bottom: 0.7rem!important;
}
#pad-row2{
    margin-top: -1rem
}
#datetimepicker2{
    margin-bottom: 0.7rem!important;
    margin-top: 0.3rem;
}
#desktop{
        width:20%;
    }
#img-div {
    margin-top: -7px;
    margin-bottom: 5px;
    margin-left: -7px;
}
#wrapper {
    height: auto!important;
}
#dataTable_filter label{

    margin-top: 0.3rem!important;
    width: 55%;
}
}



@media(max-width: 500px){
    .btn-group {
    top: 0;
    left: 0;
    position: inherit!important;
}
    #rangedate{
        margin-bottom: 1rem!important;
    }
    .pagination li .page-link{
        font-size: 10px!important;
    padding: 0.5rem 0.15rem!important;
    }
    .page-item.disabled .page-link {
        text-align:center!important;
    }
    .justify-content-end {
    justify-content: center!important;
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
        top: 0;
    }
    .before-row {
    padding: 0 0;
}
.justify-content-start {
    justify-content: center!important;
}
nav ul .leads-show.show li a{
    padding-left: 11px!important;
    line-height: 1.3!important;
    font-family: 'Lato-Regular'!important;
    font-size: 12px!important;
}
    #daymonthvalue, #rangedate{
            border-right: 3px solid #e4aa47!important;
    }
    #wrapper {
    height: auto!important;
}
/* #desktop{ */
    display: block;
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
    margin-top: 30px;
}
#left-input{
    margin-bottom: 0!important;
}

}
    </style>

    <!--datatable-->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/date-1.1.0/fh-3.1.9/sb-1.1.0/sp-1.3.0/sl-1.3.3/datatables.min.css" />

    <!--datatable-->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.css"
        crossorigin="anonymous" />

@endpush

@section('wrapper_content')

    <!-- Content Wrapper -->
    <div class="container-fluid" style="padding-left:0!important">
        <div class="row">
            <div class="col-lg-5 col-md-7 col-11" >
               <h3 class="top-title">Show follow up leads data comments</h3>
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
                        <!-- <h3 class="m-0 font-weight-bold" style="color: #70cacc;">
                            Show follow up leads data comments
                        </h3> -->
                        <div class="row">
                            <div class="col-md-6">
                            <label id="mobile" for="daymonthvalue" class="mt-2">Customer status</label>
                                <div class="input-group date mb-3" id="datetimepicker2">
                                <select id="userstatus" class="form-control mt-2">
                                    <option value="">All</option>
                                    @foreach ($userstatus as $state)
                                        <option value="{{ $state }}">{{ ucfirst($state) }}
                                        </option>
                                    @endforeach
                                </select>
                                </div>
                            </div>

                        </div>

                        <span id="alertdata"></span>

                        <div class="alert pb-3 mt-3" role="alert" id="alertdiv" hidden>
                        </div>

                        <input value="" type="text" name="search" id="filter" hidden />
                        <!-- <div class="row mt-5 mb-5">
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <h4>Customer status</h4>
                                </div>
                                <select id="userstatus" class="form-control mt-2">
                                    <option value="">All</option>
                                    @foreach ($userstatus as $state)
                                        <option value="{{ $state }}">{{ ucfirst($state) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="col-md-12">
                                    <h4>Data source</h4>
                                </div>
                                <select id="datasource" class="form-control mt-2">
                                    <option value="">All</option>
                                    @foreach ($datasources as $datasource)
                                        <option value="{{ $datasource->source }}">{{ ucfirst($datasource->source) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> --}}
                        </div> -->
                    </div>

                    <div class="row mt-4">
                        @if (Auth::user()->isadmin())
                            <div class="col-md-3 d-flex justify-content-start  group-button">
                                <div id="tablebuttoncsv" class="mr-1 ml-3"></div>
                                <div id="tablebuttonexcel" class="mr-1"></div>
                                <div id="tablebuttonpdf" class="mr-1"></div>
                            </div>
                        @endif
                    </div>

                    <div class="card-body mt-3">
                        <table class="table table-bordered table-hover" style="width: 250%" id="dataTable">
                            <thead style="background: #70cacc;color: aliceblue;">
                                <tr>
                                <th><span class="table-title">Name</span></th>

                                        <th><span class="table-title">Commnets</span></th>
                                        <th><span class="table-title">User status</span></th>
                                        <th><span class="table-title">Email</span></th>
                                        <th><span class="table-title">Phone</span></th>
                                        <th><span class="table-title">Mobile</span></th>
                                        <th><span class="table-title">Phone Whatsapp</span></th>
                                        <th><span class="table-title">Title</span></th>
                                        <th><span class="table-title">Bedroom</span></th>
                                        <th><span class="table-title">Project</span></th>
                                        <th><span class="table-title">Source</span></th>
                                        <th><span class="table-title">Agent name</span></th>
                                        <th><span class="table-title">Created at</span></th>
                                    <!-- <th>Name</th>
                                    <th>Commnets</th>
                                    <th>User status</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Title</th>
                                    <th>Bedroom</th>
                                    <th>Project</th>
                                    <th>Source</th>
                                    <th>Agent name</th>
                                    <th>Created at</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        {{-- info --}}
                        <div class="scroll">
                        {{-- <table id="bottom-table">
                            <tr>
                                <th class="headtable"><span class="sp">Total calls</span></th>
                                <th class="headtable"><span class="sp">Interested</span></th>
                                <th class="headtable"><span class="sp">Not interested</span></th>
                                <th class="headtable"><span class="sp">Not answer</span></th>
                                <th class="headtable"><span class="sp">Number unavailable/Not working for call/Incomplete no</span></th>
                                <th class="headtable"><span class="sp">Switch off/Line busy/Wrong number/Invalid number</span></th>
                                <th class="headtable"><span class="sp">Others</span></th>
                                <th class="headtable"><span class="sp">Set appointment</span></th>
                            </tr>
                            <tr>
                                <td class="bodytable"><h3 id="total"  class="card-text d-flex justify-content-center">
                                        {{ isset($total) ? $total : 0 }}</h3></td>
                                <td class="bodytable"><h3 id="interested" class="card-text d-flex justify-content-center">
                                        {{ isset($interested) ? $interested : 0 }}</h3></td>
                                <td class="bodytable"><h3 id="notinterested" class="card-text d-flex justify-content-center">
                                        {{ isset($notinterested) ? $notinterested : 0 }}</h3></td>
                                <td class="bodytable"><h3 id="notanswer" class="card-text d-flex justify-content-center">
                                        {{ isset($notanswer) ? $notanswer : 0 }}</h3></td>
                                <td class="bodytable"><h3 id="unavnotworkincomp" class="card-text d-flex justify-content-center">
                                        {{ isset($unavnotworkincomp) ? $unavnotworkincomp : 0 }}</h3></td>
                                <td class="bodytable"><h3 id="swoflibuwonuinnu" class="card-text d-flex justify-content-center">
                                        {{ isset($swoflibuwonuinnu) ? $swoflibuwonuinnu : 0 }}</h3></td>
                                <td class="bodytable"><h3 id="others" class="card-text d-flex justify-content-center">
                                        {{ isset($others) ? $others : 0 }}</h3></td>
                                <td class="bodytable"><h3 id="setappointment" class="card-text d-flex justify-content-center">
                                        {{ isset($setappointment) ? $setappointment : 0 }}</h3></td>
                            </tr>
                        </table> --}}
                        <div id="div1" class="row mt-5 mb-5 bottom-row" style="justify-content: center;">
                            <div class="card text-white bg-primary d-flex justify-content-center"
                                style="max-width: 10rem; font-size: smaller">
                                <div class="card-header" style="background: orange!important;height: 4rem;border-radius:0!important"><span class="sp">Total calls</span></div>
                                <div class="card-body" style="color: black;background-color: #fff;border-left: 1px solid #184d47;">
                                    <h3 id="total"  class="card-text d-flex justify-content-center">
                                    {{ isset($total) ? $total : 0 }}</h3>
                                </div>
                            </div>

                            <div class="card text-white d-flex justify-content-center"
                                style="max-width: 7rem; font-size: smaller">
                                <div class="card-header" style="background: orange!important;height: 4rem;border-radius:0!important"><span class="sp">Interested</span></div>
                                <div class="card-body" style="color: black; background-color: #fff">
                                    <h3 id="interested" class="card-text d-flex justify-content-center">
                                        {{ isset($interested) ? $interested : 0 }}</h3>
                                </div>
                            </div>
                            <div class="card text-white d-flex justify-content-center"
                                style="max-width: 10rem; font-size: smaller">
                                <div class="card-header" style="background: orange!important;height: 4rem;border-radius:0!important"><span class="sp">Not interested</span></div>
                                <div class="card-body" style="color: black;background-color: #fff">
                                    <h3 id="notinterested" class="card-text d-flex justify-content-center">
                                        {{ isset($notinterested) ? $notinterested : 0 }}</h3>
                                </div>
                            </div>
                            <div class="card text-white d-flex justify-content-center"
                                style="max-width: 10rem; font-size: smaller">
                                <div class="card-header" style="background: orange!important;height: 4rem;border-radius:0!important"><span class="sp">Not answer</span></div>
                                <div class="card-body" style="color: black;background-color: #fff">
                                    <h3 id="notanswer" class="card-text d-flex justify-content-center">
                                        {{ isset($notanswer) ? $notanswer : 0 }}</h3>
                                </div>
                            </div>
                            <div class="card text-white d-flex justify-content-center"
                                style="max-width: 28rem; font-size: smaller">
                                <div class="card-header" style="background: orange!important;height: 4rem;border-radius:0!important"><span class="sp">Number unavailable/Not working for
                                    call/Incomplete no</span></div>
                                <div class="card-body" style="color: black;background-color: #fff">
                                    <h3 id="unavnotworkincomp" class="card-text d-flex justify-content-center">
                                        {{ isset($unavnotworkincomp) ? $unavnotworkincomp : 0 }}</h3>
                                </div>
                            </div>
                            <div class="card text-white d-flex justify-content-center"
                                style="max-width: 28rem; font-size: smaller">
                                <div class="card-header" style="background: orange!important;height: 4rem;border-radius:0!important"><span class="sp">Switch off/Line busy/Wrong
                                    number/Invalid
                                    number</span></div>
                                <div class="card-body" style="color: black;background-color: #fff">
                                    <h3 id="swoflibuwonuinnu" class="card-text d-flex justify-content-center">
                                        {{ isset($swoflibuwonuinnu) ? $swoflibuwonuinnu : 0 }}</h3>
                                </div>
                            </div>
                            <div class="card text-white d-flex justify-content-center"
                                style="max-width: 10rem; font-size: smaller">
                                <div class="card-header" style="background: orange!important;height: 4rem;border-radius:0!important"><span class="sp">Others</span></div>
                                <div class="card-body" style="color: black;background-color: #fff">
                                    <h3 id="others" class="card-text d-flex justify-content-center">
                                        {{ isset($others) ? $others : 0 }}</h3>
                                </div>
                            </div>

                            <div class="card text-white d-flex justify-content-center"
                                style="max-width: 10rem; font-size: smaller">
                                <div class="card-header" style="background: orange!important;height: 4rem;border-radius:0!important"><span class="sp">Set appointment</span></div>
                                <div class="card-body" style="color: black;background-color: #fff;border-right: 1px solid #184d47;">
                                    <h3 id="setappointment" class="card-text d-flex justify-content-center">
                                        {{ isset($setappointment) ? $setappointment : 0 }}</h3>
                                </div>
                            </div>
                        </div>

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

    <script>
        $(document).ready(function() {

            function getcommentsinfo() {
                // get comments data
                $.ajax({
                    url: "{{ route('get_admin_follow_up_data_comments_info') }}",
                    dataType: "json",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        "userstatus": $('#userstatus').val(),
                        // "datasource": $('#datasource').val()
                    },
                    success: function(result) {
                        $("#swoflibuwonuinnu").text(result.swoflibuwonuinnu);
                        $("#unavnotworkincomp").text(result.unavnotworkincomp);
                        $("#others").text(result.others);
                        $("#interested").text(result.interested);
                        $("#notinterested").text(result.notinterested);
                        $("#notanswer").text(result.notanswer);
                        $("#setappointment").text(result.setappointment);
                        $("#total").text(result.total);
                    }
                })
            }
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
                    "url": "{{ route('show_follow_up_data_comments') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        return $.extend({}, d, {
                            _token: "{{ csrf_token() }}",
                            "userstatus": $('#userstatus').val(),
                            // "datasource": $('#datasource').val()
                        });
                    },
                    beforeSend: function() {
                        $("#parent").LoadingOverlay("show", {
                            background: "rgba(78, 115, 223, 0.5)"
                        });
                    },
                    complete: function() {
                        $("#parent").LoadingOverlay("hide", true);
                        getcommentsinfo();
                    },
                    error: function(res) {
                        console.log(res);
                    },
                },
                "columns": [{
                        data: 'name',
                        name: 'name',
                        width: 300
                    },
                    {
                        data: 'comments',
                        name: 'comments',
                        width: 400
                    },
                    {
                        data: 'userstatus',
                        name: 'userstatus',
                        width: 400
                    },
                    {
                        data: 'email',
                        name: 'email',
                        width: 200
                    },
                    {
                    data: 'phone',
                    name: 'phone',
                    width: 250,

                },
                {
                    data: 'mobile',
                    name: 'mobile',
                    width: 250,

                },
                {
                    data: 'phone_whatsapp',
                    name: 'phone_whatsapp',
                    width: 250,
                    render: function(data) {
                        if (data != "-" && data != null && data != "") {
                            return data + '&nbsp&nbsp <a class="wat" href="https://wa.me/' + data +
                                '" target="_blank"><i class="fab fa-whatsapp fa-x"></i></a>';
                        } else
                            return data;
                    }
                },
                    {
                        data: 'title',
                        name: 'title',
                        width: 500
                    },
                    {
                        data: 'number_of_beds',
                        name: 'number_of_beds',
                        width: 100
                    },
                    {
                        data: 'project',
                        name: 'project',
                        width: 200
                    },
                    {
                        data: 'source',
                        name: 'source',
                        width: 200
                    },
                    {
                        data: 'created_by',
                        name: 'created_by',
                        width: 200
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        width: 250
                    }
                ],
                "lengthMenu": [
                    [100, 500, 1000, 2000, 5000, 10000],
                    [100, 500, 1000, 2000, 5000, 10000],
                ],
                "language":{
                    searchPlaceholder:"Type and press Enter"
                },
                "dom": 'Blftip',
                "buttons": [{
                        "extend": 'excel'
                    },
                    {
                        "extend": 'csv',
                    }
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

            $('#userstatus').change(function() {
                $("#alertdata").empty();
                $('#dataTable').data("dt_params", {
                    _token: "{{ csrf_token() }}",
                    "userstatus": $('#userstatus').val(),
                    // "datasource": $('#datasource').val()
                }, );
                $('#dataTable').DataTable().draw();
            });

            // $('#datasource').change(function() {
            //     $("#alertdata").empty();
            //     $('#dataTable').data("dt_params", {
            //         _token: "{{ csrf_token() }}",
            //         "userstatus": $('#userstatus').val(),
            //         "datasource": $('#datasource').val()
            //     }, );
            //     $('#dataTable').DataTable().draw();
            // });

        });
    </script>


    <!-- jQuery library -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script>
        $(document).ready(function() {

            $('div#emirates').show();
            $('div#usage').hide();
            $('div#nationality').hide();

        });
    </script>

    <script>
        $(document).bind("contextmenu", function(e) {
            return false;
        });

        $(document).keydown(function(event) {
            $("#alertdata").attr('hidden', true);
            $("#alertdata").empty();
            if (event.ctrlKey == true && (event.which == '118' || event.which == '86' || event.which == '67' ||
                    event.which == '88')) {
                $("#alertdata").attr('hidden', false);
                $("#alertdata").append(
                    "<div class= 'alert alert-danger'> you cannot copy paste move </div>");
                event.preventDefault();
            }
        });
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
        integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous">
    </script>

@endpush
