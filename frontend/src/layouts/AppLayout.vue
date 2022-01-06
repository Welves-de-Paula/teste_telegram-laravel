<template>
  <div style="height: 100%">
    <!-- <v-app-bar color="#fff" app dense  >
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
     
    </v-app-bar> -->
    <v-navigation-drawer color="primary" app dark floating v-model="drawer">
      <v-list nav dense>
        <v-list-item-group>
          <template v-for="(link, index) in links">
            <v-list-item link :to="link.path" router exact :key="index">
              <v-list-item-action>
                <v-icon>{{ link.meta.icon }}</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title> {{ link.meta.name }} </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </template>

          <v-list-item link router exact>
            <v-list-item-action>
              <v-icon>mdi-help-circle-outline</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Ajuda</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item @click="logout()">
            <v-list-item-action>
              <v-icon>mdi-logout</v-icon>
            </v-list-item-action>

            <v-list-item-content>
              <v-list-item-title>Sair</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
    <v-main style="height: 100%">
      <v-container class="pa-md-8" fluid style="height: 100%">
        <slot></slot>
      </v-container>
    </v-main>
  </div>
</template>

<script>
export default {
  components: {},

  data: () => ({
    drawer: true,
  }),
  computed: {
    links() {
      return this.$router.options.routes; //.filter((row) => {
      //   if (typeof row.meta.showLink != "undefined") {
      //     return row.meta.showLink;
      //   }

      //   return false;
      // });
    },
  },
  methods: {},
};
</script>
