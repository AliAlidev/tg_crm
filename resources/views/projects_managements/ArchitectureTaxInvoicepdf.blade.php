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
     /* table {
         font-family: arial, sans-serif;
         border-collapse: collapse;
         width: 100%;
     } */

      td, {
        /* border: 1px solid #dddddd; */
        /* text-align: center; */
        /* padding: 15px; */
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
            color:
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

            /* .section-body table tr .b{
    word-wrap: break-word;
  } */





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
    <div class="section-header" style="width: 90%;margin:auto" >
        <div class="container" >
            <div class="row">
                <div class="col-lg-6 col-md-6 first-culom" style="display: inline">
                    <img  src="{{ public_path("Logo.png") }}" style="width: 400px; height: 100px;margin_top:50px;" >
                </div>
                <div style="float: right;width:25%;;display:inline-block;margin_top:50px;" class="col-lg-6 col-md-6 second-culom">
                    <h3>Tax Invoice</h3>
                    <h3 style="">
                        @if($ArchitectureTaxInvoice->code)
                            {{$ArchitectureTaxInvoice->code}}
                        @else
                            N/A
                        @endif
                    </h3>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 first-culom"  style="display: inline">
                    <table border="" width="150px">
                    <thead>
                        <tr style="background-color:#000;color:orangered">
                            <th colspan="2" style="text-align: left">Contacts</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                        <tr class="row{{$contact->id}}">
                            <td class="th-sm">{{$contact->name}}</th>
                            <td class="th-sm">{{$contact->position}}</th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <table border="" width="250px" style="margin-left:160px;margin-top:-50px">
                    <thead>
                        <tr style="background-color:#000;color:orangered">
                            <th colspan="2" style="text-align: left">Project</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="row{{$contact->id}}">
                            <td class="th-sm">Project Name</th>
                            <td class="th-sm">{{$project->name}}</th>
                        </tr>
                        <tr class="row{{$contact->id}}">
                            <td class="th-sm">Date</th>
                            <td class="th-sm">{{$project->date}}</th>
                        </tr>
                        <tr class="row{{$contact->id}}">
                            <td class="th-sm">client</th>
                            <td class="th-sm">{{$project->client}}</th>
                        </tr>
                    </tbody>
                </table>
                <table border="" style="margin-left:420px;margin-top:-100px">
                    <thead>
                        <tr style="background-color:#000;color:orangered">
                            <th  style="text-align: left">Area</th>
                            <th  style="text-align: left">Amount in AED</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($material_and_furniture_lists as $material_and_furniture_list)
                        <tr >
                            <td width='130px' >{{$material_and_furniture_list->title}}</th>
                            <td >AED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$material_and_furniture_list->total}}</th>
                        </tr>
                        @endforeach
                        <tr >
                            <td width='130px' >Furniture Total</th>
                            <td >AED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if($cost != null){{$cost->furniture_total}}@endif</th>
                        </tr>
                        <tr >
                            <td width='130px' >Design Fee</th>
                            <td >AED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if($cost != null){{$cost->design_fee}} @endif</th>
                        </tr>
                        <tr >
                            <td width='130px' >Total Amount</th>
                            <td >AED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if($cost != null){{$cost->total_amount}} @endif</th>
                        </tr>
                        <tr >
                            <td width='130px' >VAT Fee</th>
                            <td >AED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if($cost != null){{$cost->vat_fee}} @endif</th>
                        </tr>
                        <tr >
                            <td width='130px' >Installation Fees</th>
                            <td >AED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if($cost != null) {{$cost->installation_fees}} @endif</th>
                        </tr>
                        <tr >
                            <td width='130px' >Grand Total</th>
                            <td >AED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if($cost != null) {{$cost->grand_total}} @endif</th>
                        </tr>
                    </tbody>
                </table>
                </div>
                <div style="display:inline" class="col-lg-6 col-md-6 second-culom">

                </div>
            </div>
        </div>
            <p style="margin-top:-150px;margin-left:-20px">Tell: +971 -4 569 3445</p>
            <p style="margin-left:-20px">Business Bay,Lake Contral Tower - Office 1208</p>
            <p style="margin-left:-20px">P.O.Box: 392801-Dubai-United Arab Emirates</p>
            <div style="height: 20px;background-color:#fff;width:50%"></div>
            <table border="" width="350px" style="margin-left:-20px">
                <tbody>
                    <tr>
                    <td style="background-color:#000;color:orangered;width:100px;text-align:center" rowspan="{{count($notes)}}">Note</td>
                    <td>
                        @foreach ($notes as $note)
                        <ul style="margin-left: 30px">
                            <li>
                                @php
                            echo $note;
                            @endphp

                            </li>
                            <hr>
                        </ul>

                        @endforeach
                    </td>
                    </tr>
                </tbody>
            </table>
        <div style="height: 20px;background-color:#fff"></div>

        <table   border="1" style="text-align: center" style="margin-left:-30px">
            <thead>
              <tr style="background-color:#000;color:orangered">
                  <th class="col-md-1">S.NO.</th>
                  <th class="col-md-2">Item Category</th>
                  <th class="col-md-1">Size</th>
                  <th class="col-md-3">Material Description</th>
                  <th class="col-md-4">image</th>
                  <th class="col-md-1">Unit</th>
                  <th class="col-md-1">QTY</th>
                  <th scope="col">Unit Price</th>
                  <th scope="col">Total Price</th>
              </tr>
          </thead>
            <tbody>
                @foreach ($material_and_furniture_lists as $material_and_furniture_list)
                <tr>
                    <td>1.{{$material_and_furniture_list->id}}</td>
                    <td style="text-align: left; font-weight: bolder; padding-left: 10px" colspan="8">{{$material_and_furniture_list->title}}</td>
                </tr>
                @foreach ($material_and_furniture_list->MaterialAndFurnitureListrow as  $key)
                <tr>
                    <td>{{$key->s_no}}</td>
                    <td>{{$key->item_category}}</td>
                    <td>{{$key->size}}</td>
                    <td>{{$key->material_description}}</td>
                    <td>
                        <img src="{{public_path($key->photo)}}" width=200 height=150 />
                    </td>
                    <td>{{$key->unit}}</td>
                    <td>{{$key->qty}}</td>
                    <td>{{$key->unit_price}}</td>
                    <td style="text-align:left">AED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$key->total_price}}</td>
                </tr>

                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:left">
                        Total
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:left">
                        AED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$material_and_furniture_list->total}}
                    </td>
                </tr>

                @endforeach

                <tr >
                    <td colspan="4"></td>
                    <td style="text-align:left;background-color:#7a848b" colspan="4" >Furniture Total</th>
                    <td style="text-align:left">AED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if($cost != null){{$cost->installation_fees}}@endif</th>
                </tr>
                <tr >
                    <td colspan="4"></td>
                    <td style="text-align:left;background-color:#7a848b" colspan="4" >Design Fee</th>
                    <td style="text-align:left">AED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if($cost != null){{$cost->design_fee}} @endif</th>
                </tr>
                <tr >
                    <td colspan="4"></td>
                    <td style="text-align:left;background-color:#7a848b" colspan="4">Total Amount</th>
                    <td style="text-align:left">AED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if($cost != null){{$cost->total_amount}} @endif</th>
                </tr>
                <tr >
                    <td colspan="4"></td>
                    <td style="text-align:left;background-color:#7a848b" colspan="4" >VAT Fee</th>
                    <td style="text-align:left">AED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if($cost != null){{$cost->vat_fee}} @endif</th>
                </tr>
                <tr >
                    <td colspan="4"></td>
                    <td style="text-align:left;background-color:#7a848b" colspan="4" >Installation Fees</th>
                    <td style="text-align:left">AED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if($cost != null) {{$cost->installation_fees}} @endif</th>
                </tr>
                <tr >
                    <td colspan="4"></td>
                    <td style="text-align:left;background-color:#7a848b" colspan="4" >Grand Total</th>
                    <td style="text-align:left">AED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if($cost != null) {{$cost->grand_total}} @endif</th>
                </tr>
            </tbody>
        </table>
        <div style="height: 310px;background-color:#fff"></div>
            <h2 style="background-color:#7a848b">Terms & Conditions:</h2>

            <div class="group">
                @foreach ($terms as $term)
                        <ol style="margin-top:10px;margin-left:20px" type="1">
                            <li>
                                @php
                            echo $term;
                            @endphp

                            </li>
                        </ol>

                        @endforeach
            </div>
            <h2 style="background-color:#7a848b">Bank Details:</h2>
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




































</body>

</html>
