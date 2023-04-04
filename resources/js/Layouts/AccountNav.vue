<template>
    <div class="container account">
        <ul class="account__menu">
            <li class="is--active">
                <Link :href="route('home.index')">
                <div>
                    <Icon name="user"></Icon>
                </div>Account
                </Link>
            </li>
            <li>
                <Link :href="route('home.index')">
                <div>
                    <Icon name="bookmark"></Icon>
                </div>Saved Posters
                </Link>
            </li>
            <li>
                <Link :href="route('home.index')">
                <div>
                    <Icon name="bookmark"></Icon>
                </div>Orders
                </Link>
            </li>
            <li>
                <Link :href="route('home.index')">
                <div>
                    <Icon name="bookmark"></Icon>
                </div>Shipping Address
                </Link>
            </li>
            <li>
                <Link :href="route('home.index')">
                <div>
                    <Icon name="bookmark"></Icon>
                </div>Leave a review
                </Link>
            </li>
            <li>
                <Link :href="route('auth.logout')" method="post" as="button">
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