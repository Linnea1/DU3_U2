<?php
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "POST") {
    $json=file_get_contents("php://input");
    $data=json_decode($json, true);

    $username=$data['username'];
    $password=$data['password'];
    $users_json= file_get_contents("database.json");
    $users=json_decode($users_json, true);

    if(isset($users[$username])){
        http_response_code(403);
        $response = [
            "username"=>$username,
            "message" => "Username already excists",
            "ok" => false

        ];
        echo json_encode($response);
        exit();
    }else{
        $users[$username]=["password"=>$password, "points"=>0];
        $users_json=json_encode($users, JSON_PRETTY_PRINT);

        file_put_contents("database.json", $users_json);

        header('Content-Type: application/json');
        http_response_code(200);

        $response = [
            "username"=>$username,
            "status" => 200,
            "ok" => true

        ];
        echo json_encode($response);
        exit();
    }

}else{
    http_response_code(400);
    $response = [
        "username"=>$username,
        "message" => "Only POST works",
        "ok" => false

    ];
    echo json_encode($response);
    exit();
}
?>