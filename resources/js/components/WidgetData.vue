<template>
    <b-card class="widget-card">
        <template slot="header">
            <div class="d-flex justify-content-between">
                <span>{{header}}</span>
                <b-dropdown id="dropdown-1" size="sm" :text="optionItem.text" class="m-md-2">
                    <template v-for="item in options">
                        <b-dropdown-item :key="item.value" :data-value="item.value" :active="item.active" @click="handleClick">{{ item.text }}</b-dropdown-item>
                    </template>
                </b-dropdown>
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
import {get} from 'lodash';
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
            header: get(this.item, 'header'),
            title: get(this.item, 'title'),
            text: get(this.item, 'text')
        }
    },
    created() {
        axios.defaults.baseURL = this.baseUrl;
    },
    methods: {
        handleClick(event) {
            this.optionItem.text = event.target.innerText;
            this.optionItem.value = event.target.dataset.value;
        },
        handleSave() {
            axios.post('save-widget', {
                key: get(this.item, 'key'),
                group: this.optionItem.value,
                title: this.title,
                text: this.text
            }).then((res) => {
                // this.$bvToast.toast(`This is toast number ${this.toastCount}`, {
                //     title: 'Messages',
                //     autoHideDelay: 5000,
                // })
            })
        },
        handleDelete() {
            axios.post('delete-widget', {
                key: get(this.item, 'key'),
                group: this.optionItem.value,
                title: this.title,
                text: this.text
            }).then((res) => {
                // this.$bvToast.toast(`This is toast number ${this.toastCount}`, {
                //     title: 'Messages',
                //     autoHideDelay: 5000,
                // })
            })
        },
    }
}
</script>