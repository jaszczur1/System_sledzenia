<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


$host = "localhost";
$user = "root";
$password = "";
$db_name = "navigation";

$conn = new mysqli($host, $user, $password, $db_name);



$sql = "select B.id_boot, B.boot_name, E.id_trace, R.route_name, E.id_event, event_kind.description, P.speed, P.latitude, P.longitude FROM boot_event as E inner join trace as T on T.id_trace = E.id_trace inner join boot as B on B.id_boot = T.id_boot JOIN postion as P ON T.id_trace=P.id_trace INNER JOIN event_kind ON event_kind.id_event_kind= E.id_event_kind INNER JOIN routes as R ON R.id_route=T.id_route\n"
    . " \n"
    . " WHERE E.id_event= P.id_postion AND T.id_trace IN (SELECT MAX(trace.id_trace) FROM boot, trace WHERE trace.id_boot=boot.id_boot GROUP by boot.id_boot) ORDER BY E.id_event";


$result = $conn->query($sql);

$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"id_boot":"'  . $rs["id_boot"] . '",';
    $outp .= '"boot_name":"'  . $rs["boot_name"] . '",';
    $outp .= '"id_trace":"'   . $rs["id_trace"]        . '",';
    $outp .= '"route_name":"'   . $rs["route_name"]        . '",';
    $outp .= '"id_event":"'   . $rs["id_event"]        . '",';
    $outp .= '"description":"'   . $rs["description"]        . '",';
    $outp .= '"speed":"'   . $rs["speed"]        . '",';
    $outp .= '"latitude":"'   . $rs["latitude"]        . '",';
    $outp .= '"longitude":"'. $rs["longitude"]     . '"}'; 
}
$outp .="]";

$conn->close();

echo($outp);
