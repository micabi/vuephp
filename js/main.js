new Vue({
  el: '#app',
  data() {
    return {
      name: 'David',
      email: 'aa@aaa.aa',
      country: 'UK',
      city: 'London',
      job: 'Designer',
      contacts: []
    }
  },
  mounted() {
    this.getContact();
  },
  methods: {
    createContact: function(){
      console.log('create!');
    },
    getContact: function(){
      console.log('get!');
    }
  }

});