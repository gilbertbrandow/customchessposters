<template>
<section class="hero">
    <div class="container">
        <h1>{{title}}</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. </p>
        <div class="button-wrp">
            <button href="" class="is--black">Create your own custom poster</button>
            <button href="">Refresh design <img src="/images/icons/refresh.svg" alt="" class=""></button>
        </div>
    </div>
    <div class="poster">
        <img src="/images/environments/warm.webp" alt="" class="poster__environment">
        <div class="poster__svg-wrp">
            <img src="/images/posters/poster-test.svg" alt="" class="poster__img">
        </div>
    </div>
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

<section>
    <div class="container"></div>
</section>

</template>

<script setup>
const title = 'Create your own personal & unique chess poster.';
</script>