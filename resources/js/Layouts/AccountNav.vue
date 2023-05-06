<template>
    <div class="container account">
        <ul class="account__menu">
            <li>
                Signed in as <br>
                <h3 v-text="this.$page.props.auth.user.name"></h3>
            </li>
            <li :class="{ 'is--active': $page.url === '/account' }">
                <Link :href="route('user.index')">
                <div>
                    <Icon name="user"></Icon>
                </div>Account
                </Link>
            </li>
            <li :class="{ 'is--active': $page.url === '/saved-posters' }">
                <Link :href="route('savedPosters.index')">
                <div>
                    <Icon name="bookmark"></Icon>
                </div>Saved Posters
                </Link>
            </li>
            <li :class="{ 'is--active': $page.url === '/orders' }">
                <Link :href="route('home.index')">
                <div>
                    <Icon name="bookmark"></Icon>
                </div>Orders
                </Link>
            </li>
            <li v-if="this.$page.props.auth.user.admin" :class="{ 'is--active': $page.url === '/faq-edit' }">
                <Link :href="route('faq.edit')">
                <div>
                    <Icon name="edit"></Icon>
                </div>FAQs
                </Link>
            </li>
            <li v-if="this.$page.props.auth.user.admin" :class="{ 'is--active': $page.url === '/game-edit' }">
                <Link :href="route('game.edit')">
                <div>
                    <Icon name="edit"></Icon>
                </div>Games
                </Link>
            </li>
            <li :class="{ 'is--active': $page.url === '/shipping-addresses' }">
                <Link :href="route('home.index')">
                <div>
                    <Icon name="bookmark"></Icon>
                </div>Shipping Address
                </Link>
            </li>
            <li :class="{ 'is--active': $page.url === '/create-review' }">
                <Link :href="route('home.index')">
                <div>
                    <Icon name="bookmark"></Icon>
                </div>Leave a review
                </Link>
            </li>
            <li>
                <Link :href="route('login.destroy')" method="post" as="button">
                <div>
                    <Icon name="logout"></Icon>
                </div>Log out
                </Link>
            </li>

        </ul>
        <slot>
        </slot>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";
</script>