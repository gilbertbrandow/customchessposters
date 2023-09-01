<template>
    <section>
        <h1>FAQs</h1>
        <p>This is a graphical interface to edit, create or delete a frequently asked question.</p>
        <form @submit.prevent="submit($data.faq)" class="form">
            <div class="field__wrp">
                <label for="faqOption" class="field__label">Choose an option</label>

                <select v-model="faq.id" id="faqOption" class="field" name="faqOption" @change="updateCurrFaq($event)">
                    <option value="0">Create new FAQ</option>
                    <option v-for="faq in $page.props.faqs" :value="faq.id">{{ 'Edit: "' + faq.question + '"' }}
                    </option>
                </select>

            </div>

            <div class="field__wrp">
                <label v-text="'Question'" for="question" class="field__label"></label>
                <div v-if="false" class="field__error">
                    Question is not valid </div>
                <input v-model="faq.question" class="field" :class="{ 'is--error': false }" id="question"
                    placeholder="Lorem ipsum dolor set ami?" />
            </div>

            <div class="field__wrp">
                <label v-text="'Answer'" for="answer" class="field__label"></label>
                <div v-if="false" class="field__error">
                    Answer is not valid </div>
                <textarea v-model="faq.answer" class="field" :class="{ 'is--error': false }" id="answer"
                    placeholder="Lorem ipsum dolor set ami"> </textarea>
            </div>

            <div class="is--margin-top"><input v-model="faq.featured" :value="1" type="checkbox" id="featured" :checked="faq.featured"> <label
                    for="featured">Featured</label></div>


            <div v-if="faq.id != 0" class="is--margin-top"><input v-model="faq.delete" type="checkbox"
                    id="delete"> <label for="delete">Delete post</label></div>



            <div class="is--flex is--margin-top">
                <button class="button is--black" type="submit">
                    Update
                </button>

                <div v-if="$page.props.flash.success" v-text="$page.props.flash.success" class="is--error is--success">
                </div>
            </div>
        </form>
    </section>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

let form = useForm({
    faq: {},
});

function resetForm(faq) {
    faq.id = 0;
    faq.delete = false;
    faq.question = "";
    faq.answer = "";
    faq.featured = 0;
}

let submit = (faq) => {
    form.faq = faq;

    let url = '/faq-';

    if (faq.delete) url += 'delete'
    else if (form.faq.id == 0) url += 'create'
    else url += 'update'


    form.post(url, {

        onFinish: () => resetForm(faq),
        onSuccess: () => resetForm(faq),

    });
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
                delete: false,
                question: '',
                answer: '',
                featured: 0,
            }
        }
    },

    methods: {
        updateCurrFaq(event) {

            if (event.target.value == 0) {

                this.faq.id = 0;
                this.faq.delete = false;
                this.faq.question = '';
                this.faq.answer = '';
                this.faq.featured = 0; 
                return;
            }

            for (let i = 0; i < this.$page.props.faqs.length; i++) {
                if (this.$page.props.faqs[i].id == event.target.value) {

                    this.faq.id = this.$page.props.faqs[i].id;
                    this.faq.question = this.$page.props.faqs[i].question;
                    this.faq.answer = this.$page.props.faqs[i].answer;
                    this.faq.featured = this.$page.props.faqs[i].featured;

                    return;
                }
            }
        }
    },
}
</script>