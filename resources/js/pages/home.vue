<template>
    <section class="section__hero">
        <div class="container">
            <h1>Create your own personal & unique chess poster.</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum
                tristique. </p>
            <div class="button-wrp">
                <Link href="/create-poster" class="button is--black">Create your own custom poster</Link>
                <Link href="" class="button">Refresh design
                <Icon name="refresh" />
                </Link>
            </div>
        </div>
        <div class="poster">
            <img src="/images/environments/warm.webp" alt="" class="poster__environment">
            <div class="poster__svg-wrp">
                <img src="/images/posters/poster-test.svg" alt="" class="poster__img">
            </div>
        </div>
    </section>

    <BuildPoster />

    <Faq :faqs="$page.props.faqs" />

    <Features />
</template>

<script>
import AppLayout from "../Layouts/App.vue";
import BuildPoster from "./Components/BuildPoster.vue"
import Faq from "./Components/Faq.vue";
import Features from "./Components/Features.vue"
import { onMounted } from 'vue';

export default {
    components: {
        AppLayout,
        BuildPoster,
        Faq,
        Features,
    },
    layout: AppLayout
}
</script>

<script setup>

onMounted(() => {

    const nav = document.querySelector('nav');
    const heroSection = document.querySelector('section');

    const options = {
        root: null,
        threshold: 1,
        rootMargin: "3% 0px 100% 0px",
    }

    const observer = new IntersectionObserver(function (entries, observer) {
        entries.forEach(entry => {
            if ((!nav.classList.length && !entry.isIntersecting)) {
                nav.classList.add('is--scrolled');
            } else {
                nav.classList.remove('is--scrolled');
            }
        })
    }, options);

    observer.observe(heroSection);

});

</script>