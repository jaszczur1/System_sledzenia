<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$host = "localhost";
$user = "root";
$password = "";
$db_name = "navigation";

$conn = new mysqli($host, $user, $password, $db_name);



$sql = "select B.id_boot, B.boot_name, E.id_trace, E.date_event, R.route_name, E.id_event, P.speed, P.latitude, P.longitude, Ek.description FROM boot_event as E inner join trace as T on T.id_trace = E.id_trace inner join boot as B on B.id_boot = T.id_boot JOIN postion as P ON T.id_trace=P.id_trace INNER JOIN event_kind as Ek on Ek.id_event_kind =E.id_event_kind INNER JOIN routes as R ON R.id_route=T.id_route\n"
    . " where T.id_trace = (select max(id_trace) FROM trace as T1 where T1.id_boot = B.id_boot) AND E.id_event = (SELECT MAX(E1.id_event) from boot_event as E1 where E1.id_trace=T.id_trace) AND P.id_postion = (SELECT max(p1.id_postion) FROM postion as p1 WHERE p1.id_trace= T.id_trace) group by B.id_boot order by E.id_trace";

$result = $conn->query($sql);



$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"id_boot":"'  . $rs["id_boot"] . '",';
    $outp .= '"boot_name":"'  . $rs["boot_name"] . '",';
    $outp .= '"id_trace":"'   . $rs["id_trace"]        . '",';
    $outp .= '"route_name":"'   . $rs["route_name"]        . '",';
    $outp .= '"date_event":"'   . $rs["date_event"]        . '",';
    $outp .= '"id_event":"'   . $rs["id_event"]        . '",';
    $outp .= '"description":"'   . $rs["description"]        . '",';
    $outp .= '"speed":"'   . $rs["speed"]        . '",';
    $outp .= '"latitude":"'   . $rs["latitude"]        . '",';
    $outp .= '"longitude":"'. $rs["longitude"]     . '"}'; 
}
$outp .="]";

$conn->close();

echo($outp);