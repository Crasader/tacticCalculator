<template>
    <div class="basic-table w-24 d-inline-block">
        <md-card>
            <md-table class="">
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

            <md-card-actions>
                <div class="basic-table-buttons">
                    <button id="show" @click="show=true" class="button blue">Alap adatok módosítása</button>
                </div>
            </md-card-actions>
        </md-card>
        <modal-template :show="show" :fullData="this.fullData" @close="show=false" @refresh="refreshDataFromChild"></modal-template>
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
        }
    }
</script>

<style>
.basic-table {
    margin: auto;
    margin-left: 30px;
    vertical-align: top;
}
.basic-table-buttons {
    text-align: right;
}
</style>