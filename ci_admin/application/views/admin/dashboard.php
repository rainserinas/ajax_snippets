<div class="container-fluid">


    <form action="http://127.0.0.1/ci_admin/admin/do_upload" enctype="multipart/form-data" method="post"
          accept-charset="utf-8">

        <label>Heading Image:</label>
        <input class="form-control" type="file" name="userfile[]" size="20"/>
        <label>Heading Text:</label>
        <input type="text" class="form-control" name="heading_text"/>
        <label>News #1 title</label>
        <input type="text" class="form-control" name="news_1_title"/>
        <label>News #1 text</label>
        <input type="text" class="form-control" name="news_1_text"/>
        <label>News #1 Image URL</label>
        <input class="form-control" type="file" name="userfile[]" size="20"/>
        <label>News #2 title</label>
        <input type="text" class="form-control" name="news_2_title"/>
        <label>News #2 text</label>
        <input type="text" class="form-control" name="news_2_text"/>
        <label>News #2 Image URL</label>
        <input class="form-control" type="file" name="userfile[]" size="20"/>
        <label>News #3 title</label>
        <input type="text" class="form-control" name="news_3_title"/>
        <label>News #3 text</label>
        <input type="text" class="form-control" name="news_3_text"/>
        <label>News #3 Image URL</label>
        <input class="form-control" type="file" name="userfile[]" size="20"/>
        <label>Description</label>
        <input type="text" class="form-control" name="description"/>
        <label>Description Text</label>
        <input type="text" class="form-control" name="description_text"/>

        <div class="button-div" style="text-align:center; margin-top:10px">
            <input class="btn btn-info" type="submit" value="submit"/>
        </div>
    </form>


</div>

