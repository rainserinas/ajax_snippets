<div class="container-fluid">

    <div style="text-align: center;">
        <h1>Home</h1>
    </div>

    <form action="<?php echo base_url('admin/home_upload'); ?>" enctype="multipart/form-data" method="post"
          accept-charset="utf-8">

        <label>Heading Image:</label>
        <input class="form-control" type="file" name="userfile[]" size="20"/>
        <label>Heading Text:</label>
        <input type="text" class="form-control" name="heading_text"/>
        <label>News #1 title</label>
        <input type="text" class="form-control" name="news_1_title" maxlength="30" placeholder="Max character is 30"/>
        <label>News #1 text</label>
        <input type="text" class="form-control" name="news_1_text" maxlength="100" placeholder="Max character is 100"/>
        <label>News #1 Image URL</label>
        <input class="form-control" type="file" name="userfile[]" size="20"/>
        <label>News #2 title</label>
        <input type="text" class="form-control" name="news_2_title" maxlength="30" placeholder="Max character is 30"/>
        <label>News #2 text</label>
        <input type="text" class="form-control" name="news_2_text" maxlength="100" placeholder="Max character is 100"/>
        <label>News #2 Image URL</label>
        <input class="form-control" type="file" name="userfile[]" size="20"/>
        <label>News #3 title</label>
        <input type="text" class="form-control" name="news_3_title" maxlength="30" placeholder="Max character is 30"/>
        <label>News #3 text</label>
        <input type="text" class="form-control" name="news_3_text" maxlength="100" placeholder="Max character is 100"/>
        <label>News #3 Image URL</label>
        <input class="form-control" type="file" name="userfile[]" size="20"/>
        <label>Description</label>
        <input type="text" class="form-control" name="description" maxlength="30" placeholder="Max character is 30"/>
        <label>Description Text</label>
        <input type="text" class="form-control" name="description_text" maxlength="100" placeholder="Max character is 100"/>

        <div class="button-div" style="text-align:center; margin-top:10px">
            <input class="btn btn-info" type="submit" value="submit"/>
        </div>
    </form>


</div>

