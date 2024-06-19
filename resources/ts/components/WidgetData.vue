<template>
  <NCard :title="data.header">
    <NForm>
      <NFormItem label="Title">
        <NInput v-model:value="data.title" />
      </NFormItem>
      <NFormItem label="Content">
        <NInput type="textarea" v-model:value="data.text" />
      </NFormItem>
    </NForm>
    <template #footer>
      <NButton type="primary" @click="handleSave">Save</NButton>
      <NButton type="error" @click="handleDelete">Delete</NButton>
    </template>
  </NCard>
</template>
<script lang="ts" setup>
import { NButton, NCard, NForm, NFormItem, NInput } from 'naive-ui';
import { reactive, useAttrs } from 'vue';

interface Props {
  header: string
  title: string
  text: string
}
const attrs = useAttrs()
const data = reactive(attrs.modelValue as Props)

const handleSave = () => {}
const handleDelete = () => {}
</script>
