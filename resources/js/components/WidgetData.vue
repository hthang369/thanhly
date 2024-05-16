<template>
  <b-card class="widget-card">
      <template slot="header">
          <div class="d-flex justify-content-between">
              <span>{{header}}</span>
          </div>
      </template>

      <b-form-group label="Title">
          <b-form-input v-model="title"></b-form-input>
      </b-form-group>
      <b-form-group label="Text">
          <b-form-textarea v-model="text" rows="4"></b-form-textarea>
      </b-form-group>

      <template slot="footer">
          <b-button variant="primary" size="sm" @click="handleSave()">Save</b-button>
          <b-button variant="danger" size="sm" @click="handleDelete()">Delete</b-button>
      </template>
  </b-card>
</template>
<script>
import {get,cloneDeep,isEmpty} from 'lodash';

export default {
  props: {
      baseUrl: String,
      item: Object,
      options: {
          type: Array,
          default: () => {
              return []
          }
      }
  },
  data() {
      return {
          optionItem: {
              text: 'Select',
              value: ''
          },
          optionGroups: cloneDeep(this.options),
          header: get(this.item, 'header'),
          title: get(this.item, 'title'),
          text: get(this.item, 'text'),
          key: get(this.item, 'key'),
      }
  },
  inject: ['widgetGroup'],
  created() {
      axios.defaults.baseURL = this.baseUrl;
  },
  methods: {
    handleClick(event) {
      this.optionItem.text = event.target.innerText;
      this.optionItem.value = event.target.dataset.value;
    },
      handleSave() {
        const bvToast = this.$bvToast
        axios.post(`widget/save-widget/${this.key}`, {
              group: this.optionItem.value,
              title: this.title,
              text: this.text
          }).then((res) => {
            bvToast.toast(res.data.message, {
                title: 'Messages',
                autoHideDelay: 5000,
                variant: 'primary'
            })
          }).catch(() => {
            bvToast.toast('Server error', {
                title: 'Messages',
                autoHideDelay: 5000,
                variant: 'danger'
            })
          })
      },
      handleDelete() {
        axios.post(`widget/delete-widget/${this.key}`, {
              group: this.optionItem.value,
              title: this.title,
              text: this.text
          }).then((res) => {
            this.$bvToast.toast(res.data.message, {
                title: 'Messages',
                autoHideDelay: 5000,
                variant: 'primary'
            })
          }).catch(() => {
            this.$bvToast.toast('Server error', {
                title: 'Messages',
                autoHideDelay: 5000,
                variant: 'danger'
            })
          })
      },
      async getErrorResponse(err) {
        if (err.response) {
          const {data, status} = err.response
          if (data instanceof Blob) {
            const dataErr = await data.text().then(str => JSON.parse(str))
            return {
              status,
              message: dataErr.message
            }
          }

          return {
            status,
            message: isEmpty(data.message) ? data.message : 'Server error'
          }
        }
        return null
      }
  }
}
</script>
