<template>
    <div class="w-75 d-inline-block">
        <md-card>
            <div class="modal-header">
                <h3>Media List</h3>
            </div>
            <md-field>

            </md-field>
        </md-card>
    </div>
</template>

<script>
    import VueMaterial from 'vue-material'
    import 'vue-material/dist/vue-material.min.css'
    Vue.use(VueMaterial)

    export default {
        data: () => ({
            single: null
        }),
        methods: {
            onUpload() {
                // upload file
                console.log(this.single);
            }
        },
        mounted () {
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