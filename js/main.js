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
      contacts: []
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
      axios.get('./contacts.php')
      .then((response) => {
        this.contacts = response.data;
        console.log(this.contacts);
      })
      .catch((error) => {
        console.log(error);
      });
    }
  }

});