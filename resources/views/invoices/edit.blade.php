<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Edit</title>
    <link rel="stylesheet" type="text/css" href="{{url('css/common.css')}}">
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
        <form id="update_prod_frm">
            {{ method_field('PUT') }}
            <div class="form-group"> 
                <label>Customer Name</label>
                <input type="text" class="form-control" name="customer_name" placeholder="Customer Name" value="{{$invoice->customer_name}}" required/>
            </div>

            <div class="form-group"> 
                <label>Customer Email</label>
                <input type="email" class="form-control" name="customer_email" placeholder="Customer Email" value="{{$invoice->customer_email}}" required/>
            </div>

            <div class="form-group"> 
                <label>Product Name</label>
                <input type="text" class="form-control" name="product_name" placeholder="Product Name" value="{{$invoice->product_name}}" required/>
            </div>

            <div class="form-group"> 
                <label>Product Price</label>
                <input type="number" class="form-control" step="0.01" name="product_price" placeholder="Product Price" value="{{$invoice->product_price}}" required/>
            </div>

            <div class="form-group"> 
                <label>Discount</label>
                <input type="number" class="form-control" name="discount" placeholder="Discount" value="{{$invoice->discount}}" required/>
            </div>
            {{csrf_field()}}
            <button type="submit">Update Product</button>
        </form>

        <p class="success_msg"></p>
        <p class="error_msg"></p>
    </div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="{{url('js/common.js')}}"></script>
<script>

    $('#update_prod_frm').submit(function(e){
        e.preventDefault()
        var form = $(this);
        var formdata = new FormData(form[0]);
        $('p.error_msg').text('');

        $.ajax({
            type: "POST",
            url: "{{ route('invoices.update',$invoice->id) }}",
            data: formdata,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (response) { // success callback 
                // console.log(response);
                $('.form-group').removeClass('has-error');
                $('.error-msg').remove();
                $('p.success_msg').text(response.message);
            },
            error: function (jqXhr, textStatus, errorMessage) { // error callback 
                $('p.success_msg').text('');
                $('p.error_msg').text('Error: ' + errorMessage);
                showError(jqXhr,form)
            }
        });
    });
</script>
</body>
</html>