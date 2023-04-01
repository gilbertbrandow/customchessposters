<template>
    <section class="is--pt">
        <div class="container">
            <h1>Thank you {{ $page.props.profile.auth.user.name }} for your message!</h1>
            <p>We have recieved it and we will be in touch as soon as we can.</p>
        </div>
    </section>
</template>

<script>
import AppLayout from "../Layouts/App.vue";

export default {
    layout: AppLayout
}
</script>