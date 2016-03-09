<div class="container-fluid">

    <div style="text-align: center;">
        <h1>Clients</h1>
    </div>

    <form action="http://127.0.0.1/ci_admin/admin/clients_upload" enctype="multipart/form-data" method="post"
          accept-charset="utf-8">

        <label>Client Logo:</label>
        <input class="form-control" type="file" name="userfile[]" size="20"/>

        <div class="button-div" style="margin-top: 10px; text-align: center;">
            <input class="btn btn-info" type="submit" value="submit"/>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
        <th>Image name</th>
        <th>Tools</th>
        </thead>
        <tbody>
        <?php
        foreach ($clients as $data) {
            echo "<tr>";
            echo "<td>" . str_replace("clients/", "", $data['client_img_url']) . "</td>";
            echo "<td><a href='" . base_url('admin/deactivate') . "/" . $data['id'] . "/" . "clients" . "' class='btn btn-danger'>Deactivate</a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

</div>