<?php


/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', '');
define('DB_USERNAME', '');
define('DB_PASSWORD', '');
define('DB_NAME', 'mock');

/* Attempt to connect to MySQL database */
try {
    $conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}


$params = $totalRecords = $data = array();

$params = $_REQUEST;

$where_condition = "";

// Query SQL statement
$sql = "SELECT id, first_name, last_name, email, gender FROM mock_data ";

// Set where condition statements
if (!empty($params['search']['value'])) {
    $where_condition .= " WHERE ";
    $where_condition .= " first_name LIKE ? ";
    $where_condition .= " OR last_name LIKE ? ";
    $where_condition .= " OR gender LIKE ? ";
}

// Set others statements
$other_condition =  " ORDER BY id  " . $params['order'][0]['dir'] . "  LIMIT " . $params['start'] . " ," . $params['length'] . " ";

//Prepare a select statement for query with others statements
$stmt = $conn->prepare($sql . $where_condition.$other_condition);

//Prepare a select statement for total data only
$stmtTotal = $conn->prepare($sql . $where_condition);

// Bind variables to the prepared statement as parameters
if (!empty($params['search']['value']) && $params['search']['value'] != "") {
    
    $search = $params['search']['value'];

    //Bind variables for data
    $stmt->bindValue(1, "%$search%");
    $stmt->bindValue(2, "%$search%");
    $stmt->bindValue(3, "%$search%");

    //Bind variables for total data
    $stmtTotal->bindValue(1, "%$search%");
    $stmtTotal->bindValue(2, "%$search%");
    $stmtTotal->bindValue(3, "%$search%");
}
//Attempt to execute the prepared statement for data
$stmt->execute();
//Attempt to execute the prepared statement for total data
$stmtTotal->execute();

//Fetch all result row as an associative array.
$data  = $stmt->fetchAll(PDO::FETCH_ASSOC);

//Get row count
$totalRecords  = $stmtTotal->rowCount();

//Sent parameters
$json_data = array(
    "draw"            => intval($params['draw']),
    "recordsTotal"    => intval($totalRecords),
    "recordsFiltered" => intval($totalRecords),
    "data"            => $data,
);

echo json_encode($json_data);
