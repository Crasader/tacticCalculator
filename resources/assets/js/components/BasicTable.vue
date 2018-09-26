<template>
    <div>
        <md-table class="basic-table">
            <md-table-toolbar>
                <h1 class="md-title">Default Data</h1>
            </md-table-toolbar>
            <md-table-row>
                <md-table-head md-numeric>ID</md-table-head>
                <md-table-head>Key</md-table-head>
                <md-table-head>Value</md-table-head>
            </md-table-row>

            <md-table-row v-for="datak in bData.data" v-bind:key="datak.id">
                <md-table-cell md-numeric>{{ datak.id }}</md-table-cell>
                <md-table-cell>{{ datak.key }}</md-table-cell>
                <md-table-cell md-numeric>{{ datak.value }}</md-table-cell>
            </md-table-row>
        </md-table>
    </div>
</template>

<script>
    import VueMaterial from 'vue-material'
    import 'vue-material/dist/vue-material.min.css'

    // import Vue from 'vue'
    import axios from 'axios'
    import VueAxios from 'vue-axios'

    Vue.use(VueMaterial)
    Vue.use(VueAxios, axios)
    export default {
        name: 'BasicTable',
        props: [ 'basicData' ],
        data() {
            return {
                info: null,
                bData: JSON.parse(this.basicData)
            }
        },
        methods: {
            calculate: function () {
                console.log("asdadsads");
            },
        },
        mounted () {
            axios
                .get('http://localhost/api/basic-data')
                .then(response =>
                    { this.info = response.data }
                );
        }
    }
</script>

<style>
.basic-table {
    width: 40%;
    margin: auto;
    border: 1px solid lightgrey;
}
tbody .md-table-row td {
    border-top: 1px solid lightgray;
}
</style>