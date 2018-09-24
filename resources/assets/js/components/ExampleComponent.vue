<template>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                Welcome to Vue.js on Laravel {{title}}
            </div>

        </div>

        <modal name="modal"
               @before-open="beforeOpen">
            <div style="padding:30px; text-align: center">
                Hello!
            </div>
        </modal>

    </div>
</template>
<script>
    export default {
        props : ['title'],
        methods: {
            launchModal() {
                console.log("KLICK");
            },
            beforeOpen () {
                this.$modal.show('hello-world');
            },
            hide () {
                this.$modal.hide('hello-world');
            }
        }
    }
</script>
<style scoped>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 1vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 24px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>