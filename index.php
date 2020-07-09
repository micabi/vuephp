<?php

    // $_POST[''] or $_GET[''] で値の受け取り
    if (isset($_GET['id'])) {
        $id = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');

        try {
            $pdo = new PDO("sqlite:vue.db");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            // echo("接続成功");
            $data = array();
            $name = '';
            $email = '';
            $country = '';
            $job= '';
            $sql = "select name, email, country, city, job from contacts where id = ?";
            $stmt = $pdo->prepare($sql);
            $data[] = $id; // {column A} value *POST['']されてきたものをdata[]に入れる
          // $data[] = ; // {column B} value
          // $data[] = ; // {column C} value
          $stmt->execute($data); // where 1ならdataは要らない。

          $pdo = null;

            while ($stmt == true) {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($rec == false) {
                    break;
                }

                // 処理 ここでrec['COLUMN-NAME']を、変数を作って代入する。
                $name = $rec['name'];
                $email = $rec['email'];
                $country = $rec['country'];
                $city = $rec['city'];
                $job = $rec['job'];
            }
        } catch (PDOException $Exception) {
            echo($Exception->getMessage());
            echo("データベースサーバーがダウンしています。しばらく経ってから再度お試し下さい。");
            exit();
        }
    }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP | Vue | CRUD</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://unpkg.com/vue"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>

  <div id="app">
    <div class="container">
      <div class="row">
        <div class="col-md-12">

          <!-- 一覧 -->
          <h3>Lists</h3>
          <form>
            <table class="table">
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Country</th>
                <th>City</th>
                <th>Job</th>
                <th>Edit</th>
              </tr>
              <tr v-for="contact in contacts" v-bind:key="contact.id">
                <td>{{ contact.name }}</td>
                <td>{{ contact.email }}</td>
                <td>{{ contact.country }}</td>
                <td>{{ contact.city }}</td>
                <td>{{ contact.job }}</td>
                <td>
                  <button type="button" class="btn btn-success" v-on:click="getContact(contact.id, contact.name, contact.email, contact.country, contact.city, contact.job)">Edit</button>
                </td>
              </tr>
            </table>
          </form>


          <hr class="mt-4 mb-4">

          <!-- 新規登録 -->
          <h3>Register</h3>
          <form>
            <label for="name">Name:<input type="text" id="name" v-model="name"></label><br>
            <label for="email">Email:<input type="text" id="email" v-model="email"></label><br>
            <label for="country">Country:<input type="text" id="country" v-model="country"></label><br>
            <label for="city">City:<input type="text" id="city" v-model="city"></label><br>
            <label for="job">Job:<input type="text" id="job" v-model="job"></label><br>
            <button class="btn btn-lightgray" v-on:click="cancelPost()">Cancel</button>
            <button type="button" class="btn btn-primary" v-on:click="postContact()">Add</button>
          </form>

          <hr class="mt-4 mb-4">

          <!-- 更新 -->
          <h3>Update</h3>
          <form>
            <table class="table">
              <tr>
                <th>name</th>
                <th>email</th>
                <th>country</th>
                <th>city</th>
                <th>job</th>
              </tr>
              <tr>
                <td><input type="text" name="name" v-model="putName"></td>
                <td><input type="text" name="email" v-model="putEmail"></td>
                <td><input type="text" name="country" v-model="putCountry"></td>
                <td><input type="text" name="city" v-model="putCity"></td>
                <td><input type="text" name="job" v-model="putJob"></td>
              </tr>
            </table><!-- /.table -->
            <input type="hidden" name="id" v-model="putId">
            <button class="btn btn-lightgray" v-on:click="cancelUpdate()">Cancel</button>
            <input type="button" value="update" class="btn btn-success" v-on:click="updateContact()">
          </form>

        </div><!-- /.col-md-12 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </div><!-- /#app -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="js/main.js"></script>
</body>
</html>