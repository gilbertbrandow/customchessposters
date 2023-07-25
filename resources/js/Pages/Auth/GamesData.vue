<template>
    <template v-for="game in $page.props.games">
        [ <br>
        <template v-for="(value, name, index) in game">
            <template v-if="!this.$data.nonFillable.includes(name)">
                            <span v-if="!isNaN(value)">'{{ name }}' => {{ value }},<br></span>
                <span v-else>'{{ name }}' => '{{ value }}', <br></span>
            </template>
        </template>
        ], <br>
        <br>
    </template>
</template>

<script>

export default {
    data() {
        return {
            nonFillable: ['id', 'created_at', 'updated_at'], 
        }
    }
}
</script>