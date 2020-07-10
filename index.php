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
    <div class="container mt-4 mb-4">
      <div class="row">
        <div class="col-md-8 mx-auto">

          <!-- 一覧 -->
          <h3>Lists</h3>
          <form>
            <table class="table">
              <tr>
                <th>Number</th>
                <th>Name</th>
                <th>Email</th>
                <th>Country</th>
                <th>City</th>
                <th>Job</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
              <tr v-for="(contact, num) in contacts" v-bind:key="contact.id">
                <td>{{ num+1 }}</td>
                <td>{{ contact.name }}</td>
                <td>{{ contact.email }}</td>
                <td>{{ contact.country }}</td>
                <td>{{ contact.city }}</td>
                <td>{{ contact.job }}</td>
                <td>
                  <button type="button" class="btn btn-success" v-on:click="getContact(contact.id, contact.name, contact.email, contact.country, contact.city, contact.job)">Edit</button>
                </td>
                <td>
                  <button type="button" class="btn btn-lightgray" v-on:click="deleteContact(contact.id)">Delete</button>
                </td>
              </tr>
            </table>
          </form>


          <hr class="mt-4 mb-4">

          <!-- 新規登録 -->
          <h3>Register</h3>
          <form v-on:submit.prevent="postCheckForm()">
            <table class="table">
              <tr>
                <th>name</th>
                <th>email</th>
                <th>country</th>
                <th>city</th>
                <th>job</th>
              </tr>
              <tr>
                <td><input type="text" v-model="name"></td>
                <td><input type="email" v-model="email"></td>
                <td><input type="text" v-model="country"></td>
                <td><input type="text" v-model="city"></td>
                <td><input type="text" v-model="job"></td>
              </tr>
            </table>
            <a class="btn btn-lightgray" v-on:click="cancelPost()">Cancel</a>
            <button class="btn btn-primary">Add</button>
          </form>

          <hr class="mt-4 mb-4">

          <!-- 更新 -->
          <h3>Update</h3>
          <form v-on:submit.prevent="updateCheckForm()">
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
            <a class="btn btn-lightgray" v-on:click="cancelUpdate()">Cancel</a>
            <button class="btn btn-success">Update</button>
          </form>

        </div><!-- /.col-md-8 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </div><!-- /#app -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="js/main.js"></script>
</body>
</html>