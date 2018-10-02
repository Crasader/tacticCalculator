<template>
    <div>
        <md-table class="basic-table">
            <md-table-toolbar>
                <h1 class="md-title">Alap adatok</h1>
            </md-table-toolbar>
            <md-table-row>
                <md-table-head>Kulcs</md-table-head>
                <md-table-head>Érték</md-table-head>
            </md-table-row>

            <md-table-row v-for="(data, index) in fullDataValue" v-bind:key="index">
                <md-table-cell>{{ index }}</md-table-cell>
                <md-table-cell md-numeric>{{ data }}</md-table-cell>
            </md-table-row>
        </md-table>

        <div class="basic-table-buttons">
            <modal-template :show="show" :fullData="this.fullData" @close="show=false"></modal-template>
            <button id="show" @click="show=true" class="button blue">Alap adatok módosítása</button>
        </div>
    </div>
</template>

<script>
    import VueMaterial from 'vue-material'
    import 'vue-material/dist/vue-material.min.css'
    import axios from 'axios'
    import VueAxios from 'vue-axios'

    Vue.use(VueMaterial)
    Vue.use(VueAxios, axios)
    export default {
        name: 'BasicTable',
        props: [ 'basicData' ],
        data() {
            return {
                show: false,
                info: null,
                type: null,
                fullData: JSON.parse(this.basicData),
                fullDataValue: null
            }
        },
        methods: {
            calculate: function () {
                console.log("asdadsads");
            },
        },
        mounted () {
            this.fullDataValue = JSON.parse(this.fullData.value);
            console.log(this.fullDataValue);
            console.log('basic-table');
            // axios
            //     .get('http://localhost/api/basic-data')
            //     .then(response =>
            //         { console.log(response.data) }
            //     );
        }
    }
</script>

<style>
.basic-table {
    margin: auto;
    border: 1px solid lightgrey;
}
tbody .md-table-row td {
    border-top: 1px solid lightgray;
}
.basic-table-buttons {
    text-align: right;
}
</style>