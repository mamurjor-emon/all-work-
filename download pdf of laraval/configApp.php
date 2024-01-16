1.install this => 
composer require barryvdh/laravel-dompdf

2. config/app.php =>
 'providers' => [

	....

	Barryvdh\DomPDF\ServiceProvider::class,

],

  

'aliases' => [

	....

	'PDF' => Barryvdh\DomPDF\Facade::class,

]

3.add a route => 
Route::get('generate-pdf/{id}', [PDFController::class, 'generatePDF']);

4.this function => 
 public function generatePDF($id){
        $order_details = Invoice::where('id',$id)->get();
        $user = User::where('id',$order_details[0]->user_id)->get();
        $data = [
            'order_details' =>$order_details,
            'order_user' => $user,
        ];
        $pdf = PDF::loadView('client.pages.download.pdfdownload', $data);
        return $pdf->download('oneclicktable.com.pdf');
    }
	
5. this is a view => 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            background-color: #fff;
            margin: 0;
            padding: 0;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .container{
            width: 100%;
            margin-right: auto;
            margin-left: auto;
        }
        .brand-section{
           background-color: #0765e8;
           padding: 10px 40px;
        }
        .logo{
            width: 50%;
        }

        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-6{
            width: 50%;
            flex: 0 0 auto;
        }
        .text-white{
            color: #fff;
            text-align: center;
        }
        .company-details{
            float: right;
            text-align: right;
        }
        .body-section{
            padding: 16px;
            border: 1px solid rgb(231, 231, 231);
        }
        .heading{
            font-size: 20px;
            margin-bottom: 15px;
            margin-top: 35px;
        }
        .sub-heading{
            color: #262626;
            margin-bottom: 05px;
        }
        table{
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid #111;
            background-color: #f2f2f2;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
        }
        table th, table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .text-right{
            text-align: end;
        }
        .w-20{
            width: 20%;
        }
        .float-right{
            float: right;
        }
        .float-left{
            float: left;
        }
        .orderItems{
            margin-top: 180px;
        }

    </style>
</head>
<body>

    <div class="container">
        <div class="brand-section">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-white">ONE CLICK TABLE</h1>
                </div>
                <div class="col-6">
                    <div class="company-details">
                        {{-- <p class="text-white">assdad asd  asda asdad a sd</p>
                        <p class="text-white">assdad asd asd</p>
                        <p class="text-white">+91 888555XXXX</p> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row myInvoice">
            <div class="float-left">
                <h2 class="heading">Order Detalis</h2>
                <p class="sub-heading">Order Id. {{ $order_details[0]->order_id }}</p>
                <p class="sub-heading">Order Date: {{ $order_details[0]->created_at->format('Y-m-d') }}
                <p class="sub-heading">Package Name: {{ ucfirst($order_details[0]->package_name) }}
                <p>
                <p class="sub-heading">Order Status:
                    @if ($order_details[0]->status == 1)
                        On Working
                    @elseif ($order_details[0]->status == 2)
                        Canceled
                    @else
                        Complated
                    @endif
                </p>
            </div>
            <div class="userInformation float-right">
                <h2 class="heading">User Detalis</h2>
                <p class="sub-heading">Full Name: {{ $order_user[0]->fname . ' ' . $order_user[0]->lname }}</p>
                <p class="sub-heading">Email Address: {{ $order_user[0]->email }}</p>
                <p class="sub-heading">User Status:
                    @if ($order_user[0]->status == 1)
                        Pending
                    @elseif ($order_user[0]->status == 2)
                        Aproved
                    @elseif ($order_user[0]->status == 3)
                        Puse
                    @elseif ($order_user[0]->status == 4)
                        Resume
                    @elseif ($order_user[0]->status == 5)
                        Suspend
                    @else
                        Unsuspend
                    @endif
                </p>
                <p class="sub-heading">Phone Number: {{ $order_user[0]->phone ? $order_user[0]->phone : '---' }}
                </p>
            </div>
        </div>

        <div class="body-section orderItems">
            <h3 class="heading">Ordered Item</h3>
            <br>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Package Name </th>
                        <th class="w-20">Price</th>
                        <th class="w-20">Quantity</th>
                        <th class="w-20">Grandtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ ucfirst($order_details[0]->package_name) }}</td>
                        <td>
                            @if ($order_details[0]->price != '')
                            {{ '$'.$order_details[0]->price }}
                            @else
                            {{ '---' }}
                            @endif
                        </td>
                        <td>
                            @if ($order_details[0]->qty != '')
                            {{ $order_details[0]->qty }}
                            @else
                            {{ '---' }}
                            @endif
                        </td>
                        <td>
                            {{ $order_details[0]->total_amount }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>
            <h3 class="heading">Payment Status:
            @if ($order_details[0]->payment_type != '')
                Paid
            @else
              Free
            @endif</h3>
            <h3 class="heading">Payment Mothod:
                @if ($order_details[0]->payment_type != '')
              {{$order_details[0]->payment_type}}
            @else
             {{'---'}}
            @endif</h3>
        </div>

        <div class="body-section">
            <p>&copy; Copyright 2021 - One Click Table. All rights reserved.
                <a href="https://oneclicktable.com/" class="float-right">oneclicktable.com</a>
            </p>
        </div>
    </div>

</body>
</html>


6. request two download => 
<a href="{{ route('generate-pdf.index',$invoice->id) }}">
 <button class="btn btn-info btn-xm">Download</button></a>
 
 
 
 show image in pdf file 
 <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents($address->company_logo)) ?>">