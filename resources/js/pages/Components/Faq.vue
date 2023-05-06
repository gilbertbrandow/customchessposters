<template>
    <section>
        <div class="container is--flex">
            <div class="content">
                <h2>Frequently Asked Questions</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum
                    tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero
                    vitae
                    erat.</p>
                <Link class="link-arrow" :href="route('contact.index')">Still have questions? Contact us <Icon name="arrow-up"/></Link>
            </div>
            <div class="questions">
                <div v-for="faq in faqs" :key="faq.id" class="question-wrp" :ref="'question' + faq.id">
                    <div class="question" @click="toggleAnswer(faq.id)">
                        <h3 v-text="faq.question"></h3>
                        <div class="question__icon"><Icon name="dropdown"/>
                        </div>

                    </div>
                    <div class="answer">
                        <p v-html="faq.answer"></p>
                        <p>Last updated at {{formatDate(faq.updated_at)}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>

import moment from 'moment'

export default {

    props: {
        faqs: Array,
    },

    methods: {
        toggleAnswer(id) {
            this.$refs['question' + id][0].classList.toggle("is--active");
        },
        
        formatDate(value) {
            return moment(String(value)).format('DD/MM - YYYY');
        }
    },
}

</script>