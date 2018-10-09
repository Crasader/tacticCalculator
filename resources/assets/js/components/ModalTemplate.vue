<template>
    <div class="modal-mask" @click="close" v-show="show">
        <div class="modal-container w-50" @click.stop>
            <div class="modal-header">
                <h3>Alap adatok módosítása</h3>
            </div>
            <div class="modal-body">
                <md-field :class="getValidationClass('startMoney')" >
                    <label for="start-money">Induló tőke</label>
                    <md-input name="start-money" id="start-money" autocomplete="given-name" v-model="list.startMoney" :disabled="sending" required/>
                    <span class="md-error" v-if="!$v.list.startMoney.required">Kötelező mező!</span>
                    <span class="md-error" v-else-if="!$v.list.startMoney.between">A {{$v.list.startMoney.$params.between.min}} és {{$v.list.startMoney.$params.between.max}} közötti érték lehetséges!</span>
                    <span class="md-error" v-else-if="!$v.list.startMoney.minlength">Helytelen érték</span>
                </md-field>
                <md-field :class="getValidationClass('finishMoney')" >
                    <label for="finish-money">Cél tőke</label>
                    <md-input name="start-money" id="finish-money" autocomplete="given-name" v-model="list.finishMoney" :disabled="sending" required/>
                    <span class="md-error" v-if="!$v.list.finishMoney.required">Kötelező mező!</span>
                    <span class="md-error" v-else-if="!$v.list.finishMoney.between">A {{$v.list.finishMoney.$params.between.min}} és {{$v.list.finishMoney.$params.between.max}} közötti érték lehetséges!</span>
                    <span class="md-error" v-else-if="!$v.list.finishMoney.minlength">Helytelen érték</span>
                </md-field>
                <md-field :class="getValidationClass('odds')" >
                    <label for="odds">Szorzó</label>
                    <md-input name="odds" id="odds" autocomplete="given-name" v-model="list.odds" :disabled="sending" required/>
                    <span class="md-error" v-if="!$v.list.odds.required">Kötelező mező!</span>
                    <span class="md-error" v-else-if="!$v.list.odds.between">A {{$v.list.odds.$params.between.min}} és {{$v.list.odds.$params.between.max}} közötti érték lehetséges!</span>
                    <span class="md-error" v-else-if="!$v.list.odds.minlength">Helytelen érték</span>
                </md-field>
            </div>
            <div class="modal-footer text-right">
                <button class="modal-default-button green button" @click="validateUser">
                    Mentés
                </button>
            </div>

            <snackbar ref="snackbar"></snackbar>
        </div>
    </div>
</template>

<script>
    import { validationMixin } from 'vuelidate'
    import { Snackbar } from './Snackbar.vue'
    import { required, minLength, maxLength, between } from 'vuelidate/lib/validators'

    export default {
        components: Snackbar,
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
            saveUser () {
                // this.sending = true
                //
                // // Instead of this timeout, here you can call your API
                // window.setTimeout(() => {
                //     this.lastUser = `${this.list.startMoney} ${this.list.lastName}`
                //     this.userSaved = true
                //     this.sending = false
                //     this.clearForm()
                // }, 1500)
            },
            validateUser () {
                this.$v.$touch()

                if (!this.$v.$invalid) {
                    this.saveUser()
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
            }
        },
        mounted: function () {
            //mounted data from backend
            this.list = JSON.parse(this.fullData.value)
            // var list = {};
            // $.each(this.fullDataValue, function (key, value) {
            //
            //     list.push({key: value});
            // });
            // this.list.startMoney = this.fullDataValue.startMoney;
            // console.log(this.fullDataValue);
            // console.log(this.list);
            this.closeModalListener();
            //let product = "balbal";
            //this.$emit('clicked-show-detail', product);
        }
    }
</script>

<style lang="scss" scoped>
</style>