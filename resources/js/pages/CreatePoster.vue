<template>
    <BuildPoster />
</template>

<script>
import AppLayout from "../Layouts/App.vue";
import BuildPoster from "./Components/Poster/BuildPoster.vue"

export default {
    components: {
        AppLayout,
        BuildPoster
    },
    layout: AppLayout
}
</script>