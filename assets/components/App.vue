<template>
  <div>
    <widget fetch-interval="10"></widget>
  </div>
</template>
<script lang="ts">
import {defineComponent} from "vue";
import Widget from "./Widget.vue";

export default defineComponent({
  components: {Widget},
});
</script>