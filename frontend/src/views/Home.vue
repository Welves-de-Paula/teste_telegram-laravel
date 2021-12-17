<template>
  <div>
    <v-main class="grey lighten-3">
      <v-container>
        <v-row>
          <v-col cols="12" sm="2">
            <!-- <v-sheet rounded="lg" min-height="268">
             </v-sheet> -->
          </v-col>

          <v-col cols="12" sm="8">
            <v-sheet min-height="70vh" rounded="lg">
              <!--  -->
              <v-row>
                <v-col>
                  <v-text-field
                    dense
                    v-model="form.bot_token"
                    outlined
                    label="Bot Token"
                  />
                </v-col>
                <v-col>
                  <v-text-field
                    dense
                    v-model="form.bot_name"
                    outlined
                    label="Nome"
                  />
                </v-col>

                <v-btn @click="storeBot()" color="success">text</v-btn>
              </v-row>
            </v-sheet>
          </v-col>

          <v-col cols="12" sm="2">
            <!-- <v-sheet rounded="lg" min-height="268">
             </v-sheet> -->
          </v-col>
        </v-row>
      </v-container>
    </v-main>
    <!-- -->
  </div>
</template>

<script>
export default {
  components: {},

  data() {
    return {
      form: { bot_token: null },
    };
  },

  methods: {
    storeBot() {
      this.$http
        .store("bot/bot", this.form)
        .then((response) => {})
        .catch((response) => {});
    },
  },
};
</script>
