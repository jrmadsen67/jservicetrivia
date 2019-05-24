<template>
  <div class="container">
    <h3 class="mb-10">Welcome to Game {{ game.id }} of JService Trivia!</h3>

    <div class="mb-4">
      <button v-show="!showNewPlayerForm && !gameStarted" class="btn btn-primary btn-sm" @click="showNewPlayerForm = true">New Player</button>

      <div v-show="showNewPlayerForm">
        <label for="newPlayer">Name:</label>
        <input id="newPlayer" type="text" v-model="newPlayer.name">
        <button class="btn btn-success btn-sm"  @click="addPlayer()">Add</button>
        <button class="btn btn-danger btn-sm"  @click="resetForm()">Cancel</button>
      </div>

      <button v-show="showStartGameBtn()" class="btn btn-success btn-sm" @click="startGame()">Start Game!</button>

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

    <div v-if="gameStarted" class="mt-10 row justify-content-center">
      <table class="w-1/2 table table-sm">
        <thead>
          <tr><th>Question for {{ players[currentPlayerIndex].name }}  -  Value: {{ currentClue.difficulty }} pts</th></tr>
          <tr><td>{{ currentClue.question }}</td></tr>
        </thead>
        <tbody>
          <tr v-show="!showAnswerFlag">
            <td>
              <button class="btn btn-primary btn-sm"  @click="showAnswer()">Show Answer</button>
            </td>
          </tr>
          <tr v-show="showAnswerFlag"><td>Answer: {{ currentClue.answer}}</td></tr>
          <tr v-show="showAnswerFlag">
            <td>
              <button class="btn btn-success btn-sm"  @click="updateScore(currentClue.difficulty)">Correct!</button>
              <button class="btn btn-danger btn-sm"  @click="updateScore(currentClue.difficulty * -1)">Wrong</button>
            </td>
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
        players: this.parsePlayers(),
        showNewPlayerForm: false,
        gameStarted: false,
        newPlayer: {name:'', score:0},
        currentClue: {},
        currentPlayerIndex: 0,
        showAnswerFlag: false,
      }
    },
    methods:{
      addPlayer(){
        this.players.push(this.newPlayer);
        this.postUpdate();
        this.resetForm();
      },
      startGame(){
        this.postUpdate();
        this.getClue();
      },
      setCurrentPlayer(){
        this.currentPlayerIndex = (this.currentPlayerIndex + 1 > this.players.length -1)?0:this.currentPlayerIndex + 1;
      },
      showStartGameBtn(){
        return !this.showNewPlayerForm && this.players.length && !this.gameStarted;
      },

      showAnswer(){
        this.showAnswerFlag = true;
      },
      updateScore(value){
        this.players[this.currentPlayerIndex].score += value;
        this.postUpdate();
        this.getClue();
        this.showAnswerFlag = false;
        this.setCurrentPlayer();
      },

      postUpdate(){
        let post = {id: this.game.id, players: this.players};
        return axios.put(route('api.games.game.update', [this.game.id]), post)
          .then((resp) => {
            // return response.data;
          })
          .catch(function (error) {
            console.log(error);
          });
      },
      getClue(){
        return axios.get(route('api.clues.clue.get-next', {game_id: this.game.id}))
          .then((resp) => {
            this.currentClue = resp.data.data;
          })
           .then((resp) => {
             this.gameStarted = true;
           })
          .catch(function (error) {
            console.log(error);
          });
      },
      resetForm(){
        this.newPlayer = {name:'', score:0};
        this.showNewPlayerForm = false;
      },
      parsePlayers(){
        let p = JSON.parse(this.game.players);
        return (p == null)? [] : p;
      }
    }
  }
</script>

<style scoped>

</style>