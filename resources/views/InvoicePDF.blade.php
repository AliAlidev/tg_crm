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


      @font-face {
            font-family: 'Roboto-Bold';
            src: url('../fonts/Roboto-Bold.ttf')
        }
       @font-face {
            font-family: 'Roboto-Light';
            src: url('../fonts/Roboto-Light.ttf')
        }
       @font-face {
           font-family: 'Roboto-Medium';
           src: url('../fonts/Roboto-Medium.ttf')
       }
       @font-face {
           font-family: 'Roboto-Regular';
           src: url('../fonts/Roboto-Regular.ttf')
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


  /* responsive */
  @media(max-width:1900px){
    .bank-details img{
      margin-right: 25rem;
    }
  }
  @media(max-width:1800px){
    .bank-details img{
      margin-right: 21rem;
    }
  }
  @media(max-width:1700px){
    .bank-details img {
      margin-right: 19rem;
  }
  }
  @media(max-width:1600px){
    .bank-details img {
      margin-right: 17rem;
  }
  }
  @media(max-width:1500px){
    .bank-details img {
      margin-right: 17rem;
  }}
  @media(max-width:1400px){
    .bank-details img {
      margin-right: 7rem;
  }
  }
  @media(max-width:1350px){
    .bank-details img {
      margin-right: 7rem;
  }
  }
  @media(max-width:1300px){
    .bank-details img {
      margin-right: 7rem;
  }
  }
  @media(max-width:1200px){
    .bank-details img {
      margin-right: 3rem;
  }
  }
  @media(max-width:1199.5px){
    .bank-details img {
      margin-right: 8rem;
  }
  }
  @media(max-width:1100.5px){
    .bank-details img {
      margin-right: 5rem;
  }
  }
  @media(max-width:1024.5px){
    .bank-details img {
      margin-right: 3rem;
  }
  }
  @media(max-width:991.5px){
  .bank-details img {
    margin-right: 9rem;
}}
@media(max-width:900.5px){
  .bank-details img {
    margin-right: 6rem;
}
}
@media(max-width:850.5px){
  .bank-details img {
    margin-right: 5rem;
}
}
@media(max-width:800.5px){
  .bank-details img {
    margin-right: 3rem;
}
}
@media(max-width:750.5px){
  .bank-details .group .second{
    padding-left: 0rem;
  }
  .bank-details img {
    margin-right: 6rem;
}
}
    </style>

    {{-- <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVOICE</title>

    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" integrity="sha512-PgQMlq+nqFLV4ylk1gw UOgm6CtIIXkKwaIHp/PAIWHzig/lKZSEGKEysh0TCVbHJXCLN7WetD8TFecIky75ZfQ==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />--}}

    {{-- <link rel="stylesheet" type="text/css" href="{{  storage_path('bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ storage_path('index.css') }}" /> --}}


    {{-- <link rel="stylesheet" type="text/css" href="css/animate.css" />  --}}

</head>


<body>

    <div class="section-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 first-culom">
                    <a href="#">
                        <img src="{{ storage_path('app/public/Logo.png') }}">
                    </a>
                    <p>
                        @if($invoice->client_name)
                            {{$invoice->client_name}}
                        @else
                            N/A
                        @endif
                    </p>
                    <p>
                        @if($invoice->address1)
                            {{$invoice->address1}}
                        @else
                            N/A
                        @endif
                    </p>
                    <p>
                        @if($invoice->address2)
                            {{$invoice->address2}}
                        @else
                            N/A
                        @endif
                    </p>
                    <p>

                    @if($invoice->country)
                         {{$invoice->country}}
                     @else
                         N/A
                    @endif
                    </p>
                </div>
                <div style="float: right;width:50%;margin_top:-180px"  class="col-lg-6 col-md-6 second-culom">
                    <h1>INVOICE</h1>
                    <div class="line"></div>
                    <div class="date">
                        <p>Date:</p>
                        <p class="numder">
                            @if($invoice->date)
                                {{$invoice->date}}
                            @else
                                N/A
                           @endif

                        </p>

                        <!--  class="sdate" you can give it to previouse input to link it with calendar-->
                    </div>

                    <div class="date">
                        <p>L.P.O.N.O:</p>
                        <p class="numder">
                            @if($invoice->LPONO)
                                {{$invoice->LPONO}}
                            @else
                                N/A
                           @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="section-body">
        <div class="container">
            <table>
                <tr class="first">
                    <th>S.NO.</th>
                    <th>Qty</th>
                    <th>Product Description</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>

                <tr class="colored1">
                    @php
                $totalk=0;
                @endphp
                    @foreach ($items as $item )

            <tr class="colored1">

              <td >{{($item->serial_num) ? $item->serial_num : 'N/A' }}</td>
              <td > {{($item->quanttity ) ? $item->quanttity  : 'N/A' }} MONTH</td>
              <td >{{($item->description_item) ? $item->description_item  : 'N/A' }}</td>
              <td >{{($item->amount) ? $item->amount  :'N/A' }}</td>
              <td >{{($item->amount || $item->quanttity) ? $total=$item->amount * $item->quanttity  :'N/A' }}</td>
                   {{$totalk=$total+$totalk}}
            </tr>
            @endforeach

                <tr class="note">
                <td  colspan="5">Note: </td>
                </tr>

                <tr class="desc">
                    <td colspan="5">
                        <p></p>
                        <p>
                            @if($invoice->note)
                                 {{$invoice->note}}
                             @else
                                 N/A
                            @endif
                        </p>
                    </td>
                </tr>
            </table>



            <div class="total-price">
                <div class="box" style=" width:30%;margin-left:auto;">
                    <p >Total:</p>
                    <p>{{$totalk}}AED</p>
                </div>

            </div>

            <div style="float: left ;width:50% ;margin_left:50px"  class="customer-info" >
                <p> Client Name
            </p>

            </div>
            <div class="customer-info" style="float: right ;width:50% ;margin_left:50px">
                <p>Signature:</p>
            </div>
        </div>

    </div>
    <div class="bank-details" style="">
        <div class="container">
            <h2>Bank Details:</h2>
            <div class="group">
                <p>Account Name</p>
                <p class="second" style="margin-top:-20px">THOM AND GERY REAL ESTATE BROKERS</p>
            </div>

            <div class="group">
                <p style="margin-top:10px">Bank Name</p>
                <p class="second" style="margin-top:-20px">ADIB</p>
            </div>

            <div class="group">
                <p style="margin-top:10px">Bank Address</p>
                <p class="second" style="margin-top:-20px">SZ Road - Dubai</p>
            </div>

            <div class="group">
                <p style="margin-top:10px">IBAN Number</p>
                <p class="second" style="margin-top:-20px">AE480500000000018936905</p>
            </div>

            <div class="group">
                <p style="margin-top:10px">Currency of Remittance</p>
                <p class="second" style="margin-top:-20px">AED</p>
            </div>

            <div class="group">
                <p style="margin-top:10px">Swift Code</p>
                <p class="second" style="margin-top:-20px">ABDIAEAD</p>
            </div>
            {{-- <img src="{{ storage_path('app/public/footer.jpg') }}" width=100%;> --}}

        </div>

    </div>

















    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="js/jquery.morecontent.js"></script>
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>




<script>
    $(function() {
  $('.sdate').on('focus', function() {
    $(this).attr('type', 'date');
  });
  $('.sdate').on('blur', function() {
    if(!$(this).val()) { // important
      $(this).attr('type', 'text');
    }
  });
});
</script>



</body>

</html>
