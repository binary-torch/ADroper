<template>
    <div :class="['progress', 'progress-line-' + type]">
        <div :class="['progress-bar', 'progress-bar-' + type]" role="progressbar" :style="percentageComplete">
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            percentage: {
                type: Number,
                default: 0
            },
            type:{
                type: String,
                default: "success"
            }
        },
        computed: {
            percentageComplete: function () {
                return "width: " + this.percentage + "%";
            }
        }
    }
</script>