<?php

try {
    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) { // リクエストタイプで分岐
        case 'GET':

            $pdo = new PDO("sqlite:vue.db");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $sql = "select * from contacts where 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(); // where 1ならdataは要らない。

            $pdo = null;
            $data = array();

            while ($stmt == true) {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($rec == false) {
                    break;
                }

                $data[] = $rec;
                // 処理 ここでrec['COLUMN-NAME']を、変数を作って代入する。
            }

            for ($i = 0; $i < count($data); $i++) {
                $data[$i]["id"] = intval($data[$i]["id"]);
            }

            $data = json_encode($data);
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=utf-8");
            echo $data;
        break;

        case 'POST':
            $received_data = json_decode(file_get_contents("php://input"));

            if ($received_data->action === 'insert') {

                // POSTされてきた値を変数に代入
                $name = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
                $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
                $country = htmlspecialchars($_POST["country"], ENT_QUOTES, 'UTF-8');
                $city = htmlspecialchars($_POST["city"], ENT_QUOTES, 'UTF-8');
                $job = htmlspecialchars($_POST["job"], ENT_QUOTES, 'UTF-8');

                $pdo = new PDO("sqlite:vue.db");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

                // echo("接続成功");
                $data = array();

                $sql = "insert into contacts(name, email, country, city, job) values (?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $data[] = $name; // value*
                $data[] = $email; // value**
                $data[] = $country;
                $data[] = $city;
                $data[] = $job;
                // var_dump($data);
                $stmt->execute($data);

                $pdo = null;
                // 処理
            }

            if ($received_data->action === 'update') {

                // POSTされてきた値を変数に代入
                // $received_data = json_decode($received_data, true); // jsonを連想配列に変換
                // $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
                // $name = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
                // $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
                // $country = htmlspecialchars($_POST["country"], ENT_QUOTES, 'UTF-8');
                // $city = htmlspecialchars($_POST["city"], ENT_QUOTES, 'UTF-8');
                // $job = htmlspecialchars($_POST["job"], ENT_QUOTES, 'UTF-8');

                // $received_data = json_decode($received_data, true);

                $data = array(
                    "id" => $received_data->id,
                    "name" => $received_data->name,
                    "email" => $received_data->email,
                    "country" => $received_data->country,
                    "city" => $received_data->city,
                    "job" => $received_data->job
                );

                $pdo = new PDO("sqlite:vue.db");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

                // echo("接続成功");

                $sql = 'update contacts set name = $data["name"], email = $data["email"], country = $data["country"], city = $data["city"], job = $data["job"] where id = $data["id"]';
                // $data[] = $received_data->id;
                // $data[] = $received_data->name;
                // $data[] = $received_data->email;
                // $data[] = $received_data->country;
                // $data[] = $received_data->city;
                // $data[] = $received_data->job;
                $stmt = $pdo->prepare($sql);
                $stmt->execute($data);

                $pdo = null;

                }
        break;
    }

} catch (PDOException $Exception) {
    echo($Exception->getMessage());
    echo("データベースサーバーがダウンしています。しばらく経ってから再度お試し下さい。");
    exit();
}

