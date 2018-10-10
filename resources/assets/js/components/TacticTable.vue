<template>
    <div class="w-75 d-inline-block">
        <md-card>
            <md-table class="tactic-table">
                <md-table-toolbar>
                    <h1 class="md-title">Taktikai futtatás</h1>
                </md-table-toolbar>
                <md-table-row>
                    <md-table-cell>Arány: {{ data.proportion }}</md-table-cell>
                    <md-table-cell>Futási idő: {{ data.runtime }}</md-table-cell>
                    <md-table-cell>Győzelem: {{ data.win }}</md-table-cell>
                    <md-table-cell>Vereség: {{ data.lost }}</md-table-cell>
                </md-table-row>
            </md-table>

            <div class="basic-table-buttons">
                <!--<modal-template :show="show" :fullData="this.fullData" @close="show=false" @refresh="refreshDataFromChild"></modal-template>-->
                <button id="show" @click="runTactic" class="button blue">Futtatás</button>
            </div>

            <donut :donutData="donutData"></donut>
            <!--<bar></bar>-->


        </md-card>
            <snackbar ref="snackbar"></snackbar>
            <loader ref="loader"></loader>
    </div>
</template>

<script>
    import VueMaterial from 'vue-material'
    import 'vue-material/dist/vue-material.min.css'

    import Snackbar from './Snackbar'
    import Loader from './Loader'
    import Donut from './charts/Donut'
    Vue.use(VueMaterial)

    export default {
        components: { Donut, Snackbar, Loader },
        props: [ 'tacticData' ],
        name: 'TacticTable',
        data: function () {
            return {
                donutData: [],
                data: []
            }
        },
        methods: {
            runTactic: function() {
                this.$refs.loader.show();
                axios.get('/api/tactic-data')
                .then(response => {
                    this.$refs.loader.hide();
                    console.log(response.data);
                    this.data = response.data;
                    this.donutData = this.getDonutData(response.data);
                })
                .catch((error) => {
                    let message = "Hiba: " + error.message;
                    this.$refs.loader.hide();
                    this.$refs.snackbar.openSnackbar(message, "danger", 6000);
                });
            },
            getDonutData: function (value) {
                return this.donutData = [
                    { label: 'Győzelem', value: value['win'] },
                    { label: 'Vereség', value: value['lost'] },
                ];
            }
        },
        mounted () {
            this.data = JSON.parse(this.tacticData);
            this.donutData = this.getDonutData(this.data);
        }
    }
</script>

<style>
</style>