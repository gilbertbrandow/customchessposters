<template>
    <section>
        <div class="container">
            <div class="poster__builder">

                <div class="poster__module">
                    <div class="module__header"><h2>Create Your Poster</h2><Link class="link-arrow is--low-op" :href="route('home.index')">How does it work? <img class="link-arrow__icn" src="../../../../public/images/icons/arrow-up.svg" alt=""></Link> </div>
                    <div class="module__step">
                        <h3>1. Your Design</h3>
                        <p>Choose a theme for your poster from the list below:</p>
                        <ul class="themes">

                            <li class="theme is--active">
                                <div class="theme__colour-wrp"><div class="theme__colour"><div></div><div></div></div></div>
                                <div class="theme__text"><h4>New Waves</h4><p>Warm & modern</p></div>
                            </li>

                            <li class="theme">
                                <div class="theme__colour-wrp"><div class="theme__colour"><div></div><div></div></div></div>
                                <div class="theme__text"><h4>Old Knowledge</h4><p>Vintage & nostalgic</p></div>
                            </li>

                        </ul>

                        <div class="message">
                            <div><img src="/images/icons/close.svg"/></div>
                            <h4>Don't sweat it if you feel unsure</h4>
                            <p>You can always come back to this section down the road and jump between steps as you need before you are completely happy with the result. </p>

                        </div>
                    </div>
                    <div class="module__navigation">
                        <div class="module__buttons">
                            <div class="link-arrow is--low-op">Go back <img class="link-arrow__icn" src="../../../../public/images/icons/back.svg" alt=""></div>
                            <div class="next__button"><div class="button is--black">Next Step <img src="../../../../public/images/icons/right-arrow-white.svg" alt=""></div></div>
                        </div>
                        <div class="module__progress-wrp">
                            <div class="module__progress">
                                <div class="progress__bar"><div class="progress__bar-indicator"></div></div>
                                <div class="progress__step is--filled">1 <div>Your design</div></div>
                                <div class="progress__step is--filled">2 <div>The Moves</div></div>
                                <div class="progress__step">3 <div>The Position</div></div>
                                <div class="progress__step">4 <div>The Game</div></div>
                            </div>
                            </div>
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