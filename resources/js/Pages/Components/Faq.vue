<template>
    <section>
        <div class="container is--flex">
            <div class="content">
                <h2>Frequently Asked Questions</h2>
                <p>Here you can find some commonly asked questions, and the answers too them. This list however, can never
                    be complete and if your question can not be found here, you are more than welcome to contact us.</p>
                <Link class="link-arrow" :href="route('contact.index')">Can't find the answer to your question? Contact us
                <Icon name="arrow-up" />
                </Link>
            </div>
            <div class="questions">
                <div v-for="faq in faqs" :key="faq.id" class="question-wrp" :ref="'question' + faq.id">
                    <div class="question" @click="toggleAnswer(faq.id)">
                        <h3 v-text="faq.question"></h3>
                        <div class="question__icon">
                            <Icon name="dropdown" />
                        </div>

                    </div>
                    <div class="answer">
                        <p v-html="faq.answer"></p>
                        <p>Last updated {{ faq.updated_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>

export default {

    props: {
        faqs: Array,
    },

    methods: {
        toggleAnswer(id) {
            this.$refs['question' + id][0].classList.toggle("is--active");
        },
    },
}

</script>