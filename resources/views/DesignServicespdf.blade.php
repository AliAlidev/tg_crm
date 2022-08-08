<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        html {
           scroll-behavior: smooth
        }

       * {
            outline: 0 !important;
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }




     .section-header{
        margin-top: 4rem;
     }
     .section-header img{
         width: 250px;
         margin-bottom: 1rem;
     }
     .section-header .first-culom{
         padding-left: 5rem;
     }
     .section-header .second-culom{
         padding-right: 2rem;
         padding-left: 5rem;
         font-family: 'Roboto-Medium';
     }
     .section-header .second-culom h1{
       color: #000;
       font-size: 53px;
       font-weight: 600;
     }
     .section-header .second-culom .line{
         border: 2px solid black;
         width: 46px
     }
     .section-header .second-culom .date{
         display: flex;
         margin-top: 1.5rem;
         align-items: center;
     }
     .section-header .second-culom .date input{
         border: unset;
         padding-left: 1rem;
         color: #BDC5C5;
     }
     .date p{
        display: inline-block;
     }
     .section-header .second-culom .LPONO{
         display: flex;
         align-items: center;
         margin-top: 6px;
     }
     .section-header .second-culom .LPONO .numder{
         padding-left: 10px;
     }
     .section-header .first-culom p{
       font-size: 15px;
       margin-bottom: 2px;
       font-family: 'Roboto-Medium';
     }
     .section-header .date p{
       align-items: center;
       margin-bottom: 0;
     }

     .section-body {
       margin-top: 4.5rem;
       padding: 0 3rem;
     }
     table {
         font-family: arial, sans-serif;
         border-collapse: collapse;
         width: 100%;
     }

      td, th {
        /* border: 1px solid #dddddd; */
        text-align: center;
        padding: 15px;
      }
      .section-body .colored1 td{
        padding: 15px;
        font-family: 'Roboto-Light';
      }
      .section-body .colored2 td {
        padding: 10px;
        font-family: 'Roboto-Light';
      }
      .section-body .first{
        background-color:  #7A848B;
        font-family: 'Roboto-Bold';
        color: white;
      }
     .section-body .colored1{
       background-color: white;
       font-family: 'Roboto-Light';
     }
     .section-body .colored2{
       background-color: #BDC5C5;
       font-family: 'Roboto-Light';
     }
     .section-body  .note{
       background-color: #BDC5C5;
       border-top: 4px solid #FAA61A;

     }
     .section-body  .note td{
       font-family: 'Roboto-Bold';
       text-align: left;
       padding: 10px;
       /* color: #331A0D; */
     }
     .section-body .desc p{
     margin-bottom: 0;
     font-family: 'Roboto-Light';
     text-align: left;
      }
      .section-body .desc{
        padding-left: 1rem;
        font-family: 'Roboto-Regular';
        border-bottom: 4px solid #FAA61A;
        color: #7A848B;
        font-weight: bold;
      }
      .section-body .desc td{
        padding: 0 15px;
      }

      .section-body .total-price{
        display: flex;
        justify-content: end;
        margin-top: 1rem;
        margin-bottom: 1.4rem;
      }
       .box{
        display: flex;
        border: 1px solid #7a848b;
        background-color: #7a848b;
        margin-bottom: 0;
        color: white;
        /* font-family: 'Roboto-Medium'; */
        align-items: center;
        padding: 6px 18px;
      }
           .box p:first-child{
            /* font-family: 'Roboto-Bold'; */
            padding-right: 10px;
          }
           .box p{
            margin-bottom: 0;
          }

          .section-body .customer-info{
            display: flex;
            font-family: 'Roboto-Medium';
            justify-content: space-around;
          }
          .section-body .customer-info p{
            border-bottom: 2px solid black;
            border-bottom-style: dotted;
            width: 142px;
            text-align: center;
            font-size: 14px;
            padding-bottom: 1.5rem;
          }

          .bank-details{
        /* padding: 0 3rem; */
        width: 90%;

        background-size:contain;
        background-repeat:no-repeat;
         background-position:bottom right;
         background-origin:border-box;

        height: 40%;
        background-image: url('{{ storage_path('app/public/footer.jpg') }}');
         margin: auto;
          }

          .bank-details h2{
            font-family: 'Roboto-Medium';
            font-size: 18px;
            border-bottom: 4px solid #FAA61A;
            margin-top: 15px;
            font-weight: 600;
            padding-bottom: 8px;
            margin-bottom: 16px;
          }
          .bank-details .group{
            display: flex;
            padding-left: 2px;
            line-height: 15px;
            /* justify-content: space-between; */
          }
          .bank-details .group p:first-child{
            font-family: 'Roboto-Bold';
            width: 190px;
            font-size: 15px;
          }
          .bank-details .group .second{
            padding-left: 10rem;
            font-family: 'Roboto-Regular';
            font-size: 15px;

          }
          .bank-details img{
            width: 400px;
            float: right;
            margin-top: -5rem;
          }

          input[type="date"]::-webkit-inner-spin-button,
          input[type="date"]::-webkit-calendar-picker-indicator {
              display: none;
              -webkit-appearance: none;
          }
          .col-lg-6{-ms-flex:0 0 50%;max-width:40%}
          .col-md-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:40%}
          .container,.container-fluid{
               width:100%;
               padding-right:var(--bs-gutter-x,.75rem);
               padding-left:var(--bs-gutter-x,.75rem);
               margin-right:auto;
               margin-left:auto
           }
           .row{
            display:block;

            margin-right:-15px;
            margin-left:-15px}

            .section-body table tr .b{
    word-wrap: break-word;
  }





    </style>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    {{-- <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" integrity="sha512-PgQMlq+nqFLV4ylk1gw UOgm6CtIIXkKwaIHp/PAIWHzig/lKZSEGKEysh0TCVbHJXCLN7WetD8TFecIky75ZfQ==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />

    <link rel="stylesheet" type="text/css" href="{{  storage_path('bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ storage_path('index.css') }}" />


    <link rel="stylesheet" type="text/css" href="css/animate.css" /> --}}



