<template>
    <AppLayout>
        <section class="is--pt">
            <div class="container">
                <h1>Thank you {{ $page.props.profile.name }} for your message!</h1>
                <p>We have recieved it and we will be in touch as soon as we can.</p>
            </div>
        </section>
    </AppLayout>
</template>

<script>
import AppLayout from "../Layouts/App.vue";

export default {
    components: {
        AppLayout
    },
}
</script>