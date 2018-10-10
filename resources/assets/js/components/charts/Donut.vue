<template>
    <donut-chart
            id="donut"
            :data="donutData"
            colors='[ "#FF6384", "#36A2EB", "#FFCE56" ]'
            resize="true">
    </donut-chart>
</template>

<script>
    import Raphael from 'raphael/raphael'
    import { DonutChart } from 'vue-morris'

    global.Raphael = Raphael

    export default {
        components: { DonutChart },
        props: [ 'donutData' ],
        name: 'Donut',
        data: function () {
            return {

            }
        }
    }
</script>

<style scoped>

</style>