new Vue({
  el: '#app',
  data() {
    return {
      // 新規登録用
      id: 0,
      name: '',
      email: '',
      country: '',
      city: '',
      job: '',
      contacts: [
        // {"id":"1","name":"David","email":"david@example.com","city":"UK","country":"London","job":"Designer"}
      ],

      // 更新用
      putId: 0,
      putName: '',
      putEmail: '',
      putCountry: '',
      putCity: '',
      putJob: ''
    }
  },
  mounted() {
    this.getContacts();
  },
  methods: {
    // 一覧取得
    getContacts: function () {
      axios.get('contacts.php')
        .then((response) => {
          // console.log(response.data);
          this.contacts = response.data;
          // console.log(this.contacts[0].id);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    // 新規追加
    postContact: function () {

      let postData = new URLSearchParams();
      postData.append('action', 'insert');
      postData.append('name', this.name);
      postData.append('email', this.email);
      postData.append('country', this.country);
      postData.append('city', this.city);
      postData.append('job', this.job);

      // let contact = {}; // 1つ1つのデータ
      // formData.forEach((key, value) => {
      //   contact[key] = value;
      // });

      // console.log(contact);

      axios.post('contacts.php', postData)
        .then((response) => {
          console.log(`ゲット: ${response.data}`);
          // this.contacts.push(contact);
          this.getContacts();
          this.name = ''; // 空にする
          this.email = '';
          this.country = '';
          this.city = '';
          this.job = '';
        })
        .catch((error) => {
          console.log(error);
        });
    },

    // 更新したいやつ取得
    getContact: function (id, name, email, country, city, job) {
      this.putId = id;
      this.putName = name;
      this.putEmail = email;
      this.putCountry = country;
      this.putCity = city;
      this.putJob = job;
    },

    // 更新post
    updateContact: function () {
      axios.interceptors.request.use(request => {
        console.log('Starting Request: ', request)
        return request
      });

      axios.interceptors.response.use(response => {
        console.log('Response: ', response)
        return response
      });

      let postData = new URLSearchParams();
      postData.append('action', 'update');
      postData.append('id', this.putId);
      postData.append('name', this.putName);
      postData.append('email', this.putEmail);
      postData.append('country', this.putCountry);
      postData.append('city', this.putCity);
      postData.append('job', this.putJob);

      axios.post('contacts.php', postData)
        .then((response) => {
          // console.log(response.data); // 空！
          this.getContacts();
          this.putId = 0;
          this.putName = '';
          this.putEmail = '';
          this.putCountry = '';
          this.putCity = '';
          this.putJob = '';
        })
        .catch((error) => {
          console.log(error);
        });
    }
  }
});