<template>
    <div>
        <md-snackbar v-bind:class="color" :md-position="position" :md-duration="isInfinity ? Infinity : duration" :md-active.sync="show" md-persistent>
            <span>{{ subText }}</span>
            <md-button class="md-primary" @click="show = false">X</md-button>
        </md-snackbar>
    </div>
</template>
<script>
    export default {
        data: function () {
            return {
                duration: 4000,
                show: false,
                isInfinity: false,
                subText: "",
                color: "success",
                position: "center"
            };
        },
        methods: {
            openSnackbar (text, color, duration = 4000) {
                this.color = color;
                this.subText = text;
                this.duration = duration;
                this.show = true;
            }
        }
    }
</script>

<style>
    .md-snackbar, .md-snackbar-content {
        z-index: 100000;
    }
    .success {
        background-color: #DEF0D9;
        color: #347641;
    }
    .danger {
        background-color: #F4DEDE;
        color: #AF4445;
    }
    .warning {
        background-color: #FDF8E4;
        color: #8D6D40;
    }
    .md-button.md-theme-default.md-primary {
        color: white;
    }
</style>