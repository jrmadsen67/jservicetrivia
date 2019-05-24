<template>
  <div class="container">
    <h3 class="mb-10">Welcome to Game {{ game.id }} of JService Trivia!</h3>

    <div class="mb-4">
      <button v-show="!showNewPlayerForm" class="btn btn-primary btn-sm" @click="showNewPlayerForm = true">New Player</button>

      <div v-show="showNewPlayerForm">
        <label for="newplayer">Name:</label>
        <input id="newplayer" type="text" v-model="newplayer.name">
        <button class="btn btn-success btn-sm"  @click="addPlayer()">Add</button>
        <button class="btn btn-danger btn-sm"  @click="resetForm()">Cancel</button>
      </div>

      <button v-show="!showNewPlayerForm" class="btn btn-success btn-sm" @click="startGame()">Start Game!</button>

    </div>

    <div class="row justify-content-center">
      <table class="table table-sm">
        <thead>
          <tr><th>Player</th><th>Current Score</th></tr>
        </thead>
        <tbody>
          <tr v-for="(player, index) in players" >
            <td>{{ player.name }}</td>
            <td>{{ player.score }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      game: Object
    },
    data: function(){
      return {
        players: JSON.parse(this.game.players),
        showNewPlayerForm: false,
        newplayer: {name:'', score:0}
      }
    },
    methods:{
      addPlayer(){
        this.players.push(this.newplayer);
        this.postUpdate();
        this.resetForm();
      },
      startGame(){
        this.postUpdate();
      },
      postUpdate(){
        let post = {id: this.game.id, players: this.players};
        axios.put(route('api.games.game.update', [this.game.id]), post)
          .then((resp) => {
            // return response.data;
          })
          .catch(function (error) {
            console.log(error);
          });
      },
      resetForm(){
        this.newplayer = {name:'', score:0};
        this.showNewPlayerForm = false;
      }
    }
  }
</script>

<style scoped>

</style>