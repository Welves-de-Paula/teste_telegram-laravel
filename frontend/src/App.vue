<template>
  <v-app>
    <component :is="layout">
      <router-view />
    </component>
  </v-app>
</template>


<script>
import AppLayout from "@/layouts/AppLayout.vue";

export default {
  components: {
    AppLayout,
  },
  computed: {
    layout() {
      return this.$route.meta.layout;
    },
  },
};
</script>
