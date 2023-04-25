            <aside class="pagination is--flex is--space-between">
                <span>Showing {{ this.$page.props.games.from }} - {{ this.$page.props.games.to }} of {{ this.$page.props.games.total }} results </span>
                <div class="links">

                    <template  v-for="link in this.$page.props.games.links">
                        <Link v-if="link.url" :href="link.url" :only="['games']" :class="[link.active ? 'active' : '' ]" preserve-scroll preserve-state>
                            {{ link.label }}
                        </Link>
                        <div v-else> {{ link.label }} </div>
                    </template>
                </div>
            </aside>
