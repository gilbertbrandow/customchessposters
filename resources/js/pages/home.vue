<template>
<AppLayout>
<section class="section__hero">
    <div class="container">
        <h1>Create your own personal & unique chess poster.</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. </p>
        <div class="button-wrp">
            <Link href="" class="button is--black">Create your own custom poster</Link>
            <Link href="" class="button" >Refresh design <img src="/images/icons/refresh.svg" alt=""></Link>
        </div>
    </div>
    <div class="poster">
        <img src="/images/environments/warm.webp" alt="" class="poster__environment">
        <div class="poster__svg-wrp">
            <img src="/images/posters/poster-test.svg" alt="" class="poster__img">
        </div>
    </div>
</section>

<Faq>
</Faq>

<section>
    <div class="container"></div>
</section>

<section>
    <div class="container"></div>
</section>

<section>
    <div class="container"></div>
</section>

<section>
    <div class="container"></div>
</section>

</AppLayout>
</template>

<script>
import AppLayout from "../Layouts/App.vue";
import Faq from "../Components/Faq.vue";

export default {
    components: {
        AppLayout, 
        Faq,
    }
}
</script>