<?php
//fetch.php
// session_start();
// include('../db.php');
$connect = mysqli_connect("localhost", "root", "", "j");
$column = array("order_customer_name", "order_item", "order_value", "order_date");
$query = "
 SELECT * FROM tbl_order WHERE 
";

if(isset($_POST["is_days"]))
{
 $query .= "order_date BETWEEN CURDATE() - INTERVAL ".$_POST["is_days"]." DAY AND CURDATE() AND ";
}

if(isset($_POST["search"]["value"]))
{
 $query .= '(order_customer_name LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR order_item LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR order_value LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR order_date LIKE "%'.$_POST["search"]["value"].'%") ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY order_id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = $row["order_customer_name"];
 $sub_array[] = $row["order_item"];
 $sub_array[] = $row["order_value"];
 $sub_array[] = $row["order_date"];
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM tbl_order";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);



?>

