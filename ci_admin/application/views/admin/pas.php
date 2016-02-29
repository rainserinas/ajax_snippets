<div class="container-fluid">


    <form action="http://127.0.0.1/ci_admin/admin/pas_upload" enctype="multipart/form-data" method="post" accept-charset="utf-8">

        <label>Product Image:</label>
        <input class="form-control" type="file" name="userfile[]" size="20"/>
        <label>Product Description</label>
        <textarea type="text" name="product_description" class="form-control"></textarea>

        <div class="button-div" style="margin-top: 10px; text-align: center;">
            <input class="btn btn-info" type="submit" value="submit"/>
        </div>
    </form>


</div>