<div class="container-fluid">

    <div style="text-align: center;">
        <h1>About</h1>
    </div>

    <form action="http://127.0.0.1/ci_admin/admin/about_upload" enctype="multipart/form-data" method="post" accept-charset="utf-8">

        <label>Title:</label>
        <input type="text" name="about_title" class="form-control"/>
        <label>About Page Text</label>
        <textarea class="form-control" name="about_textarea"></textarea>
        <label>Side Image</label>
        <input class="form-control" type="file" name="userfile[]" size="20"/>
        <label>Tagline</label>
        <input type="text" name="tagline" class="form-control"/>

        <div class="button-div" style="margin-top: 10px; text-align: center;">
            <input class="btn btn-info" type="submit" value="submit"/>
        </div>
    </form>


</div>