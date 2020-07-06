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
          console.log(response.data);
          this.contacts = response.data;
          // console.log(this.contacts[0].id);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    // 新規追加
    postContact: function () {

      let formData = new FormData();
      formData.append('name', this.name);
      formData.append('email', this.email);
      formData.append('country', this.country);
      formData.append('city', this.city);
      formData.append('job', this.job);

      let contact = {}; // 1つ1つのデータ
      formData.forEach((key, value) => {
        contact[key] = value;
      });

      console.log(contact);

      axios({
        method: 'post',
        url: 'contacts.php',
        action: 'insert',
        data: formData,
        config: { headers: { 'Content-Type': 'multipart/form-data' } }
      })
        .then((response) => {
          console.log(response);
          this.contacts.push(contact);
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
    updateContact: function () {

      axios({
        url: 'contacts.php',
        method: 'post',
        action: 'update',
        id: this.putId,
        name: this.putName,
        email: this.putEmail,
        country: this.putCountry,
        city: this.putCity,
        job: this.putJob
      })
        .then((response) => {
          console.log(`アップデート`);
          console.log(`response.data: ${response.data}`); // 空！
          // this.getContacts();
          // this.putId = 0;
          // this.putName = '';
          // this.putEmail = '';
          // this.putCountry = '';
          // this.putCity = '';
          // this.putJob = '';
        })
        .catch((error) => {
          console.log(error);
        });
    }
  }
});