<template>
    <AppLayout>
        <section class="is--pt">
            <div class="container">
                <h1>Account</h1>
                <Link :href="route('auth.logout')" method="post" as="button"> Log out</Link>

            </div>
        </section>
    </AppLayout>
</template>

<script>
import { onMounted } from "vue";
import AppLayout from "../../Layouts/App.vue";

export default {
    components: {
        AppLayout
    }
}
</script>