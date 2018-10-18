<template>
    <div class="w-75 d-inline-block">
        <md-card>
            <div class="modal-header">
                <h3>Media List</h3>
            </div>
            <md-card class="mini-card" v-for="image in images">
                <md-card-media>
                    <md-ripple>
                        <img :src="image" class="mini-card-img" alt="blabla">
                    </md-ripple>
                </md-card-media>

                <md-card-actions>
                    <md-button class="md-icon-button">
                        <md-icon>favorite</md-icon>
                    </md-button>

                    <md-button class="md-icon-button">
                        <md-icon>bookmark</md-icon>
                    </md-button>

                    <md-button class="md-icon-button">
                        <md-icon>share</md-icon>
                    </md-button>
                </md-card-actions>
            </md-card>
        </md-card>

        <snackbar ref="snackbar"></snackbar>
        <loader ref="loader"></loader>
    </div>
</template>

<script>
    import VueMaterial from 'vue-material'
    import 'vue-material/dist/vue-material.min.css'
    Vue.use(VueMaterial)

    import Snackbar from '../Snackbar'
    import Loader from '../Loader'

    export default {
        components: { Snackbar, Loader },
        data: () => ({
            images: []
        }),
        methods: {
            getImages() {
                this.$refs.loader.show();
                axios.get('/api/images')
                .then(response => {
                    console.log(response.data);
                    this.images = response.data;
                    this.$refs.loader.hide();
                })
                .catch((error) => {
                    let message = "Hiba: " + error.message;
                    this.$refs.snackbar.openSnackbar(message, "danger", 6000);
                    this.$refs.loader.hide();
                });
            }
        },
        mounted () {
            this.getImages();
        }
    }
</script>

<style>
.mini-card {
    height: 260px;
    width: 45%;
    margin: 12px;
    display: inline-block;
}
.md-card-media img {
    height: auto;
    max-height: 200px;
    width: auto;
}
</style>