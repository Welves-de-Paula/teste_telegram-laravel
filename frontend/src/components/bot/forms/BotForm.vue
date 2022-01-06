<template>
  <v-dialog v-model="dialog" persistent max-width="500px">
    <v-card>
      <v-card-title primary-title> Novo Bot Telegram</v-card-title>
      <v-card-text>
        <v-row>
          <v-col>
            <app-text-field v-model="form.name" label="Nome" />
          </v-col>
          <v-col>
            <app-text-field v-model="form.domain" label="Domínio" />
          </v-col>
          <v-col cols="12">
            <app-text-field v-model="form.token" label="Bot Token" />
          </v-col>

          <v-col cols="12">
            <v-textarea outlined v-model="form.description" label="Descrição" />
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
        <v-btn class="text-capitalize" @click="handleSave()" color="success"
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

      baseForm: {
        name: null,
        token: null,
        domain: null,
        description: null,
      },
    };
  },
  computed: {
    isInsert() {
      return !this.form.id;
    },
  },

  methods: {
    async open(id) {
      this.reset();

      if (id) {
        await this.showBot(id);
      }

      this.dialog = true;
    },
    reset() {
      this.form = JSON.parse(JSON.stringify(this.baseForm));
    },

    async showBot(id) {
      await this.$http.$get("bot/bot/" + id).then((response) => {
        this.form = response.bot;
      });
    },

    handleSave() {
      if (this.isInsert) {
        this.store();
      } else {
        this.update();
      }
    },

    store() {
      this.$http.store("bot/bot", this.form).then((response) => {
        this.processSaved();
      });
    },

    update() {
      this.$http.update("bot/bot", this.form.id, this.form).then((response) => {
        this.processSaved();
      });
    },

    processSaved() {
      this.$emit("store");
      this.dialog = false;
    },

    // storeBot() {
    //   this.$http
    //     .store("bot/bot", this.form)
    //     .then((response) => {})
    //     .catch((response) => {});
    // },
  },
};
</script>

<style>
</style>