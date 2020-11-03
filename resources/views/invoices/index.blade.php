<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoices</title>
    <style>
        label{
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div>
        <a href="{{ route('invoices.create') }}">Add new product</a>
    </div><br/><br/>

    <div>
        @if($invoices->isNotEmpty())
        <div>
            <table border="1">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Discount</th>
                        <th>View</th>
                        <th>Edit</th>
                    </tr>
                </thead>

                <body>
                    @foreach($invoices as $val)
                    <tr>
                        <td>{{$val->customer_name}}</td>
                        <td>{{$val->customer_email}}</td>
                        <td>{{$val->product_name}}</td>
                        <td>{{$val->product_price}}</td>
                        <td>{{$val->discount}}</td>
                        <td><a href='{{ route("invoices.show",$val->id) }}'>View</a></td>
                        <td><a href="{{ route('invoices.edit',$val->id) }}">Edit</a></td>
                    </tr>
                    @endforeach
                </body>

            </table>
        </div><br/><br/>
        @endif

        <div>
            <div>
                <label>Total Items: </label> {{$totalInvoices}}
            </div>
            <div>
                <label>Total Amount: </label> {{$totalAmount}}
            </div>
            <div>
                <label>Total Discount Amount: </label> {{$totalDiscount}}
            </div>
            <div>
                <label>Total Bill: </label> {{$totalBill}}
            </div>
        </div>
    </div>
</body>
</html>