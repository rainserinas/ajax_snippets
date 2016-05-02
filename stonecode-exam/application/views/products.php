<!DOCTYPE html>
<html lang="en">
<head>
    <title>Products Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!-- datatable cdn -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.fancybox.css?v=2.1.5'); ?>" type="text/css"
          media="screen"/>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.fancybox.pack.js?v=2.1.5'); ?>"></script>

</head>
<body>

<div class="container">

    <h2>Products</h2>

    <a href="javascript:$.fancybox.open($('.fancybox'))" class="btn btn-info btn-sm"><i class="fa fa-plus"
                                                                                        aria-hidden="true"></i> Add</a>


    <table class="table table-hover datatable">
        <thead>
        <tr>
            <th>Tools</th>
            <th>Code</th>
            <th>Name</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($products as $key => $prod) {
            echo "<tr>";
            echo "<td><a href=\"javascript:$.fancybox.open($('.fancybox3'))\" onClick=edit($(this).attr('hid_id'))  hid_id='" . $prod['prod_id'] . "' class='btn btn-info btn-sm'><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></a> <a href='" . base_url('MainController/delete/' . $prod['prod_id']) . "' hid_id='" . $prod['prod_id'] . "' class='btn btn-danger btn-sm'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a> <a onClick=load_components($(this).attr('hid_id')) href=\"javascript:$.fancybox.open($('.fancybox2'))\"  hid_id='" . $prod['prod_id'] . "' class='btn btn-info btn-sm'><i class=\"fa fa-file\" aria-hidden=\"true\"></i></a></td>";
            echo "<td>000" . $prod['prod_code'] . "</td>";
            echo "<td>" . $prod['prod_name'] . "</td>";
            echo "<td>" . $prod['price'] . "</td>";
            echo "</tr>";
        }

        ?>
        </tbody>
    </table>
</div>

<div class="fancybox">
    <form action="<?php echo base_url('MainController/add') ?>" method="post" enctype="multipart/form-data">
        <h2>Product</h2>

        <label>Product Code:</label>
        <input name="product_code" type="text" class="form-control">
        <label>Product Name</label>
        <input name="product_name" type="text" class="form-control">
        <label>Price</label>
        <input name="price" type="text" class="form-control">

        <hr>

        <h2>Product Component</h2>


        <label>Component Name:</label>
        <input type="text" name="comp_name" class="form-control">
        <label>Component Description:</label>
        <input type="text" name="comp_desc" class="form-control">

        <div class="submit-btn-div">
            <input type="submit" value="Submit" class="btn btn-primary btn-small">
        </div>
    </form>
</div>

<div class="fancybox2">
    <h2>Components</h2>


    <button onClick=add_compo() class="btn btn-info pull-right add-btn"> Add</button>

    <div class="form-div">
        <form action="<?php echo base_url('MainController/add_product_components'); ?>" method="post"
              enctype="multipart/form-data">
            <input type="text" name="comp_name" class="form-control" placeholder="component name"><br>
            <input type="text" name="comp_desc" class="form-control" placeholder="component description"><br>
            <input id="hid_prod_id" type="hidden" name="prod_id" value="">
            <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">
            <div class="btn-div">
                <input type="submit" class="btn btn-info" value="Submit">
            </div>
        </form>
    </div>

    <table class="table table-striped">
        <thead>
        <th>Component Name</th>
        <th>Component Description</th>
        </thead>
        <tbody class="tbody">

        </tbody>
    </table>

</div>

<div class="fancybox3">
    <form action="<?php echo base_url('MainController/edit') ?>" method="post" enctype="multipart/form-data">
        <h2>Product</h2>

        <input class="form-control prod_id" type="hidden" name="id" value="">
        <label>Product Code:</label>
        <input name="product_code" type="text" class="form-control product_code">
        <label>Product Name</label>
        <input name="product_name" type="text" class="form-control product_name">
        <label>Price</label>
        <input name="price" type="text" class="form-control price">

        <div class="submit-btn-div">
            <input type="submit" value="Submit" class="btn btn-primary btn-small">
        </div>
    </form>
</div>


</body>
<script>
    $(document).ready(function () {
        $('.datatable').DataTable();
    });

    function load_components(id) {

        var url = window.location.href;// Returns full URL
        var final_url = url.replace("products", "ajax_load");

        $.ajax({
            url: final_url,
            type: "GET",
            dataType: "json",
            data: {
                prod_id: id
            },
            success: function (data) {


                $.each(data, function (index, item) {
                    $('.tbody').append("");
                    $('.tbody').append("<tr><td>" + item.comp_name + "</td><td>" + item.comp_desc + "</td></tr>");
                    $('#hid_prod_id').val(id);
                });

            },
            error: function (error) {
                console.log("Error:");
                console.log(error);
            }
        });

    }

    function add_compo() {
        $('.add-btn').hide();
        $('.form-div').show();
    }

    function edit(id) {

        var url = window.location.href;// Returns full URL
        var final_url = url.replace("products", "ajax_edit_data");

        $.ajax({
            url: final_url,
            type: "GET",
            dataType: "json",
            data: {
                prod_id: id
            },
            success: function (data) {


                $.each(data, function (index, item) {
                    $('.product_code').val(item.prod_code);
                    $('.product_name').val(item.prod_name);
                    $('.price').val(item.price);
                    $('.prod_id').val(id);
                });

            },
            error: function (error) {
                console.log("Error:");
                console.log(error);
            }
        });

    }

</script>
</html>
