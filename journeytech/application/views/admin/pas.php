<div class="container-fluid">

    <div style="text-align: center;">
        <h1>Products and Services</h1>
    </div>

    <form action="http://127.0.0.1/ci_admin/admin/pas_upload" enctype="multipart/form-data" method="post"
          accept-charset="utf-8">

        <label>Product Image:</label>
        <input class="form-control" type="file" name="userfile[]" size="20"/>
        <label>Product Description</label>
        <textarea type="text" name="product_description" class="form-control"></textarea>

        <div class="button-div" style="margin-top: 10px; text-align: center;">
            <input class="btn btn-info" type="submit" value="submit"/>
        </div>
    </form>

    <h1>List of active Products and Services</h1>

    <table class="table table-striped">
        <thead>
        <th>Image name</th>
        <th>Tools</th>
        </thead>
        <tbody>
        <?php
        foreach ($pas as $data) {
            echo "<tr>";
            echo "<td>" . str_replace("pas/", "", $data['product_img_url']) . "</td>";
            echo "<td><a href='" . base_url('admin/deactivate') . "/" . $data['id'] . "/" . "pas" . "' class='btn btn-danger'>Deactivate</a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>


</div>