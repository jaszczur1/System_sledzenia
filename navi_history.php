<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$host = "localhost";
$user = "root";
$password = "";
$db_name = "navigation";

$conn = new mysqli($host, $user, $password, $db_name);


$sql = "SELECT boot.id_boot, boot.boot_name, boot_event.id_trace, R.route_name, boot_event.id_event_kind, MIN(boot_event.id_event), event_kind.description, boot_event.date_event FROM boot INNER JOIN trace on boot.id_boot=trace.id_boot INNER JOIN boot_event ON trace.id_trace=boot_event.id_trace INNER JOIN event_kind ON event_kind.id_event_kind= boot_event.id_event_kind INNER JOIN routes AS R ON R.id_route= trace.id_route\n"
    . "GROUP by boot.id_boot, boot_event.id_trace, boot_event.id_event_kind ORDER by max(trace.id_trace) DESC, boot_event.id_event_kind";


$result = $conn->query($sql);



$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"id_boot":"'  . $rs["id_boot"] . '",';
    $outp .= '"boot_name":"'  . $rs["boot_name"] . '",';
    $outp .= '"id_trace":"'   . $rs["id_trace"]        . '",';
    $outp .= '"route_name":"'   . $rs["route_name"]        . '",';  
    $outp .= '"id_event_kind":"'   . $rs["id_event_kind"]        . '",';
    $outp .= '"boot_event.id_event":"'   . $rs["MIN(boot_event.id_event)"]        . '",';
    $outp .= '"description":"'   . $rs["description"]        . '",';
    $outp .= '"date_event":"'. $rs["date_event"]     . '"}'; 
}
$outp .="]";

$conn->close();

echo($outp);