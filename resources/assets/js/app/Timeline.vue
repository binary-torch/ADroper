<template>
    <li>
        <span></span>
        <div>
            {{ title }}
        </div>
        <span class="number">
            <span>{{ start }}</span>
            <span>{{ end }}</span>
        </span>
    </li>
</template>

<script>
    export default {
        props: ['title', 'start', 'end']
    }
</script>