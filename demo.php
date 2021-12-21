<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTable Post List Processing</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
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
                </tr>
            </thead>

        </table>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $('#post_list').dataTable({
            "bProcessing": true,
            "serverSide": true,
            "ajax": {
                url: "server_post_list.php",
                type: "POST",
                error: function() {
                    $("#post_list_processing").css("display", "none");
                }
            },
            "columns": [{
                    'data': 'id'
                },
                {
                    'data': 'first_name'
                },
                {
                    'data': 'last_name'
                },
                {
                    'data': 'email'
                },
                {
                    'data': 'gender'
                },
            ]

        });
    </script>
</body>

</html>