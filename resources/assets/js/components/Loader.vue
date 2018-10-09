<template>
    <div class="modal-mask" v-show="showLoader">
        <div class="sk-folding-cube">
            <div class="sk-cube1 sk-cube"></div>
            <div class="sk-cube2 sk-cube"></div>
            <div class="sk-cube4 sk-cube"></div>
            <div class="sk-cube3 sk-cube"></div>
        </div>
    </div>
</template>
<script>
    export default {
        data: function () {
            return {
                showLoader: false,
            };
        },
        methods: {
            show() {
                this.showLoader = true;
            },
            hide(){
                this.showLoader = false;
            }
        }
    }
</script>

<style>
</style>