<template>
    <section>
        <div class="container is--flex">
            <div class="content">
                <h2>Frequently Asked Questions</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum
                    tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero
                    vitae
                    erat.</p>
                <Link class="link-arrow" href="/contact">Still have questions? Contact us <img class="link-arrow__icn"
                    src="../../../public/images/icons/arrow-up.svg" alt=""></Link>
            </div>
            <div class="questions">
                <div v-for="faq in faqs" :key="faq.id" class="question-wrp">
                    <div class="question"><h3 v-text="faq.question"></h3><div class="question__icon"><img src="../../../public/images/icons/dropdown.svg" alt=""></div>

                    </div>
                    <div class="answer">
                        <p v-text="faq.answer"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>

export default {

    props: {
        faqs: Array
    }
}

</script>