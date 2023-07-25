<template>
    <Faq :faqs="$page.props.faqs" />
</template>

<script>
    import Faq from "./Components/Faq.vue";
    import AppLayout from "../Layouts/App.vue";

    export default {
        components: {
            Faq, 
        },
        layout: AppLayout
    }
</script>