<template>
    <BuildPoster />
    <Lightbox />
</template>

<script>
import AppLayout from "../Layouts/App.vue";
import BuildPoster from "./Components/BuildPoster.vue"
import Lightbox from "./Components/Lightbox.vue"

export default {
    components: {
        AppLayout,
        BuildPoster, 
        Lightbox
    },
    layout: AppLayout
}
</script>