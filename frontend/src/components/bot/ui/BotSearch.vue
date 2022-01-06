<template>
  <div>
    <template v-if="selectedValue">
      <app-text-field
        :label="label"
        :value="selectedValue.name"
        readonly
        @click="open()"
        prepend-inner-icon="mdi-magnify"
        @keypress="open()"
      />
    </template>
    <template v-else>
      <div id="acc" @click.stop="open()">
        <app-text-field
          :label="label"
          readonly
          @click="open()"
          prepend-inner-icon="mdi-magnify"
        />
      </div>
    </template>

    <v-dialog
      v-model="dialog"
      max-width="600px"
      scrollable
      :fullscreen="$vuetify.breakpoint.xsOnly"
    >
      <v-card>
        <v-card-title>
          <div class="d-flex justify-space-between" style="width: 100%">
            <div>
              <span>Selecionar {{ label }}</span>
            </div>

            <v-btn @click="openBotForm()" color="success" icon
              ><v-icon>mdi-plus</v-icon>
            </v-btn>
          </div>
        </v-card-title>
        <v-card-subtitle>
          <v-text-field
            :loading="isLoading"
            class="mt-4"
            v-model="searchForm.searchText"
            autofocus
            solo
            flat
            background-color="grey lighten-4"
            prepend-inner-icon="mdi-magnify"
            placeholder="Pesquisar..."
            hide-details
            v-debounce:300ms="search"
          />
        </v-card-subtitle>
        <v-card-text>
          <v-list>
            <template v-for="(row, index) in searchResults.data">
              <v-list-item :key="index" @click="setSelectedValue(row)">
                <v-list-item-content>
                  <v-list-item-title>{{ row.name }} </v-list-item-title>
                  <v-list-item-subtitle>{{ row.domain }} </v-list-item-subtitle>
                  <!-- <v-list-item-title v-text="row.name"></v-list-item-title>

                  <v-list-item-title v-text="row.code"></v-list-item-title> -->
                </v-list-item-content>
                <v-list-item-icon>
                  <v-btn
                    @click.stop="openBotForm(row.id)"
                    text
                    icon
                    color="primary"
                  >
                    <v-icon>mdi-pencil</v-icon>
                  </v-btn>
                  <v-btn
                    @click.stop="deleteBot(row.id)"
                    text
                    icon
                    color="error"
                  >
                    <v-icon>mdi-delete</v-icon>
                  </v-btn>
                </v-list-item-icon>
              </v-list-item>
              <v-divider :key="'div' + index" />
            </template>
          </v-list>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn class="text-capitalize" text @click="dialog = false"
            >Voltar</v-btn
          >
        </v-card-actions>
      </v-card>
    </v-dialog>
    <BotForm ref="BotForm" />
  </div>
</template>

<script>
import BotForm from "@/components/bot/forms/BotForm";

export default {
  components: { BotForm },
  props: {
    value: {},
  },

  data: () => ({
    label: "Bot",
    url: "bot/bot",

    searchResults: {
      data: [],
    },

    selectedValue: {
      name: null,
    },

    dialog: false,

    isLoading: false,

    searchForm: {
      searchText: null,
    },
  }),

  watch: {
    value() {
      this.selectedValue = this.value;
    },
  },

  created() {
    this.selectedValue = this.value;
  },

  methods: {
    async open() {
      await this.search();

      this.dialog = true;
    },

    async search() {
      this.isLoading = true;

      await this.$http.index(this.url, this.searchForm).then((response) => {
        this.searchResults = response.bots;
      });

      this.isLoading = false;
    },

    setSelectedValue(selectedValue) {
      this.selectedValue = selectedValue;

      this.$emit("input", selectedValue);

      this.dialog = false;
    },

    clear() {
      this.selectedValue = null;
    },

    openBotForm(id) {
      this.$refs.BotForm.open(id);
    },
    deleteBot() {},
  },
};
</script>
