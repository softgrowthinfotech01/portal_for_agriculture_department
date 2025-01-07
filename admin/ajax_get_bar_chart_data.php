<?php
//header('Content-Type: application/json');

require_once('../conn.php');

$stmt_bar_chart = $conn->prepare("SELECT d.district_name AS ddistrict_name,COUNT(b.blog_id) AS count_blog FROM district d LEFT JOIN blog b ON d.district_id=b.district_id GROUP BY d.district_id");
$stmt_bar_chart->execute();
$row_bar_chart = $stmt_bar_chart->fetchAll(PDO::FETCH_ASSOC);

$data = array();
foreach ($row_bar_chart as $row) {
	$data['ddistrict_name'][] = $row['ddistrict_name'];
	$data['count_blog'][] = $row['count_blog'];
}
//$d1="['".implode('\',\'',$district_data)."']";
//$d2="['".implode('\',\'',$count_blog_data)."']";

//print_r($d1,$d2);
echo json_encode(array($data));
?>