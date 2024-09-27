<?php

// First, the data is retrieved, a SQL query is created and performed

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $eventos = $_POST['id_evento'];
    // $fecha = $_POST['fecha'];
    // $hora = $_POST['hora'];
    $asistencias = $_POST['asistencia'];
    //
    $arrayEventos=  explode("|", $eventos);
    $arrayAsistencias = explode("|",$asistencias);
    $combined = array_combine($arrayEventos,$arrayAsistencias);
    $date = date("Y-m-d");
    $time = date("h:i:s");
    $results = array();
    // Use the database connection
   require_once('dbConnect.php');
    
    foreach ($combined as $id_evento => $checked) {
        // search attendance
        $sql = "SELECT `id_evento` FROM asistencia_eventos WHERE `id_user`= $id and `id_evento` = $id_evento";
		$r = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($r);
        // insert attendance
        if($checked == "1" && is_null($row)){
            $sql2 = "INSERT INTO asistencia_eventos VALUES ('$id', '$id_evento', '$date', '$time')";
            if(mysqli_query($con,$sql2)) {
                $results[$id_evento] = "inserted";
            } else {
                $results[$id_evento] = "error";
            }
        }
        // delete attendance
        if($checked == "0" && !is_null($row)) {
            $sql3 = "DELETE FROM asistencia_eventos where `id_user` = $id and `id_evento` = $id_evento";
            if(mysqli_query($con,$sql3)){
                $results[$id_evento] = "deleted";
            }else{
                $results[$id_evento] = "error";
            }
        }
        // do nothing
        if($checked == "1" && !is_null($row['id_evento']) || $checked == "0" && is_null($row['id_evento'])){
            $results[$id_evento] = "not affected";
        }
        
    }

    echo json_encode(array('message'=> "Asistente actualizado correctamente.",'result' => $results));
    mysqli_close($con);
}