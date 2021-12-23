<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTable Post List Processing</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</head>

<body>


    <div class="container">

        <h1>DataTable Post List Processing</h1>

        <table id="post_list" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {


            var htmlBtn = '<div class="btn-group" role="group" aria-label="Basic example">';
            htmlBtn += '<button type="button" class="one btn btn-info btn-sm"><i class="fas fa-search"></i></button>';
            htmlBtn += '<button type="button" class="two btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></button>';
            htmlBtn += '<button type="button" class="three btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>';
            htmlBtn += '</div>';

            var table = $('#post_list').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/ms.json'
                },                
                "bProcessing": true,
                "serverSide": true,
                "ajax": {
                    url: "server_post_list.php",
                    type: "POST",
                    error: function() {
                        $("#post_list_processing").css("display", "none");
                    }
                },
                "columnDefs": [{
                    "targets": -1,
                    "data": null,
                    "defaultContent": htmlBtn
                }, {
                    orderable: false,
                    targets: [0, 5]
                }, ]
            });

            $('#post_list tbody').on('click', 'button.one', function() {
                var data = table.row($(this).parents('tr')).data();
                alert("ID : " + data[0] + " 'Data: " + data[1]);
            });

            $('#post_list tbody').on('click', 'button.two', function() {
                var data = table.row($(this).parents('tr')).data();
                alert("ID : " + data[0] + " 'Data: " + data[2]);
            });

            $('#post_list tbody').on('click', 'button.three', function() {
                var data = table.row($(this).parents('tr')).data();
                alert("ID : " + data[0] + " 'Data: " + data[3]);
            });
        });
    </script>
</body>

</html>
