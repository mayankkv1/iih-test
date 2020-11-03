<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice View</title>
    <style>
        label{
            font-weight: bold;
        }
    </style>
</head>
<body>
        <div>
            <a href="{{ route('invoices.index') }}">Products</a>
        </div><br/><br/>

        <div>
            <div>
                <label>Customer Name: </label> {{$invoice->customer_name}}
            </div>
            <div>
                <label>Customer Email: </label> {{$invoice->customer_email}}
            </div>
            <div>
                <label>Product Name: </label> {{$invoice->product_name}}
            </div>
            <div>
                <label>Product Price: </label> {{$invoice->product_price}}
            </div>
            <div>
                <label>Discount: </label> {{$invoice->discount}}
            </div>
        </div>
</body>
</html>