</head>


<body >
    <div class="header"></div>

    <div class="section-header" style="margin-left: -30px">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 first-culom">
                    <img  src="{{ public_path("Logo.png") }}" style="width: 400px; height: 100px">
                    <h4>Thom and Gery Building Contracting L.L.C</h4>
                    <p>Lake Central Tower,Office 1208 ,Business Bay
                    </p>
                    <p style="width: 500px">Dubai,United Arab Emirates-info@thomandgery.com
                    </p>
                    <p style="margin:10px">
                        <span style="font-weight: bold;">Client:</span>
                        @if($project->client)
                            {{$project->client}}
                        @else
                            N/A
                        @endif
                    </p>
                    <p style="margin:10px">
                        <span style="font-weight: bold;">Project:</span>
                        @if($project->name)
                            {{$project->name}}
                        @else
                            N/A
                        @endif
                    </p>
                    <p style="margin:10px">
                        <span style="font-weight: bold;">Description:</span>
                        @if($project->description)
                            {{$project->description}}
                        @else
                            N/A
                        @endif
                    </p>
                </div>
                <div style="float: right;width:25%;margin_top:-220px" class="col-lg-6 col-md-6 second-culom">
                    <h3>Design Services</h3>
                    <h6 style="margin_top:40px">
                        @if($project->code)
                            {{$project->code}}
                        @else
                            N/A
                        @endif
                    </h6>
                        <p style="margin-top:30px">
                            <span><b>date:</b>{{$day}}</span>

                        </p>
                </div>
            </div>
        </div>
    </div>
    <div class="section-body" style="margin_top:-5px;height: auto;">
        <div class="container">

                <div class="row" style="background-color:  #7A848B;padding:10px;border:1px solid #000">
                    Stage A: Preliminary/Concept Design
                </div>
                <div class="row " style="padding-left:20px;border:1px solid #000">
                    <ol type="I" style="margin-left:30px">
                     @if($designserver->stage_a)
                            @foreach ($stage_as as $stage_a)
                                <li>
                                    @php
                                            echo $stage_a;
                                    @endphp
                                </li>
                            @endforeach
                        @else
                            N/A
                        @endif
                    </ol>
                </div>
                <div class="row " style="background-color:  #7A848B;padding:10px;border:1px solid #000">
                    Stage B: Detall & Construction Design
                </div>
                <div class="row" style="padding-left:20px;border:1px solid #000;height: auto;">
                    <ol type="I" style="margin-left:30px">
                        @if($designserver->stage_b)
                               @foreach ($stage_bs as $stage_b)
                                   <li>@php
                                            echo $stage_b;
                                            @endphp</li>
                               @endforeach
                           @else
                               N/A
                           @endif
                       </ol>
                </div>
                        <div class="row" style="background-color:  #7A848B;padding:10px;border:1px solid #000"">
                            Stage C: Markating Research/ Construction Tendering
                        </div>
                        <div class="row " style="padding-left:20px;border:1px solid #000;height: auto;">
                            <ol type="I" style="margin-left:30px">
                                @if($designserver->stage_c)
                                       @foreach ($stage_cs as $stage_c)
                                           <li>@php
                                            echo $stage_c;
                                            @endphp</li>
                                       @endforeach
                                   @else
                                       N/A
                                   @endif
                               </ol>
                        </div>

                        <div >
                        <div class="row " style=";background-color:  #7A848B;padding:10px;border:1px solid #000">
                            Stage D:  Markating Research/ Construction Tendering
                        </div>

                        <div class="row"style="padding-left:20px;border:1px solid #000;height: auto;">
                            <ol type="I" style="margin-left:30px">
                                @if($designserver->stage_d)
                                       @foreach ($stage_ds as $stage_d)
                                           <li>
                                            @php
                                            echo $stage_d;
                                            @endphp
                                        </li>
                                       @endforeach
                                   @else
                                       N/A
                                   @endif
                               </ol>
                        </div>
                        <div class="row" style=";border:1px solid #000">
                            <span style=";width:75%;display:inline-block;text-align:right;background-color:  #7A848B;">
                             Subtotal
                            </span>
                            <span style="margin-top:5px;display:inline-block;width:15%">AED</span>
                            <span class="ml-5" style="margin-top:5px;display:inline-block">
                             @if($designserver->Subtotal)
                                 {{$designserver->Subtotal}}
                             @else
                                 N/A
                             @endif
                            </span>
                         </div>
                         <div class="row " style="padding:0px;border:1px solid #000">
                              <span style="margin-top:5px;width:75%;display:inline-block;text-align:right;background-color:  #7A848B;">VAT 5%</span>
                             <span style="margin-top:5px;display:inline-block;width:15%">AED</span>
                             <span class="ml-5" style="margin-top:5px;display:inline-block">
                              @if($designserver->vat)
                                  {{$designserver->vat}}
                              @else
                                  N/A
                              @endif
                             </span>
                          </div>
                          <div class="row " style="border:1px solid #000">
                             <span style="margin-top:5px;width:75%;display:inline-block;text-align:right;background-color:  #7A848B;">
                                 Grand Total
                             </span>
                             <span style="margin-top:5px;width:15%;display:inline-block">AED</span>
                             <span style="margin-top:5px;display:inline-block; margin-right:10px" class="ml-5">
                              @if($designserver->grand_total)
                                  {{$designserver->grand_total}}
                              @else
                                  N/A
                              @endif
                             </span>
                          </div>
                    </div>


        </div>
        <div   style="margin:5px;height: 60px !important;background-color:#fff"></div>
        <div class="container"style=";margin-left: -20px;margin-top:60px">
            <h2>Payment Terms:</h2>
            <div class="group">
                <p class="second"style="margin_left:50px" >100% advance payment</p>
            </div>
        </div>
        <div class="container"style="margin:20px;margin-left: -20px">
            <h2>Bank Details:</h2>
            <div class="group">
                <p class="second" style="margin_left:50px" >
                THOM AND GERY BUILDING CONTRACTING L.L.C</p>
            </div>
            <div class="group">
                <p class="second" style="margin_left:50px">CURRENCY :AED</p>
            </div>

            <div class="group">
                <p class="second" style="margin_left:50px">BANK:ADIB</p>
            </div>
            <div class="group">
                <p class="second" style="margin_left:50px">CURRENCY ACCONT NUMBER:19036821</p>
            </div>



            <div class="group">
                <p class="second" style="margin_left:50px" >IBAN:AE80050000000019036821</p>
            </div>
            <div class="group">
                <p class="second" style="margin_left:50px" >BRANCH:Sheikh Zayed Road-DUBAI</p>
            </div>



            <div class="group">
                <p class="second"style="margin_left:50px" >SWIFT:ABDIAEAD</p>
            </div>
            <div class="container"style="margin-top:50px;margin-left: -5px">
                <h4>Date:</h4>
                <h4>Client Signature:</h4>
            </div>
            <div class="container" style="text-align:right;margin-top:20px">
                <hr width="400px" style="margin-left:300px">
                <p class="second" style="text-align:center;;display:inline-block;margin-left:20px;margin_top:10px" >
                    THOM AND GERY BUILDING CONTRACTING L.L.C</p>
            </div>

        </div>
    </div>
    </div>
    {{-- <div class="ب"></div>
     --}}
     {{-- <footer>

     </footer> --}}


























    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="js/jquery.morecontent.js"></script>
    <script src="js/wow.min.js"></script>









</body>

</html>
