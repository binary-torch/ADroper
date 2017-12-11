<template>
    <div class="ui dimmer active loader-balls">
        <div class="loading-balls"></div>
    </div>
</template>

<script>
    export default {

    }
</script>

<style>
    .loader-balls{
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
    }

    .loader-balls > .loading-balls{
        width: 50px;
        height: 50px;
        animation: rotate 1s linear infinite;
    }

    .loader-balls > .loading-balls:before,
    .loader-balls > .loading-balls:after{
        content: '';
        width: 20px;
        height: 20px;
        display: block;
        border-radius: 50%;
    }

    .loader-balls > .loading-balls:before{
        animation: ball1 1s infinite;
        background-color: #cb2025;
        box-shadow: 30px 0 0 #f8b334;
        margin-bottom: 10px;
    }

    .loader-balls > .loading-balls:after{
        animation: ball2 1s infinite;
        background-color: #00a096;
        box-shadow: 30px 0 0 #97bf0d;
        margin-bottom: 10px;
    }

    @keyframes rotate{
        0% {
            -webkit-transform: rotate(0deg) scale(0.8);
            -moz-transform: rotate(0deg) scale(0.8);
        }
        50% {
            -webkit-transform: rotate(360deg) scale(1.2);
            -moz-transform: rotate(360deg) scale(1.2);
        }
        100% {
            -webkit-transform: rotate(720deg) scale(0.8);
            -moz-transform: rotate(720deg) scale(0.8);
        }
    }

    @keyframes ball1 {
        0% {
            box-shadow: 30px 0 0 #f8b334;
        }
        50% {
            box-shadow: 0 0 0 #f8b334;
            margin-bottom: 0;
            -webkit-transform: translate(15px,15px);
            -moz-transform: translate(15px, 15px);
        }
        100% {
            box-shadow: 30px 0 0 #f8b334;
            margin-bottom: 10px;
        }
    }

    @keyframes ball2 {
        0% {
            box-shadow: 30px 0 0 #97bf0d;
        }
        50% {
            box-shadow: 0 0 0 #97bf0d;
            margin-top: -20px;
            -webkit-transform: translate(15px,15px);
            -moz-transform: translate(15px, 15px);
        }
        100% {
            box-shadow: 30px 0 0 #97bf0d;
            margin-top: 0;
        }
    }
</style>