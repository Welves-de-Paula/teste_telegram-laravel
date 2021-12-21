<template>
  <v-dialog v-model="dialog" persistent max-width="500px">
    <v-card>
      <v-card-title primary-title> Novo Bot Telegram</v-card-title>
      <v-card-text>
        <v-row>
          <v-col>
            <v-text-field
              dense
              hide-details
              v-model="form.token"
              outlined
              label="Bot Token"
            />
          </v-col>
          <v-col>
            <v-text-field
              dense
              hide-details
              v-model="form.name"
              outlined
              label="Nome"
            />
          </v-col>
        </v-row>
      </v-card-text>

      <v-card-actions class="d-flex justify-end">
        <v-btn
          class="text-capitalize"
          @click="dialog = false"
          color="error"
          outlined
          >Voltar</v-btn
        >
        <v-btn class="text-capitalize" @click="storeBot()" color="success"
          >Salvar</v-btn
        >
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  data() {
    return {
      dialog: false,
      form: { token: null },
    };
  },

  methods: {
    open() {
      this.dialog = true;
    },
    storeBot() {
      this.$http
        .store("bot/bot", this.form)
        .then((response) => {})
        .catch((response) => {});
    },
  },
};
</script>

<style>
</style>