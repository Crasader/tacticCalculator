<template>
    <div class="modal-mask" @click="close" v-show="show">
        <div class="modal-container" @click.stop>
            <div class="modal-header">
                <h3>Alap adatok módosítása</h3>
            </div>
            <div class="modal-body">
                <label class="form-label">
                    Induló tőke
                    <input type="text" class="form-control" v-bind:value="data[0].value">
                    <md-tooltip md-direction="top">Top</md-tooltip>
                </label>
                <label class="form-label">
                    Cél tőke
                    <input type="number" v-bind:value="data[1].value" class="form-control" placeholder="finishMoney">
                </label>
                <label class="form-label">
                    Szorzó
                    <input type="number" v-bind:value="data[2].value" class="form-control" placeholder="odds">
                </label>
            </div>
            <div class="modal-footer text-right">
                <button class="modal-default-button green button" @click="savePost()">
                    Mentés
                </button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        template: '#modal-template',
        props: ['show', 'fullData'],
        data: function () {
            return {
                startMoney: 'AA',
                finishMoney: '',
                odds: '',
                data: JSON.parse(this.fullData[0].value)
            };
        },
        methods: {
            close: function () {
                this.$emit('close');
                this.startMoney = '';
                this.finishMoney = '';
            },
            savePost: function () {
                // Some save logic goes here...
                console.log('addasasd');
                axios.patch('/api/basic-data/basic-data', {
                    'data': {
                        'type': this.type,
                        'attributes': {
                            'startMoney': this.startMoney,
                            'finishMoney': this.finishMoney,
                            'odds': this.odds
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
            }
        },
        mounted: function () {

            document.addEventListener("keydown", (e) => {
                if (this.show && e.keyCode == 27) {
                    this.close();
                }
            });
        }
    }
</script>

<style>
    .modal-mask {
        text-align: left;
    }
    .modal-container {
        width: 380px;
    }
</style>