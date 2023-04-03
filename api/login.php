<?php
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "POST") {
    $json=file_get_contents("php://input");
    $data=json_decode($json, true);

    $username=$data["username"];
    $password=$data["password"];
    
    $users_json= file_get_contents("database.json");
    $users=json_decode($users_json, true);
    $points=$users[$username]["points"];

    if(isset($users[$username])){
       if($users[$username]["password"]==$password){
        $response = [
            "username"=>$username,
            "points"=>$points,
            "message" => 200,
            "ok" => true

        ];
        echo json_encode($response);
        exit();
    }else{
        exit();
    }

} 
}
?>