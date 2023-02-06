<template>
    <section>
        <div class="container">
            <div class="poster__builder">

                <div class="poster__module">
                    <div class="module__header">
                        <h2>Create Your Poster</h2>
                        <Link class="link-arrow is--low-op" :href="route('home.index')">How does it work? <img
                            class="link-arrow__icn" src="../../../../public/images/icons/arrow-up.svg" alt=""></Link>
                    </div>
                    <div class="module__mask">
                        <div class="module__step">
                            <h3>1. Your Design</h3>
                            <p>Choose a theme for your poster from the list below:</p>
                            <ul class="themes">

                                <li class="theme is--active">
                                    <div class="theme__colour-wrp">
                                        <div class="theme__colour">
                                            <div></div>
                                            <div></div>
                                        </div>
                                    </div>
                                    <div class="theme__text">
                                        <h4>New Waves</h4>
                                        <p>Warm & modern</p>
                                    </div>
                                </li>

                                <li class="theme">
                                    <div class="theme__colour-wrp">
                                        <div class="theme__colour">
                                            <div></div>
                                            <div></div>
                                        </div>
                                    </div>
                                    <div class="theme__text">
                                        <h4>Old Knowledge</h4>
                                        <p>Vintage & nostalgic</p>
                                    </div>
                                </li>

                            </ul>

                            <div class="message">
                                <div><img src="/images/icons/close.svg" /></div>
                                <h4>Don't sweat it if you feel unsure</h4>
                                <p>You can always come back to this section down the road and jump between steps as you
                                    need before you are completely happy with the result. </p>

                            </div>
                        </div>
                        <div class="module__step">
                            <h3>2. The Moves</h3>
                            <p>Insert the moves of the game</p>
                        </div>
                        <div class="module__step">
                            <h3>3. The Position</h3>
                            <p>Choose which position of the game you will share with the world!</p>
                        </div>
                        <div class="module__step">
                            <h3>4. The Game</h3>
                            <p>Other interesting information to give your poster some more backstory.</p>
                        </div>
                    </div>
                    <div class="module__navigation">
                        <div class="module__buttons">
                            <div class="link-arrow is--low-op is--visible" @click="prevStep">Go back <img class="link-arrow__icn" src="../../../../public/images/icons/back.svg" alt=""></div>

                            <div class="button is--black" @click="nextStep">Next Step <img src="../../../../public/images/icons/right-arrow-white.svg" alt=""></div>
                            <div class="button is--black">Add to cart <img src="../../../../public/images/icons/bag-white.svg" alt=""></div>

                        </div>
                        <div class="module__progress-wrp">
                            <div class="module__progress">
                                <div class="progress__bar">
                                    <div class="progress__bar-indicator"></div>
                                </div>
                                <div class="progress__step">1 <div>Your design</div>
                                </div>
                                <div class="progress__step">2 <div>The Moves</div>
                                </div>
                                <div class="progress__step">3 <div>The Position</div>
                                </div>
                                <div class="progress__step">4 <div>The Game</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="poster">
                    <div class="poster__buttons-wrp">
                        <div class="button">Full screen<img src="/images/icons/full-screen.svg" /></div>
                        <div class="button"> Save this design <img src="/images/icons/bookmark-black.svg" /></div>
                    </div>
                    <div class="poster__svg-wrp"><img src="/images/posters/poster-test.svg" /></div>
                    <img class="poster__environment" src="/images/environments/builder-mockup.jpeg" />
                </div>

            </div>
        </div>
    </section>
</template>

<script>
import { onMounted } from 'vue';
</script>

<script setup>

onMounted(() => {
    changeStep(0);
});

function getIndexOfCurrentStep() {
    let mask = document.querySelector('.module__mask');
    let currentStep = document.querySelector('.module__step.is--active');
    let index = Array.prototype.indexOf.call(mask.children, currentStep);
    return index;
}

function changeStep(index) {

    let steps = document.querySelectorAll('.module__step');
    let active = steps.item(index);
    let buttons = document.querySelector('.module__buttons').children;
    let progressSteps = document.querySelectorAll('.progress__step');
    let progressBar = document.querySelector('.progress__bar-indicator');
    let width = (index / 3 * 100) + "%";
    if(index == 0) width = "5%";

    if (document.querySelector('.module__step.is--active')) { document.querySelector('.module__step.is--active').classList.remove('is--active'); }
    active.classList.add('is--active');

    for (let i = 0; i < progressSteps.length; i++) {

        progressSteps[i].classList.remove('is--active');

        if(i == index) {
            progressSteps[i].classList.add('is--active');
        }
        else if(i < index) {
            progressSteps[i].classList.add('is--passed');
        }
        else if(i > index){
            progressSteps[i].classList.remove('is--passed');
        }
    }

   progressBar.style.width = width;

    if (index == 0) {
        buttons[0].classList.remove('is--visible')
    } else if (!buttons[0].classList.contains('is--visble')) {
        buttons[0].classList.add('is--visible')
    }

    if (index == 3) {
        buttons[1].classList.remove('is--visible')
        buttons[2].classList.add('is--visible')
    } else if (!buttons[1].classList.contains('is--visible')) {
        buttons[1].classList.add('is--visible')
    } 
    
    if(index != 3){
        buttons[2].classList.remove('is--visible')
    }


}

function nextStep() {
    changeStep(getIndexOfCurrentStep() + 1);
}

function prevStep() {
    changeStep(getIndexOfCurrentStep() - 1);
}

</script>