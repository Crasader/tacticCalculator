<template>
    <div class="modal-mask" @click="close" v-show="show">
        <div class="modal-container" @click.stop>
            <div class="modal-header">
                <h3>Alap adatok módosítása</h3>
            </div>
            <div class="modal-body">
                <label class="form-label">
                    Induló tőke
                    <input type="number" class="form-control" v-model="list.startMoney">
                </label>
                <label class="form-label">
                    Cél tőke
                    <input type="number" v-model="list.finishMoney" class="form-control" placeholder="finishMoney">
                </label>
                <label class="form-label">
                    Szorzó
                    <input type="number" v-model="list.odds" class="form-control" placeholder="odds">
                </label>
            </div>
            <div class="modal-footer text-right">
                <button class="modal-default-button green button" @click="checkForm">
                    Mentés
                </button>
            </div>

            <snackbar ref="snackbar"></snackbar>
        </div>

    </div>
</template>
<script>
    import { Snackbar } from './Snackbar.vue';
    export default {
        components: Snackbar,
        props: ['show', 'fullData'],
        data: function () {
            return {
                list: [],
                fullDataValue: JSON.parse(this.fullData.value),
            };
        },
        methods: {
            checkForm: function (e) {
                let success = true;
                if(!this.list.startMoney || !this.list.finishMoney || !this.list.odds) {
                    success = false;
                    return console.log("üres");
                }
                console.log(this.list.odds*1);
                if(this.list.odds*1 > 2.2 || this.list.odds*1 < 1.6) {
                    return console.log("tul nagy occ")
                }

            },
            savePost: function () {
                axios.patch('/api/basic-data/' + this.fullData.id, {
                    'data': {
                        'id': this.fullData.id,
                        'type': this.fullData.type,
                        'attributes': {
                            'startMoney': this.list.startMoney,
                            'finishMoney': this.list.finishMoney,
                            'odds': this.list.odds
                        }
                    }
                })
                    .then((response) => {
                        this.$refs.snackbar.openSnackbar("Sikeres mentés!", "success");
                        this.$emit('refresh', response.data.value);
                        this.close();
                    })
                    .catch((error) => {
                        let message = "Hiba: " + error.message;
                        this.$refs.snackbar.openSnackbar(message, "danger", 6000);
                    });
            },
            close: function () {
                this.$emit('close');
            },
            closeModalListener: function () {
                document.addEventListener("keydown", (e) => {
                    if (this.show && e.keyCode == 27) {
                        this.close();
                    }
                });
            }
        },
        mounted: function () {
            //mounted data from backend
            let list = [];
            $.each(this.fullDataValue, function (key, value) {
                list[key] = value;
            });
            this.list = list;
            this.closeModalListener();
            let product = "balbal";
            this.$emit('clicked-show-detail', product);

        }
    }
</script>

<style>
    .modal-mask {
        text-align: left;
    }
    .modal-container {
        margin-top: 15%;
        width: 380px;
    }
</style>