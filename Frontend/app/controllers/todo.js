import Ember from 'ember';

export default Ember.Controller.extend({

  remaining: Ember.computed.filterBy('model', 'status', false),
  completed: Ember.computed.filterBy('model', 'status', true),
  isDisable: true,

  actions: {
    addTask: function(){
     let task = this.store.createRecord('task',{
        task: 'הזן משימה חדשה',
        status: false
      });
      task.save();
    },
    deleteTask: function(id){
      console.log(id);
      this.get('store').find('task', id).
      then(task => task.destroyRecord());
    },
    acceptChanges: function(data){
      let me = this;
      this.store.find('task',data.get('id')).then(function(task){
        me.set('isDisable', true);
        task.set('tasks',data.get('task'));
        task.save();
      });
    },
    editTask: function(){
      this.set('isDisable', false);
    },
    complete: function(data){
      this.store.find('task',data.get('id')).then(function(task){
        task.set('status',!data.get('status'));
        task.save();
      });

    }
  }




  /**
   * Check if computed Property is empty
   */
  // isDisabled: Ember.computed.empty('emailAddress')

  /**
   * update Store
   */
  // const newInvitation = this.store.createRecord('invitation', { email: email });
  // newInvitation.save();

  /**
   * Async call
   */
//   newInvitation.save().then((response) => {
//   this.set('responseMessage', `Thank you! We saved your email address with the following id: ${response.get('id')}`);
//   this.set('emailAddress', '');
// });

});
