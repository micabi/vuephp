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
          <table class="table">
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Country</th>
              <th>City</th>
              <th>Job</th>
            </tr>
            <tr v-for="contact in contacts" v-bind:key="contact.id">
              <td>{{ contact.name }}</td>
              <td>{{ contact.email }}</td>
              <td>{{ contact.country }}</td>
              <td>{{ contact.city }}</td>
              <td>{{ contact.job }}</td>
            </tr>
          </table>

          <form>
            <label for="name">Name:<input type="text" name="name" id="name" v-model="name"></label><br>
            <label for="email">Email:<input type="text" name="email" id="email" v-model="email"></label><br>
            <label for="country">Country:<input type="text" name="country" id="country" v-model="country"></label><br>
            <label for="city">City:<input type="text" name="city" id="city" v-model="city"></label><br>
            <label for="job">Job:<input type="text" name="job" id="job" v-model="job"></label><br>
            <button class="btn btn-primary" v-on:click="createContact()">Add</button>
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