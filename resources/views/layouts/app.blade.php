<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <style>
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
        * {
            margin: 0;
            padding: 0;
            user-select: none;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;

        }

        .sidebar {
            background-image: linear-gradient(to bottom, #211706, #291d0a, #30230c, #39290f, #412f10, #503913, #5f4416, #6e4f19, #88621f, #a37526, #be892c, #db9d33);
            position: fixed;
            width: 120%;
            height: 100%;
            left: 0;
        }

        .sidebar .text {
            color: white;
            font-size: 25px;
            font-weight: 600;
            line-height: 65px;
            text-align: center;
            background: transparent;
            letter-spacing: 1px;
        }

        nav ul {
            /* background-image: linear-gradient(to bottom, #184d47, #133944, #1d2532, #19151b, #000000); */
            height: 100%;
            width: 100%;
            list-style: none;
        }

        nav ul li {
            line-height: 60px;
            /* border-bottom: 1px solid rgb(255, 255, 255); */
        }

        nav ul li:last-child {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05)
        }

        nav ul li a {
            position: relative;
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding-left: 20px;
            font-weight: 500;
            display: block;
            width: 100%;
            border-left: 3px solid transparent;
        }

        nav ul li.active a {
            /* color: cyan; */
            /* background: #70cacc; */
            /* border-left-color: cyan; */
        }

        nav ul li.active ul li a {
            color: #e6e6e6;
            /* background: #70cacc; */
            border-left-color: transparent;
        }

        nav ul ul li a:hover {
            color: #fff!important;
            background: transparent!important;
        }

        nav ul ul {
            position: static;
            display: none;
        }

        nav ul .leads-show.show {
            display: block;
            height: 28rem;
            overflow-y: scroll;
            width: 100%;
            border-radius: 5px 5px 5px 0;
            box-shadow:0px -3px 3px -1px #bb912e, 2px 0 5px -1px #bb912a;
            background-image: linear-gradient(to bottom, #211706, #291d0a, #30230c, #39290f, #412f10, #503913, #5f4416, #6e4f19, #88621f, #a37526, #be892c, #db9d33);
        }

        nav ul .asd-show.show {
            display: block;
            height: 28rem;
            overflow-y: scroll;
            width: 100%;
            border-radius: 5px 5px 5px 0;
            box-shadow: 0px -3px 3px -1px #bb912e, 2px 0 5px -1px #bb912a;
            background-image: linear-gradient(to bottom, #211706, #291d0a, #30230c, #39290f, #412f10, #503913, #5f4416, #6e4f19, #88621f, #a37526, #be892c, #db9d33);
        }

        nav ul .report-show.show {
            display: block;
            height: 28rem;
            overflow-y: scroll;
            width: 100%;
            border-radius: 5px 5px 5px 0;
            box-shadow: 0px -3px 3px -1px #bb912e, 2px 0 5px -1px #bb912a;
            background-image: linear-gradient(to bottom, #211706, #291d0a, #30230c, #39290f, #412f10, #503913, #5f4416, #6e4f19, #88621f, #a37526, #be892c, #db9d33);
        }

        nav ul .au-show.show {
            display: block;
            height: 28rem;
            overflow-y: scroll;
            width: 100%;
            border-radius: 5px 5px 5px 0;
            box-shadow: 0px -3px 3px -1px #bb912e, 2px 0 5px -1px #bb912a;
            background-image: linear-gradient(to bottom, #211706, #291d0a, #30230c, #39290f, #412f10, #503913, #5f4416, #6e4f19, #88621f, #a37526, #be892c, #db9d33);
        }
        nav ul .sups1.show {
            display: block;
            height: 28rem;
            overflow-y: scroll;
            width: 100%;
            border-radius: 5px 5px 5px 0;
            box-shadow: 0px -3px 3px -1px #bb912e, 2px 0 5px -1px #bb912a;
            background-image: linear-gradient(to bottom, #211706, #291d0a, #30230c, #39290f, #412f10, #503913, #5f4416, #6e4f19, #88621f, #a37526, #be892c, #db9d33);
        }

        nav ul .pm-show.show {
            display: block;
            height: 28rem;
            overflow-y: scroll;
            width: 100%;
            border-radius: 5px 5px 5px 0;
            box-shadow:0px -3px 3px -1px #bb912e, 2px 0 5px -1px #bb912a;
            background-image: linear-gradient(to bottom, #211706, #291d0a, #30230c, #39290f, #412f10, #503913, #5f4416, #6e4f19, #88621f, #a37526, #be892c, #db9d33);
        }

        nav ul .pro-show.show {
            display: block;
            height: 28rem;
            overflow-y: scroll;
            width: 100%;
            border-radius: 5px 5px 5px 0;
            box-shadow:0px -3px 3px -1px #bb912e, 2px 0 5px -1px #bb912a;
            background-image: linear-gradient(to bottom, #211706, #291d0a, #30230c, #39290f, #412f10, #503913, #5f4416, #6e4f19, #88621f, #a37526, #be892c, #db9d33);
        }

        nav ul ul li {
            line-height: 42px;
            border-bottom: none;
        }

        nav ul ul li a {
            font-size: 14px;
            color: #e6e6e6;
            padding-left: 25px;
        }
        #wrapper {
           height: inherit;
        }

        nav ul li a span {
            /* position: absolute;
    top: 10px;
    right: 14px; */
    /* transform: translate(-50%); */
    font-size: 12px;
        }

        nav ul li a span.rotate {
            transform: translate(-50%) rotate(-180deg);
        }

        .selected {
            color: #fff;
            padding-left: 20px!important;
            border-left:2px solid #FFB400;
        }

        #sbitem1 .link-content,#sbitem2 .link-content,#sbitem3 .link-content,#sbitem4 .link-content, #sbitem5 .link-content, #sbitem6 .link-content, #sbitem7 .link-content{
              height: 4rem;
              padding: 9px 20px;
              align-items: center;
              display:flex;
            }
        /* .link-content span{
            position: absolute!important;
            top: 29px!important;
        } */
        .left-title{width:90%;font-size:16px;font-family: 'Lato-Semibold'!important;}
        .icon-title{width:10% ; text-align:right;}
        a:hover{color:#fff!important}
        .sidebar-brand-icon{width:100%;display: flex;align-items: center;height: 4rem;}
        .user-name{width:45%;font-size:16px;font-family: 'Lato-Semibold'!important;color:#d0d5dc
        ;line-height: 1.2;padding-top: 0px;}
        .user-img{width:55%!important;    object-fit: cover;height: 4rem;}
        #sbitem1_1 a,#sbitem1_2 a,#sbitem1_3 a,#sbitem1_4 a,#sbitem1_5 a,#sbitem1_6 a,#sbitem1_7 a,#sbitem1_8 a,#sbitem1_9 a{
            font-size:12px;font-family: 'Lato-Semibold'!important;
        }
        .show li.active a{
            color: #e1e0df;
            background:#776239;
        }
        #wrapper{
            background: url(img/bg0.png);
            background-size: cover;
            background-repeat: no-repeat;
            /* background-position: bottom; */
        }
        footer.sticky-footer{
            display:none;
        }
       @media (min-width: 1470px){
.sidebar {
    width: 17.5rem!important;
}}
        @media(max-width:1280px) and (min-width:1201px){
            /* .top-title{
                    margin-left: 7px!important;
            } */
        }
        @media(max-width:1200px) and (min-width:1100px){
          .full-content{
            padding: 0 0 0 2.5rem!important;
         }
         #bg-top{
            margin-left: -4rem!important;
         }
        }
    @media(max-width:1024px){
    .top-title{
        padding: 14px 16px!important;
        font-size: 16px;
    }
    .sidebar {
    width: 12rem!important;
     }
      .left-title{
                line-height: 1;
            }
    .user-name{
        line-height: 1.2;
        width: 90%;
    }
    #sbitem6 .link-content,#sbitem1 .link-content, #sbitem2 .link-content, #sbitem3 .link-content, #sbitem4 .link-content, #sbitem5 .link-content, #sbitem6 .link-content{
        padding: 9px 7px;
    }
    .left-title{
        font-size: 13px;
    }
 }
        @media(max-width:768px){

            .sidebar {
    width: 9rem!important;
     }
    .sidebar .sidebar-brand {
    height: auto;
    }
    .sidebar-brand-icon{
        display: grid;
        justify-content: center;
        margin-top: 2rem;
    }
        }
        @media(max-width:500px){

                /*sidebar mobile */
    .sidebar{
        width: 6.5rem!important;
    }
    .sidebar .sidebar-brand {
    height: auto;
    }
    .sidebar-brand-icon{
        display: grid;
        justify-content: center;
    }
    .user-name {
    width: 100%;
    }
    nav ul li {
    line-height: 7px!important;
    }
    nav ul .pm-show.show{
       height: 8rem;
    }
    nav ul .asd-show.show{
            height: 22rem;
    overflow-y: scroll;
    overflow-x: hidden;
    }
    nav ul .au-show.show{
        height: 15rem;
    }
    #sbitem6 .link-content,#sbitem1 .link-content, #sbitem2 .link-content, #sbitem3 .link-content, #sbitem4 .link-content, #sbitem5 .link-content, #sbitem6 .link-content
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
    #sbitem7_1,#sbitem7_3,#sbitem7_4,#sbitem7_5{
        line-height: 17px!important;
        margin-bottom: 10px;
    }
    #sbitem1_1 a,#sbitem1_2 a,#sbitem1_3 a,#sbitem1_4 a,#sbitem1_5 a,#sbitem1_6 a,#sbitem1_7 a,#sbitem1_8 a,#sbitem1_9 a

        {
            padding-left: 15px!important;
            font-size: 12px!important;
        }
        #sbitem7_1 a,#sbitem7_3 a,#sbitem7_4 a,#sbitem7_5 a

        {
            padding-left: 15px!important;
            font-size: 12px!important;
        }
    #sbitem2_1,#sbitem2_2,#sbitem2_3,#sbitem2_4,#sbitem2_4_1,#sbitem2_5,#sbitem2_6,#sbitem2_7,#sbitem2_7_1,#sbitem2_8,#sbitem2_9,#sbitem2_10,#sbitem2_11{
        line-height: 17px!important;
        margin-bottom: 10px!important;
    }
    #sbitem2_1 a,#sbitem2_2 a,#sbitem2_3 a,#sbitem2_4 a,#sbitem2_4_1 a,#sbitem2_5 a,#sbitem2_6 a,#sbitem2_7 a,#sbitem2_7_1 a,#sbitem2_8 a,#sbitem2_9 a,#sbitem2_10 a,#sbitem2_11 a

        {
            padding-left: 15px!important;
            font-size: 12px!important;
        }
    #sbitem3_1,#sbitem3_2,#sbitem3_3,#sbitem3_4,#sbitem3_5,#sbitem3_6{
        line-height: 17px!important;
        margin-bottom: 10px!important;
    }
    #sbitem3_1 a,#sbitem3_2 a,#sbitem3_3 a,#sbitem3_4 a,#sbitem3_5 a,#sbitem3_6 a

        {
            padding-left: 15px!important;
            font-size: 12px!important;
        }
    #sbitem5_1,#sbitem5_2,#sbitem5_3,#sbitem5_4,#sbitem5_5,#sbitem5_6,#sbitem5_7{
        line-height: 17px!important;
        margin-bottom: 10px!important;
    }
    #sbitem5_1 a,#sbitem5_2 a,#sbitem5_3 a,#sbitem5_4 a,#sbitem5_5 a,#sbitem5_6 a,#sbitem5_7 a

        {
            padding-left: 15px!important;
            font-size: 12px!important;
        }
    #sbitem4_1,#sbitem4_2,#sbitem4_3,#sbitem4_4,#sbitem4_5,#sbitem4_6,#sbitem4_7,#sbitem4_1_1{
        line-height: 17px!important;
        margin-bottom: 10px!important;
    }
    #sbitem4_1 a,#sbitem4_2 a,#sbitem4_3 a,#sbitem4_4 a,#sbitem4_5 a,#sbitem4_6 a,#sbitem4_7 a,#sbitem4_1_1 a

        {
            padding-left: 15px!important;
            font-size: 12px!important;
        }
        .sidebar .sidebar-brand {
            height: 8.375rem!important;
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
.user-img{
    width:100%!important;
}

    }

    @media (max-width: 768px){
      .sidebar {
          width: 9rem!important;
        }
     #sbitem1_1 a, #sbitem1_2 a, #sbitem1_3 a, #sbitem1_4 a, #sbitem1_5 a, #sbitem1_6 a, #sbitem1_7 a, #sbitem1_8 a, #sbitem1_9 a{
          line-height: 2;
        }
   #sbitem2_1 a, #sbitem2_2 a, #sbitem2_3 a, #sbitem2_4 a, #sbitem2_5 a, #sbitem2_6 a, #sbitem2_7 a, #sbitem2_8 a, #sbitem2_9 a,#sbitem2_10 a, #sbitem2_11 a, #sbitem2_12 a{
          line-height: 2;
            padding-left: 13px;
            font-size: 12px;
        }
        .asd-show li a{
            line-height: 2;
            padding-left: 13px;
            font-size: 12px;
        }
        nav ul .asd-show.show{
            height: 25rem;
        }
        .report-show li a{
            line-height: 2;
            padding-left: 13px;
            font-size: 12px;
        }
        nav ul .pm-show.show{
            height: 16rem;
        }
        .pm-show li a{
            line-height: 2;
            padding-left: 13px;
            font-size: 12px;
        }
        .au-show li a{
            line-height: 2;
            padding-left: 13px;
            font-size: 12px;
        }
        .selected {
            padding-left: 15px!important;
        }
        .sidebar .sidebar-brand,.sidebar-brand-icon,.user-img{
            height: auto!important;
        }
        .user-img{
            width: 100%!important;
        }
        .sidebar .sidebar-brand{
            padding: 0rem 1rem;
        }
    }
    @media (max-width: 500px){
      .sidebar {
          width: 6.5rem!important;
        }
    .selected {
            padding-left: 8px!important;

        }
        .sidebar .sidebar-brand{
            padding: 5px!important;
        }
        .sidebar-brand-icon{
            margin-top:0!important;
        }
    }

    label{
        color:#211706!important;
    }

    </style>

    @stack('head')

