<template>
  <NGrid :cols="3">
    <NGridItem v-for="(item, idx) in items" :key="idx">
      <WidgetData :data="item" />
    </NGridItem>
  </NGrid>
</template>
<script lang="ts" setup>
import { NGrid, NGridItem } from 'naive-ui'
import WidgetData from './WidgetData.vue';
import { ref } from 'vue';

const items = ref<any[]>([])
</script>
