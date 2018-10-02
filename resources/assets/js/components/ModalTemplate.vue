<template>
    <div class="modal-mask" @click="close" v-show="show">
        <div class="modal-container" @click.stop>
            <div class="modal-header">
                <h3>Alap adatok módosítása</h3>
            </div>
            <div class="modal-body">
                <label class="form-label">
                    Induló tőke
                    <input type="text" class="form-control" v-model="list.startMoney">
                    <md-tooltip md-direction="top">Top</md-tooltip>
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
                <button class="modal-default-button green button" @click="savePost()">
                    Mentés
                </button>
            </div>


            <form novalidate @submit.stop.prevent="showSnackbar = true">
                <md-button type="submit" class="md-primary md-raised">Open Snackbar</md-button>

                <md-snackbar :md-position="position" :md-duration="isInfinity ? Infinity : duration" :md-active.sync="showSnackbar" md-persistent>
                    <span>Connection timeout. Showing limited messages!</span>
                    <md-button class="md-primary" @click="showSnackbar = false">Retry</md-button>
                </md-snackbar>
            </form>


        </div>

    </div>
</template>
<script>
    export default {
        template: '#modal-template',
        name: 'SnackbarExample',
        props: ['show', 'fullData'],
        data: function () {
            return {
                showSnackbar: false,
                position: 'center',
                duration: 4000,
                isInfinity: true,
                list: [],
                fullDataValue: JSON.parse(this.fullData.value),
                // type: this.fullDataValue.type,
                // id: this.fullDataValue.id
            };
        },
        methods: {
            close: function () {
                this.$emit('close');
                this.startMoney = '';
                this.finishMoney = '';
            },
            savePost: function () {
                axios.patch('/api/basic-data/' + this.id, {
                    'data': {
                        'id': this.id,
                        'type': this.type,
                        'attributes': {
                            'startMoney': this.list.startMoney,
                            'finishMoney': this.list.finishMoney,
                            'odds': this.list.odds
                        }
                    }
                })
                    .then(function (response) {
                        console.log(response);
                        this.close();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            closeModal: function () {
                document.addEventListener("keydown", (e) => {
                    if (this.show && e.keyCode == 27) {
                        this.close();
                    }
                });
            }
        },
        mounted: function () {
            let list = [];
            $.each(this.fullDataValue, function (key, value) {
                list[key] = value;
            });
            this.list = list;

            this.closeModal();

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
    .md-snackbar, .md-snackbar-content {
        z-index: 100000;
        background-color: white;
    }
</style>