<template>
    <div class="modal-mask" @click="close" v-show="show">
        <div class="modal-container" @click.stop>
            <div class="modal-header">
                <h3>Alap adatok módosítása</h3>
            </div>
            <div class="modal-body">
                <label class="form-label">
                    Induló tőke
                    <input type="number" v-model="startMoney" class="form-control" placeholder="startMoney">
                </label>
                <label class="form-label">
                    Cél tőke
                    <input type="number" v-model="finishMoney" class="form-control" placeholder="finishMoney">
                </label>
                <!--<label class="form-label">-->
                    <!--Body-->
                    <!--<textarea v-model="body" rows="5" class="form-control"></textarea>-->
                <!--</label>-->
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
        props: ['show'],
        data: function () {
            return {
                startMoney: '',
                finishMoney: ''
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

                this.close();
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