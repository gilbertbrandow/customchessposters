<template>
    <div class="switcher-wrp is--margin-top">
        <span :class="this.$page.props.unit ? 'is--active' : ''">Centimeters (cm)</span>
        <button :class="this.$page.props.unit ? 'switcher' : 'switcher is--right'"
            @click="this.$page.props.unit = !this.$page.props.unit">
            <div></div>
        </button>
        <span :class="!this.$page.props.unit ? 'is--active' : ''">Inches (")</span>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3'

export default {

    data() {
        return {
            form: useForm({
                unit: true,
            })
        }
    },

    methods: {
        submit() {
            this.form.post('/unit', {
                preserveState: true,
                preserveScroll: true,
            });
        },
    }
}
</script>