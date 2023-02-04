<template>
    <section>
        <div class="container">
            <div class="poster__builder">

                <div class="poster__module">
                    <div class="poster__header"><h2>Create Your Poster</h2><Link class="link-arrow is--low-op" :href="route('home.index')">How does it work? <img class="link-arrow__icn" src="../../../../public/images/icons/arrow-up.svg" alt=""></Link> </div>
                    <div class="poster__step"></div>
                    <div class="poster__navigation">
                        <div class="poster__buttons">
                            <div class="link-arrow is--low-op">Go back <img class="link-arrow__icn" src="../../../../public/images/icons/back.svg" alt=""></div>
                            <div class="next__button"><div class="button is--black">Next Step <img src="../../../../public/images/icons/right-arrow-white.svg" alt=""></div></div>
                        </div>
                        <div class="poster__progress-wrp"><div class="poster__progress">01 <div class="progress-bar-wrp"><div class="progress-bar"></div></div> 04 </div></div>
                    </div>
                </div>

                <div class="poster">
                    <div class="poster__buttons-wrp"><div class="button">Full screen<img src="/images/icons/full-screen.svg"/></div> <div class="button"> Save this design <img src="/images/icons/bookmark-black.svg"/></div></div>
                    <div class="poster__svg-wrp"><img src="/images/posters/poster-test.svg"/></div>
                    <img class="poster__environment" src="/images/environments/builder-mockup.jpeg"/>
                </div>

            </div>
        </div>
    </section>
</template>

<script>
</script>