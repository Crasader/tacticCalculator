<template>
    <div class="w-75 d-inline-block">
        <md-card>
            <div class="modal-header">
                <h3>Media Library</h3>
            </div>
            <md-field>
                <label>Only images</label>
                <!--<input class="upload-file-input" type="file" @change="onFileChanged">-->
                <md-file @change="onFileChanged" accept="image/*" />
            </md-field>
            <md-card-actions>
                <md-button class="md-raised" @click="onUpload">Feltöltés</md-button>
            </md-card-actions>
        </md-card>
        <div>
            <snackbar ref="snackbar"></snackbar>
            <loader ref="loader"></loader>
        </div>

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
            single: null,
            selectedFile: null
        }),
        methods: {
            onFileChanged (event) {
                this.selectedFile = event.target.files[0]
            },
            onUpload() {
                // upload file
                console.log(this.selectedFile);
                //axios.post('api/image-upload', this.selectedFile);
                axios.post('/api/image-upload', {
                    'data': {
                        'type': 'image',
                        'attributes': {
                            'image': "aaa"//json_encode(this.selectedFile)
                        }
                    }
                })
                .then((response) => {
                    this.$refs.snackbar.openSnackbar("Sikeres mentés!", "success");
                    this.$emit('refresh', response.data.value);
                    this.close();
                    this.$refs.loader.hide();
                })
                .catch((error) => {
                    this.$refs.loader.hide();
                    let message = "Hiba: " + error.message;
                    this.$refs.snackbar.openSnackbar(message, "danger", 6000);
                });
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