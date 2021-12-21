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
              <v-row class="d-flex align-center">
                <v-col>
                  <v-autocomplete
                    item-text="name"
                    :items="bots"
                    auto-select-first
                    clearable
                  />
                </v-col>

                <v-col>
                  <v-btn
                    class="text-capitalize"
                    @click="addBot()"
                    color="success"
                    >Novo Bot</v-btn
                  >
                </v-col>
              </v-row>
              <v-row>
                <v-col>
                  <VueEditor
                    v-model="form.text"
                    :editorToolbar="customToolbar"
                  />
                </v-col>
              </v-row>
              <v-row>
                <v-col class="d-flex justify-end">
                  <v-btn
                    @click="sendMessage()"
                    class="text-capitalize"
                    color="success"
                    >Enviar Mensagem</v-btn
                  ></v-col
                >
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
    <BotForm ref="BotForm" />
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
import BotForm from "../components/bot/forms/BotForm.vue";

export default {
  components: { VueEditor, BotForm },

  data() {
    return {
      bots: [],
      form: {},
      customToolbar: [
        ["bold", "italic", "underline", "strike"], // toggled buttons
        // ["blockquote", "code-block"],

        [{ header: 1 }, { header: 2 }],
        [{ list: "ordered" }, { list: "bullet" }],
        [{ script: "sub" }, { script: "super" }], // superscript/subscript
        [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
        // [{ direction: "rtl" }], // text direction

        [{ size: ["small", false, "large", "huge"] }], // custom dropdown
        [{ header: [1, 2, 3, 4, 5, 6, false] }],

        [{ color: [] }, { background: [] }], // dropdown with defaults from theme
        [{ font: [] }],
        [{ align: [] }],

        ["clean"], // remove formatting button
      ],
    };
  },
  created() {
    this.$http.index("bot/bot").then((response) => {
      this.bots = response.bots;
    });
  },

  methods: {
    sendMessage() {},
    addBot() {
      this.$refs.BotForm.open();
    },
  },
};
</script>
