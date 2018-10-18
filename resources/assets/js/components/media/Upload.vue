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
            <md-field class="image-preview" >
                <div class="media-image-upload" v-if="imageData.length > 0">
                    <img class="preview" :src="imageData">
                </div>
                <div v-else class="media-image-upload no-image"></div>
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
            imageData: ""
        }),
        methods: {
            onFileChanged (event) {
                this.selectedFile = event.target.files[0]
                var input = event.target;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = (e) => {
                        this.imageData = e.target.result;
                        console.log(e.target.result);

                    }
                    reader.readAsDataURL(input.files[0]);
                }
            },
            onUpload() {
                // upload file
                this.$refs.loader.show();
                console.log(this.selectedFile);
                axios.post('/api/image-upload', {
                    'data': {
                        'type': 'image',
                        'attributes': {
                            'image': this.imageData
                        }
                    }
                })
                .then((response) => {
                    this.$refs.loader.hide();
                    this.$refs.snackbar.openSnackbar(response.data.value, "success");
                    this.$emit('refresh');
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
.file-upload-form, .image-preview {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    padding: 20px;
}
img.preview {
    background-color: white;
    padding: 5px;
    height: 148px;
    margin: auto;
}

.media-image-upload {
    border: 1px solid #DDD;
    width: 300px;
    height: auto;
    margin: auto;
}

.no-image {
    background-image: url('/img/No_Image_Available.png');
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    min-height: 200px;
}

</style>