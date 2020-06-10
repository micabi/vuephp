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
      ]
    }
  },
  mounted() {
    this.getContacts();
  },
  methods: {
    createContact: function(){
      console.log('create!');
    },
    getContacts: function(){
      axios.get('contacts.php')
      .then((response) => {
        console.log(response.data);
        this.contacts = response.data;
        // console.log(this.contacts[0].id);
      })
      .catch((error) => {
        console.log(error);
      });
    }
  }

});