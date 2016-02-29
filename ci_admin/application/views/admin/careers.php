<div class="container-fluid">


    <form action="http://127.0.0.1/ci_admin/admin/careers_upload" enctype="multipart/form-data" method="post" accept-charset="utf-8">

        <label>Career Image:</label>
        <input class="form-control" type="file" name="userfile[]" size="20"/>

        <label>Job Title</label>
        <input type="text" class="form-control" name="job_title"/>
        <div class="button-div" style="margin-top: 10px; text-align: center;">
            <input class="btn btn-info" type="submit" value="submit"/>
        </div>
    </form>


</div>