<template>
    <div class="modal-mask" @click="close" v-show="show">
        <div class="modal-container w-50" @click.stop>
            <div class="modal-header">
                <h3>Alap adatok módosítása</h3>
            </div>
            <div class="modal-body">
                <md-field :class="getValidationClass('startMoney')" >
                    <label for="start-money">Induló tőke</label>
                    <md-input type="number" name="start-money" id="start-money" autocomplete="given-name" v-model="list.startMoney" :disabled="sending" required/>
                    <span class="md-error" v-if="!$v.list.startMoney.required">Kötelező mező!</span>
                    <span class="md-error" v-else-if="!$v.list.startMoney.between">A {{$v.list.startMoney.$params.between.min}} és {{$v.list.startMoney.$params.between.max}} közötti érték lehetséges!</span>
                    <span class="md-error" v-else-if="!$v.list.startMoney.minlength">Helytelen érték</span>
                </md-field>
                <md-field :class="getValidationClass('finishMoney')" >
                    <label for="finish-money">Cél tőke</label>
                    <md-input type="number" name="start-money" id="finish-money" autocomplete="given-name" v-model="list.finishMoney" :disabled="sending" required/>
                    <span class="md-error" v-if="!$v.list.finishMoney.required">Kötelező mező!</span>
                    <span class="md-error" v-else-if="!$v.list.finishMoney.between">A {{$v.list.finishMoney.$params.between.min}} és {{$v.list.finishMoney.$params.between.max}} közötti érték lehetséges!</span>
                    <span class="md-error" v-else-if="!$v.list.finishMoney.minlength">Helytelen érték</span>
                </md-field>
                <md-field :class="getValidationClass('odds')" >
                    <label for="odds">Szorzó</label>
                    <md-input step="0.01" type="number" name="odds" id="odds" autocomplete="given-name" v-model="list.odds" :disabled="sending" required/>
                    <span class="md-error" v-if="!$v.list.odds.required">Kötelező mező!</span>
                    <span class="md-error" v-else-if="!$v.list.odds.between">A {{$v.list.odds.$params.between.min}} és {{$v.list.odds.$params.between.max}} közötti érték lehetséges!</span>
                </md-field>
                <md-field :class="getValidationClass('rounds')" >
                    <label for="odds">Körök</label>
                    <md-input step="1" type="number" name="rounds" id="round" autocomplete="given-name" v-model="list.rounds" :disabled="sending" required/>
                    <span class="md-error" v-if="!$v.list.rounds.required">Kötelező mező!</span>
                    <span class="md-error" v-else-if="!$v.list.rounds.between">A {{$v.list.rounds.$params.between.min}} és {{$v.list.rounds.$params.between.max}} közötti érték lehetséges!</span>
                </md-field>
            </div>
            <div class="modal-footer text-right">
                <button class="modal-default-button green button" @click="validateUser">
                    Mentés
                </button>
            </div>

            <snackbar ref="snackbar"></snackbar>
            <loader ref="loader"></loader>
        </div>
    </div>
</template>

<script>
    import { validationMixin } from 'vuelidate'
    import Snackbar from './Snackbar'
    import Loader from './Loader'
    import { required, minLength, maxLength, between } from 'vuelidate/lib/validators'

    export default {
        components: { Snackbar, Loader },
        props: ['show', 'fullData'],
        mixins: [validationMixin],
        data: () => ({
            list: {
                startMoney: null,
                finishMoney: null,
                odds: null
            },
            sending: false,
        }),
        validations: {
            list: {
                startMoney: {
                    required,
                    minLength: minLength(2),
                    maxLength: maxLength(10),
                    between: between(500, 50000)
                },
                finishMoney: {
                    required,
                    minLength: minLength(2),
                    maxLength: maxLength(10),
                    between: between(500, 50000)
                },
                odds: {
                    required,
                    between: between(0.5, 2.01)
                },
                rounds: {
                    required,
                    between: between(1, 1000)
                },
            }
        },
        methods: {
            getValidationClass (fieldName) {
                const field = this.$v.list[fieldName]
                if (field) {
                    return {
                        'md-invalid': field.$invalid && field.$dirty
                    }
                }
            },
            clearForm () {
                this.$v.$reset()
                this.list.startMoney = null
            },
            validateUser () {
                this.$v.$touch()
                if (!this.$v.$invalid) {
                    this.savePost()
                }
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
            },
            savePost: function () {
                this.$refs.loader.show();
                axios.patch('/api/basic-data/' + this.fullData.id, {
                    'data': {
                        'id': this.fullData.id,
                        'type': this.fullData.type,
                        'attributes': {
                            'startMoney': this.list.startMoney,
                            'finishMoney': this.list.finishMoney,
                            'odds': this.list.odds,
                            'rounds': this.list.rounds,
                        }
                    }
                })
                .then((response) => {
                    this.$refs.loader.hide();
                    this.$refs.snackbar.openSnackbar("Sikeres mentés!", "success");
                    this.$emit('refresh', response.data.value);
                    this.close();
                })
                .catch((error) => {
                    let message = "Hiba: " + error.message;
                    this.$refs.snackbar.openSnackbar(message, "danger", 6000);
                });
            },
        },
        mounted: function () {
            //mounted data from backend
            this.list = JSON.parse(this.fullData.value)
            this.closeModalListener();
            let product = "balbal";
            this.$emit('clicked-show-detail', product);
        }
    }
</script>

<style lang="scss" scoped>
</style>