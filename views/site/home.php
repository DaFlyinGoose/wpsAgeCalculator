<?php //die(print_r($birthday->diff()));?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Age Calculator</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" href="/css/datatables.min.css">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div class="container">
        <div class="header clearfix">
            <nav>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation" class="active"><a href="#">Home</a></li>
                    <li role="presentation"><a href="http://dfg.gd">About</a></li>
                </ul>
            </nav>
            <h3 class="text-muted">WPS Age Calculator</h3>
        </div>

        <div class="jumbotron">
            <h1>How old are you exactly?</h1>
            <p class="lead">
                <?php if (isset($birthday)) {
                    echo $birthday->name . ' your birthday was '
                        . $diff->y . str_plural(' year', $diff->y) . ', '
                        . $diff->daysIncludingMonths . str_plural(' day', $diff->daysIncludingMonths) . ' and '
                        . $diff->h . str_plural(' hour', $diff->h) . ' ago.';
                    } else { ?>
                Put your name and date of birth in the form below and we can tell you to the hour how old you are!</p>
                <?php } ?>
            </p>
            <form method="post">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Your Full Name">
                        </div>
                    </div>
                    <div class='col-sm-5'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker'>
                                <input type='text' class="form-control" placeholder="Your Date of Birth" name="dob"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <p><input type="submit" value="Calculate Now" class="btn btn-lg btn-success"</p>
            </form>
        </div>

        <div class="row marketing">
            <table id="birthdays" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $birthdays->each(function ($value) {
                        $rowDiff = $value->diff();
                        echo '<tr>'
                            . '<td>' . $value->name . '</td>'
                            . '<td>' . $rowDiff->y . str_plural(' year', $rowDiff->y) . ', '
                            . $rowDiff->daysIncludingMonths . str_plural(' day', $rowDiff->daysIncludingMonths) . ' and '
                            . $rowDiff->h . str_plural(' hour', $rowDiff->h) . '</td>'
                            .'</tr>';
                    }); ?>
                </tbody>
            </table>
        </div>

    </div>

    <script src="/js/jquery-2.2.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/moment.min.js"></script>
    <script src="/js/datatables.min.js"></script>
    <script src="/js/bootstrap-datetimepicker.js"></script>

    <script>
        $(function () {
            $('#datetimepicker').datetimepicker({
                viewMode: 'years',
                maxDate: 'now',
                allowInputToggle: true,
            });
            $('#birthdays').DataTable();
        });
    </script>
</body>
</html>