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
            <modal-template :show="show" :fullData="this.fullData" @close="show=false" @refresh="refreshDataFromChild"></modal-template>
            <button id="show" @click="show=true" class="button blue">Alap adatok módosítása</button>
        </div>
    </div>
</template>

<script>
    import VueMaterial from 'vue-material'
    import 'vue-material/dist/vue-material.min.css'
    Vue.use(VueMaterial)

    export default {
        name: 'BasicTable',
        props: [ 'basicData' ],
        data: function () {
            return {
                show: false,
                info: null,
                type: null,
                fullData: JSON.parse(this.basicData),
                fullDataValue: null
            }
        },
        methods: {
            refreshDataFromChild: function (value) {
                this.fullDataValue = JSON.parse(value);
            }
        },
        mounted () {
            this.fullDataValue = JSON.parse(this.fullData.value);
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