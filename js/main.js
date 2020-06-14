new Vue({
  el: '#app',
  data() {
    return {
      // id: 0,
      name: '',
      email: '',
      country: '',
      city: '',
      job: '',
      contacts: [
        // {"id":"1","name":"David","email":"david@example.com","city":"UK","country":"London","job":"Designer"}
      ],
      selectedId: ''
    }
  },
  mounted() {
    this.getContacts();
  },
  methods: {
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
    postContact: function () {

      let formData = new FormData();
      formData.append('name', this.name);
      formData.append('email', this.email);
      formData.append('country', this.country);
      formData.append('city', this.city);
      formData.append('job', this.job);

      let contact = {};
      formData.forEach((key, value) => {
        contact[key] = value;
      });

      console.log(contact);

      axios({
        method: 'post',
        url: 'contacts.php',
        data: formData,
        config: { headers: {'Content-Type': 'multipart/form-data' }}
      })
        .then((response) => {
          console.log(response);
          this.contacts.push(contact);
          this.name = '';
          this.email = '';
          this.country = '';
          this.city = '';
          this.job = '';
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getId: function(id){
      this.selectedId = id;
    },
    setId: function(){
      return this.selectedId;
    }
  }

});