</head>

<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div style="width: 20%; height: 100%;">
            @include('layouts.sidebar')
        </div>

        <div style="width: 80%;">
            @yield('wrapper_content')
        </div>

    </div>

    @yield('content')

    @stack('scripts')

    <script>
        $(window).on('load', function() {
            if (
                "{{ request()->route()->getName() }}" == 'follow_up_user_home_index' ||
                "{{ request()->route()->getName() }}" == 'show_follow_up_data_comments_index' ||
                "{{ request()->route()->getName() }}" == 'show_leads_pool_data_comments_index' ||
                "{{ request()->route()->getName() }}" == 'leads_pool_user_home_index' ||
                "{{ request()->route()->getName() }}" == 'show_qualified_data_comments_index' ||
                "{{ request()->route()->getName() }}" == 'qualified_user_home_index' ||
                "{{ request()->route()->getName() }}" == 'leads_pool_index' ||
                "{{ request()->route()->getName() }}" == 'won_leads_index' ||
                "{{ request()->route()->getName() }}" == 'dead_leads_index' ||
                "{{ request()->route()->getName() }}" == 'follow_up_index' ||
                "{{ request()->route()->getName() }}" == 'create_customer_index' ||
                "{{ request()->route()->getName() }}" == 'qualified_leads_index' ||
                "{{ request()->route()->getName() }}" == 'agent_data' ||
                "{{ request()->route()->getName() }}" == 'map' ||
                "{{ request()->route()->getName() }}" == 'agent_data' ||
                "{{ request()->route()->getName() }}" == 'index1' ||
                "{{ request()->route()->getName() }}" == 'home' ||
                "{{ request()->route()->getName() }}" == 'createlead'
            ) {
                $('#sbitem1').find('a:first').toggleClass('selected');
                if ("{{ request()->route()->getName() }}" == 'leads_pool_index')
                    $('#sbitem1_1').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'won_leads_index')
                    $('#sbitem1_2').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'dead_leads_index')
                    $('#sbitem1_3').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'qualified_leads_index')
                    $('#sbitem1_4').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'follow_up_index')
                    $('#sbitem1_5').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'create_customer_index')
                    $('#sbitem1_6').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'home')
                    $('#sbitem1_7').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'index1')
                    $('#sbitem1_7_1').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'agent_data')
                    $('#sbitem1_8').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'map')
                    $('#sbitem1_9').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'qualified_user_home_index')
                    $('#sbitem1_10').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'show_qualified_data_comments_index')
                    $('#sbitem1_11').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'leads_pool_user_home_index')
                    $('#sbitem1_12').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'show_leads_pool_data_comments_index')
                    $('#sbitem1_13').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'follow_up_user_home_index')
                    $('#sbitem1_14').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'show_follow_up_data_comments_index')
                    $('#sbitem1_15').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'createlead')
                $('#sbitem1_16').addClass('active');


                $('nav ul .leads-show').toggleClass('show');
                $('nav ul .asd-show').removeClass('show');
                $('nav ul .report-show').removeClass('show');
                $('nav ul .au-show').removeClass('show');
                $('nav ul .pm-show').removeClass('show');
                $('nav ul .sups1').removeClass('show');
                $('nav ul .pro-show').removeClass('show');
                $('nav ul .first').removeClass('rotate');
            } else if (
                "{{ request()->route()->getName() }}" == 'assign_agent_data_index' ||
                "{{ request()->route()->getName() }}" == 'assign_agent_qualified_data_index' ||
                "{{ request()->route()->getName() }}" == 'assign_agent_leads_pool_index' ||
                "{{ request()->route()->getName() }}" == 'assign_agent_follow_up_index' ||
                "{{ request()->route()->getName() }}" == 'show_assigned_agent_qualified_index' ||
                "{{ request()->route()->getName() }}" == 'show_assigned_agent_leads_pool_index' ||
                "{{ request()->route()->getName() }}" == 'show_assigned_agent_follow_up_index' ||
                "{{ request()->route()->getName() }}" == 'show_user_qualified_data_comments_index' ||
                "{{ request()->route()->getName() }}" == 'show_user_leads_pool_data_comments_index' ||
                "{{ request()->route()->getName() }}" == 'get_assigned_data_index' ||
                "{{ request()->route()->getName() }}" == 'show_commented_data' ||
                "{{ request()->route()->getName() }}" == 'show_user_follow_up_data_comments_index'
            ) {
                $('#sbitem2').find('a:first').toggleClass('selected');
                if ("{{ request()->route()->getName() }}" == 'assign_agent_data_index')
                    $('#sbitem2_1').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'assign_agent_qualified_data_index')
                    $('#sbitem2_2').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'assign_agent_leads_pool_index')
                    $('#sbitem2_3').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'assign_agent_follow_up_index')
                    $('#sbitem2_4').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'show_assigned_agent_qualified_index')
                    $('#sbitem2_5').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'show_assigned_agent_leads_pool_index')
                    $('#sbitem2_6').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'show_assigned_agent_follow_up_index')
                    $('#sbitem2_7').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'show_commented_data')
                    $('#sbitem2_7_1').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'show_user_qualified_data_comments_index')
                    $('#sbitem2_9').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'show_user_leads_pool_data_comments_index')
                    $('#sbitem2_10').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'get_assigned_data_index')
                    $('#sbitem2_4_1').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'show_user_follow_up_data_comments_index')
                    $('#sbitem2_11').addClass('active');

                $('nav ul .leads-show').removeClass('show');
                $('nav ul .asd-show').toggleClass('show');
                $('nav ul .report-show').removeClass('show');
                $('nav ul .au-show').removeClass('show');
                $('nav ul .pm-show').removeClass('show');
                $('nav ul .sups1').removeClass('show');
                $('nav ul .pro-show').removeClass('show');
                $('nav ul .second').toggleClass('rotate');
            } else if (
                "{{ request()->route()->getName() }}" == 'getcharts' ||
                "{{ request()->route()->getName() }}" == 'geochart' ||
                "{{ request()->route()->getName() }}" == 'leader_board_index'
            ) {
                $('#sbitem3').find('a:first').toggleClass('selected');
                if ("{{ request()->route()->getName() }}" == 'getcharts')
                    $('#sbitem3_1').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'geochart')
                    $('#sbitem3_2').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'leader_board_index')
                    $('#sbitem3_5').addClass('active');

                $('nav ul .leads-show').removeClass('show');
                $('nav ul .asd-show').removeClass('show');
                $('nav ul .report-show').toggleClass('show');
                $('nav ul .au-show').removeClass('show');
                $('nav ul .pm-show').removeClass('show');
                $('nav ul .sups1').removeClass('show');
                $('nav ul .pro-show').removeClass('show');
                $('nav ul .third').toggleClass('rotate');
            } else if (
                "{{ request()->route()->getName() }}" == 'create_user_index' ||
                "{{ request()->route()->getName() }}" == 'assign_agent_for_landing' ||
                "{{ request()->route()->getName() }}" == 'assign_agent_data_index' ||
                "{{ request()->route()->getName() }}" == 'list_users_index' ||
                "{{ request()->route()->getName() }}" == 'import_index' ||
                "{{ request()->route()->getName() }}" == 'uploadedFiles' ||
                "{{ request()->route()->getName() }}" == 'create_user_index' ||
                "{{ request()->route()->getName() }}" == 'update_user_index' ||
                "{{ request()->route()->getName() }}" == 'create_buyer_index'
            ) {
                $('#sbitem4').find('a:first').toggleClass('selected');
                if ("{{ request()->route()->getName() }}" == 'create_buyer_index')
                    $('#sbitem4_1_1').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'create_user_index')
                    $('#sbitem4_1').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'assign_agent_for_landing')
                    $('#sbitem4_2').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'list_users_index')
                    $('#sbitem4_3').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'import_index')
                    $('#sbitem4_4').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'uploadedFiles')
                    $('#sbitem4_5').addClass('active');
                // else if ("{{ request()->route()->getName() }}" == 'create_user_index')
                //     $('#sbitem4_6').addClass('active');
                // else if ("{{ request()->route()->getName() }}" == 'update_user_index')
                //     $('#sbitem4_7').addClass('active');

                $('nav ul .leads-show').removeClass('show');
                $('nav ul .asd-show').removeClass('show');
                $('nav ul .report-show').removeClass('show');
                $('nav ul .au-show').toggleClass('show');
                $('nav ul .sups1').removeClass('show');
                $('nav ul .pm-show').removeClass('show');
                $('nav ul .pro-show').removeClass('show');
                $('nav ul .fourth').toggleClass('rotate');
            } else if (
                "{{ request()->route()->getName() }}" == 'create_property_index' ||
                "{{ request()->route()->getName() }}" == 'create_contracts_index' ||
                "{{ request()->route()->getName() }}" == 'list_properties_index' ||
                "{{ request()->route()->getName() }}" == 'list_contracts_index' ||
                "{{ request()->route()->getName() }}" == 'create_invoices_index' ||
                "{{ request()->route()->getName() }}" == 'get_invoices_index'
            ) {
                $('#sbitem5').find('a:first').toggleClass('selected');
                if ("{{ request()->route()->getName() }}" == 'create_property_index')
                    $('#sbitem5_1').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'create_contracts_index')
                    $('#sbitem5_2').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'list_properties_index')
                    $('#sbitem5_3').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'list_contracts_index')
                    $('#sbitem5_4').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'create_invoices_index')
                    $('#sbitem5_5').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'get_invoices_index')
                    $('#sbitem5_6').addClass('active');

                $('nav ul .leads-show').removeClass('show');
                $('nav ul .asd-show').removeClass('show');
                $('nav ul .report-show').removeClass('show');
                $('nav ul .au-show').removeClass('show');
                $('nav ul .pm-show').toggleClass('show');
                $('nav ul .sups1').removeClass('show');
                $('nav ul .pro-show').removeClass('show');
                $('nav ul .fifth').toggleClass('rotate');
            }else if (
                "{{ request()->route()->getName() }}" == 'create_new_project_index' ||
                "{{ request()->route()->getName() }}" == 'architecture_projects_list_index' ||
                "{{ request()->route()->getName() }}" == 'civil_projects_list_index'
            ) {
                $('#sbitem6').find('a:first').toggleClass('selected');
                if ("{{ request()->route()->getName() }}" == 'create_new_project_index')
                    $('#sbitem6_1').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'architecture_projects_list_index')
                    $('#sbitem6_2').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'civil_projects_list_index')
                    $('#sbitem6_3').addClass('active');

                $('nav ul .leads-show').removeClass('show');
                $('nav ul .asd-show').removeClass('show');
                $('nav ul .report-show').removeClass('show');
                $('nav ul .au-show').removeClass('show');
                $('nav ul .pm-show').removeClass('show');
                $('nav ul .pro-show').toggleClass('show');
                $('nav ul .sixth').toggleClass('rotate');
            }
            else if (

                "{{ request()->route()->getName() }}" == 'create_Supplier' ||
                "{{ request()->route()->getName() }}" == 'list_Suppliers' ||
                "{{ request()->route()->getName() }}" == 'create_Supplier_invoice' ||
                "{{ request()->route()->getName() }}" == 'listSuppliersinvoice'

            ) {
                $('#sbitem7').find('a:first').toggleClass('selected');
                if ("{{ request()->route()->getName() }}" == 'create_Supplier')
                    $('#sbitem7_1').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'list_Suppliers')
                    $('#sbitem7_3').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'create_Supplier_invoice')
                    $('#sbitem7_4').addClass('active');
                else if ("{{ request()->route()->getName() }}" == 'listSuppliersinvoice')
                    $('#sbitem7_5').addClass('active');
                $('nav ul .leads-show').removeClass('show');
                $('nav ul .asd-show').removeClass('show');
                $('nav ul .report-show').removeClass('show');
                $('nav ul .au-show').removeClass('show');
                $('nav ul .pm-show').removeClass('show');
                $('nav ul .sups1').toggleClass('show');
                $('nav ul .Suppliers').toggleClass('rotate');
            }
        })
    </script>

    <script>
        $('.leads-btn').click(function() {
            $('nav ul .leads-show').toggleClass('show');
            $('nav ul .asd-show').removeClass('show');
            $('nav ul .report-show').removeClass('show');
            $('nav ul .au-show').removeClass('show');
            $('nav ul .sups1').removeClass('show');
            $('nav ul .pm-show').removeClass('show');
            $('nav ul .pro-show').removeClass('show');
            $('nav ul .first').removeClass('rotate');
        });
        $('.asd-btn').click(function() {
            $('nav ul .leads-show').removeClass('show');
            $('nav ul .sups1').removeClass('show');
            $('nav ul .asd-show').toggleClass('show');
            $('nav ul .report-show').removeClass('show');
            $('nav ul .au-show').removeClass('show');
            $('nav ul .pm-show').removeClass('show');
            $('nav ul .pro-show').removeClass('show');
            $('nav ul .second').toggleClass('rotate');
        });
        $('.report-btn').click(function() {
            $('nav ul .leads-show').removeClass('show');
            $('nav ul .asd-show').removeClass('show');
            $('nav ul .report-show').toggleClass('show');
            $('nav ul .sups1').removeClass('show');
            $('nav ul .au-show').removeClass('show');
            $('nav ul .pm-show').removeClass('show');
            $('nav ul .pro-show').removeClass('show');
            $('nav ul .third').toggleClass('rotate');
        });
        $('.au-btn').click(function() {
            $('nav ul .leads-show').removeClass('show');
            $('nav ul .asd-show').removeClass('show');
            $('nav ul .report-show').removeClass('show');
            $('nav ul .sups1').removeClass('show');
            $('nav ul .au-show').toggleClass('show');
            $('nav ul .pm-show').removeClass('show');
            $('nav ul .pro-show').removeClass('show');
            $('nav ul .fourth').toggleClass('rotate');
        });
        $('.pm-btn').click(function() {
            $('nav ul .leads-show').removeClass('show');
            $('nav ul .asd-show').removeClass('show');
            $('nav ul .sups1').removeClass('show');
            $('nav ul .report-show').removeClass('show');
            $('nav ul .au-show').removeClass('show');
            $('nav ul .pm-show').toggleClass('show');
            $('nav ul .pro-show').removeClass('show');
            $('nav ul .fifth').toggleClass('rotate');
        });
        $('.pmSuppliers').click(function() {
            $('nav ul .leads-show').removeClass('show');
            $('nav ul .asd-show').removeClass('show');
            $('nav ul .pm-show').removeClass('show');
            $('nav ul .report-show').removeClass('show');
            $('nav ul .au-show').removeClass('show');
            $('nav ul .sups1').toggleClass('show');
            $('nav ul .Suppliers').toggleClass('rotate');
        });
        $('.pro-btn').click(function() {
            $('nav ul .leads-show').removeClass('show');
            $('nav ul .asd-show').removeClass('show');
            $('nav ul .report-show').removeClass('show');
            $('nav ul .au-show').removeClass('show');
            $('nav ul .pm-show').removeClass('show');
            $('nav ul .pro-show').toggleClass('show');
            $('nav ul .sixth').toggleClass('rotate');
        });
        $('nav ul li').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
        });
    </script>
</body>

</html>
