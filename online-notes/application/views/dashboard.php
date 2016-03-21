<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid pull-right">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Settings
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url('main/logout'); ?>"><span class="glyphicon glyphicon-off"></span>
                            Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<div class="container" style="margin-top: 80px;">

    <button class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal" title="Press F2 for shortcut"><span class="glyphicon glyphicon-plus"></span> Add message</button>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Message</th>
            <th>Type</th>
            <th>Tools</th>
        </tr>
        </thead>
        <tbody>

        <!-- Load data -->
        <?php

        foreach ($result as $data) {

            if($data['type'] == 'link'){
                $message = "<a href='".$data['content']."' target='_blank'>".$data['content']."</a>";
            }else{
                $message = $data['content'];
            }

            echo "<tr>";
            echo "<td title='".$data['datetimestamp']."'>" . $message . "</td>";
            echo "<td title='".$data['datetimestamp']."'>" . $data['type'] . "</td>";
            echo "<td><a href='".base_url('main/delete')."/".$data['id']."' class='btn btn-danger btn-sm' title='click to delete'><span class='glyphicon glyphicon-remove'></span></a></td>";
            echo "</tr>";
        }

        ?>
        <!-- Load data -->

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Fill up</h4>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url('main/save'); ?>" method="post">
                            <p>Message:</p>
                            <input type="text" name="message" class="form-control"/>
                            <p>Type:</p>
                            <select class="form-control" name="type">
                                <option value="link">Link</option>
                                <option value="text">Text</option>
                            </select>
                            <div style="text-align:center;">
                                <input style="margin-top: 10px; margin-bottom: 5px;" type="submit" class="btn btn-primary btn-sm" value="Submit"/>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>

            </div>
        </div>

        </tbody>
    </table>

</div>

<script>
    $(document).ready(function(){

        //Handle f2 button to call modal
        window.onkeypress = function(e) {
            if ((e.which || e.keyCode) == 113) {
                $('#myModal').modal('show');
            }
        }
    });
</script>
</body>
</html>
