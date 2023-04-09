<template>
    <section>
        <h1>FAQs</h1>
        <p>This is a graphical interface to edit or create a frequently asked question.</p>
        <form @submit.prevent="submit(this.$data.faq)" class="form">
            <div class="field__wrp">
                <label for="orientation" class="field__label">Diagram orientation</label>

                <select v-model="this.faq.id" id="orientation" class="field" name="orientation"
                    @change="updateCurrFaq($event)">
                    <option value="0">Create new FAQ</option>
                    <option v-for="faq in this.$page.props.faqs" :value="faq.id">{{ 'Edit: "' + faq.question + '"' }}
                    </option>
                </select>

            </div>

            <div class="field__wrp">
                <label v-text="'Question'" for="question" class="field__label"></label>
                <div v-if="false" class="field__error">
                    Question is not valid </div>
                <input v-model="this.faq.question" class="field" :class="{ 'is--error': false }" id="question"
                    placeholder="Lorem ipsum dolor set ami?" />
            </div>

            <div class="field__wrp">
                <label v-text="'Answer'" for="answer" class="field__label"></label>
                <div v-if="false" class="field__error">
                    Answer is not valid </div>
                <textarea v-model="this.faq.answer" class="field" :class="{ 'is--error': false }" id="answer"
                    placeholder="Lorem ipsum dolor set ami"> </textarea>
            </div>

            <button class="button is--black is--margin-top" type="submit">
                Post
            </button>
        </form>
    </section>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3';

let form = useForm({
    faq: {},
});

let submit = (faq) => {
    form.faq = faq; 
    form.post('/faq-edit');
};

</script>

<script>
import App from "../../Layouts/App.vue";
import AccountNav from "../../Layouts/AccountNav.vue";

export default {
    layout: (h, page) => {
        return h(App, () => h(AccountNav, () => page))
    },

    data() {
        return {
            faq: {
                id: 0,
                question: '',
                answer: '',
            }
        }
    },

    methods: {
        updateCurrFaq(event) {

            if (event.target.value == 0) {

                this.faq.id = 0;
                this.faq.question = '';
                this.faq.answer = '';
                return;
            }

            for (let i = 0; i < this.$page.props.faqs.length; i++) {
                if (this.$page.props.faqs[i].id == event.target.value) {

                    this.faq.id = this.$page.props.faqs[i].id;
                    this.faq.question = this.$page.props.faqs[i].question;
                    this.faq.answer = this.$page.props.faqs[i].answer;
                    break;
                }
            }
        }
    },
}
</script>