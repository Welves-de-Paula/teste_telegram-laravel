<template>
  <div>
    <v-row>
      <!-- <v-col cols="12" sm="2">
            <v-sheet rounded="lg" min-height="268">
             </v-sheet>
          </v-col> -->

      <v-col cols="12" sm="8">
        <v-sheet min-height="70vh" rounded="lg">
          <!--  -->
          <v-row class="d-flex align-center">
            <v-col>
              <BotSearch v-model="form.bot" />
            </v-col>
            <v-col>
              <v-select
                :items="bot_methods"
                v-model="bot_method"
                label="bot_method"
              />
            </v-col>

            <v-col>
              <v-btn class="text-capitalize" @click="addBot()" color="success"
                >Novo Bot</v-btn
              >
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <v-textarea outlined label="Mensagem" v-model="form.message" />
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

      <v-col cols="12" sm="4">
        <v-sheet rounded="lg" min-height="268">
          <v-btn @click="getBot()" block color="primary">Get BoT</v-btn>
          <v-row>
            <v-col> {{ bot }} </v-col>
          </v-row>
        </v-sheet>
      </v-col>
    </v-row>

    <!-- -->
    <BotForm ref="BotForm" />
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
import BotForm from "../components/bot/forms/BotForm.vue";
import axios from "axios";
import BotSearch from "../components/bot/ui/BotSearch.vue";

export default {
  components: { VueEditor, BotForm, BotSearch },

  data() {
    return {
      bot: {},
      bots: [],
      bot_method: "getMe",
      bot_methods: [
        { value: "getMe", text: "getMe" },
        { value: "getUpdates", text: "getUpdates" },
      ],
      form: {
        bot: {},
        message: "hello world",
      },
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
    sendMessage() {
      this.$http.store("message/message", this.form);
    },
    addBot() {
      this.$refs.BotForm.open();
    },

    getBot() {
      axios
        .get(
          `https://api.telegram.org/bot${this.form.bot.token}/${this.bot_method}`
        )
        .then((response) => {
          this.bot = response.data;
        });
    },
  },
};
</script>
