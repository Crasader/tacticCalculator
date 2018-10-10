<template>
    <div class="w-75 d-inline-block">
        <md-card>
            <md-table class="tactic-table">
                <md-table-toolbar>
                    <h1 class="md-title">Taktikai futtatás</h1>
                </md-table-toolbar>

            </md-table>

            <div class="basic-table-buttons">
                <!--<modal-template :show="show" :fullData="this.fullData" @close="show=false" @refresh="refreshDataFromChild"></modal-template>-->
                <!--<button id="show" @click="show=true" class="button blue">Alap adatok módosítása</button>-->
            </div>

            <donut :donutData="donutData"></donut>
            <!--<bar></bar>-->
        </md-card>
    </div>
</template>

<script>
    import VueMaterial from 'vue-material'
    import 'vue-material/dist/vue-material.min.css'

    import Donut from './charts/Donut'
    Vue.use(VueMaterial)

    export default {
        components: { Donut },
        name: 'TacticTable',
        data: function () {
            return {
                donutData: [
                    { label: 'Red', value: 10 },
                    { label: 'Blue', value: 50 },
                    { label: 'Yellow', value: 100 }
                ],
            }
        },
        methods: {

        },
        mounted () {
        }
    }
</script>

<style>
</style>