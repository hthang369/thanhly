<template>
  <div class="wraper">
    <b-row class="row-cols-1 row-cols-md-3">
      <b-col v-for="obj in items.text" :key="obj.key" class="mb-3">
        <WidgetData :base-url="baseUrl" :item="obj" :options="items.group"></WidgetData>
      </b-col>
    </b-row>
  </div>
</template>
<script>
import {get, replace} from 'lodash';
import WidgetData from './WidgetData.vue';

export default {
  name: 'WidgetGroup',
  components: {WidgetData},
  props: {
    baseUrl: String,
  },
  data() {
    return {
      items: {},
    }
  },
  provide() {
    return {
      'widgetGroup': this
    }
  },
  created() {
    axios.defaults.baseURL = this.baseUrl;
    axios.get('widget').then((res) => {
      this.items = res.data.data.widget;
    });
  },
  methods: {
    parseHtml(preview, key) {
      const data = get(preview, key)
      return data ? replace(data, /(\[slot_\d+\])/g, (obj) => {
        return this.getVal(`group.${key}`, obj)
      }) : '';
    },
    getVal(key, val) {
      return get(this.items.preview_text, get(get(this.configs, key), val).value, val)
    }
  }
}
</script>
