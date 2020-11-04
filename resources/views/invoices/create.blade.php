<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Create</title>
    <link rel="stylesheet" type="text/css" href="{{url('css/common.css')}}">
    <style>
        label{
            font-weight: bold;
        }
        .prd{
            margin-bottom: 10px;
        }
        .all_prd{
            display: inline-block;
            border: 1px solid black;
            padding: 10px;
        }
    </style>

</head>
<body>
    <div>
        <a href="{{ route('invoices.index') }}">Products</a>
    </div><br/><br/>

    <div>
        <form id="add_prod_frm" class="form">
            <div class="form-group"> 
                <label>Customer Name</label>
                <input type="text" class="form-control" name="customer_name" placeholder="Customer Name" required/>           
            </div>

            <div class="form-group"> 
                <label>Customer Email</label>
                <input type="email" class="form-control" name="customer_email" placeholder="Customer Email" required/>            
            </div>
            <br/><br/>

            <div id="prdList">
                <label>Products</label> <button type="button" id="addPrd">Add</button> <br/><br/>
                <div class="all_prd">                
                    <div class="prd">
                        <div class="form-group"> 
                            <label>Product Name</label>
                            <input type="text" class="form-control" name="product_name[]" placeholder="Product Name" required/>
                        </div>

                        <div class="form-group"> 
                            <label>Priduct Price</label>
                            <input type="number" class="form-control" step="0.01" name="product_price[]" placeholder="Priduct Price" required/>
                        </div>

                        <div class="form-group"> 
                            <label>Discount</label>
                            <input type="number" class="form-control" name="discount[]" placeholder="Discount" max="100" required/>
                        </div>
                    </div>
                 </div>

            </div><br/>
            {{csrf_field()}}
            <button type="submit">Add Product</button>
        </form>

        <p class="success_msg"></p>
        <p class="error_msg"></p>
    </div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="{{url('js/common.js')}}"></script>
<script>

    $('#add_prod_frm').submit(function(e){
        e.preventDefault()
        var form = $(this);
        var formdata = new FormData(form[0]);
        $('p.error_msg').text('');

        $.ajax({
            type: "POST",
            url: "{{ route('invoices.store') }}",
            data: formdata,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (response) { // success callback 
                // console.log(response);
                $('#add_prod_frm input').val('');
                $('p.success_msg').text(response.message);
            },
            error: function (jqXhr, textStatus, errorMessage) { // error callback 
                $('p.success_msg').text('');
                $('p.error_msg').text('Error: ' + errorMessage);
                // console.log(jqXhr)
                showError(jqXhr,form)
            }
        });
    });

    $('#addPrd').click(function(){
        $('.all_prd').append(`<div class="prd">
                    <div class="form-group"> 
                        <label>Product Name</label>
                        <input type="text" class="form-control" name="product_name[]" placeholder="Product Name" required/>
                    </div>

                    <div class="form-group"> 
                        <label>Priduct Price</label>
                        <input type="number" class="form-control" step="0.01" name="product_price[]" placeholder="Priduct Price" required/>
                    </div>

                    <div class="form-group"> 
                        <label>Discount</label>
                        <input type="number" class="form-control" name="discount[]" placeholder="Discount" max="100" required/>
                    </div>

                    <button type="button" class="removePrd">Remove</button>

                </div>`);
    })

    $('body').on('click','.removePrd',function(){
        $(this).closest('div.prd').remove();
    })

    
</script>
</body>
</html>