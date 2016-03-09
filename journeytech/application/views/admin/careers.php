<div class="container-fluid">

    <div style="text-align: center;">
        <h1>Careers</h1>
    </div>

    <form action="http://127.0.0.1/ci_admin/admin/careers_upload" enctype="multipart/form-data" method="post" accept-charset="utf-8">

        <label>Career Image:</label>
        <input class="form-control" type="file" name="userfile[]" size="20"/>

        <label>Job Title</label>
        <input type="text" class="form-control" name="job_title"/>
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
        foreach ($careers as $data) {
            echo "<tr>";
            echo "<td>" . str_replace("careers/", "", $data['career_img_url']) . "</td>";
            echo "<td><a href='" . base_url('admin/deactivate') . "/" . $data['id'] . "/" . "careers" . "' class='btn btn-danger'>Deactivate</a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

</div>