<template>
    <div class="modal-mask" @click="close" v-show="show">
        <div class="modal-container" @click.stop>
            <div class="modal-header">
                <h3>Alap adatok módosítása</h3>
            </div>
            <div class="modal-body">
                <md-field :class="getValidationClass('startMoney')">
                    <label for="start-money">Induló tőke</label>
                    <md-input name="start-money" id="start-money" autocomplete="given-name" v-model="list.startMoney" :disabled="sending" required/>
                    <span class="md-error" v-if="!$v.list.startMoney.required">Kötelező mező!</span>
                    <span class="md-error" v-else-if="!$v.list.startMoney.between">A {{$v.list.startMoney.$params.between.min}} és {{$v.list.startMoney.$params.between.max}} közötti érték lehetséges!</span>
                    <span class="md-error" v-else-if="!$v.list.startMoney.minlength">Helytelen érték</span>
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
            fullDataValue: [],
        }),
        validations: {
            list: {
                startMoney: {
                    required,
                    minLength: minLength(2),
                    maxLength: maxLength(10),
                    between: between(500, 30000)
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