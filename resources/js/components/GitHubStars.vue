<template>
    <div v-cloak>
        <div class="row mt-4">
            <div class="col-md-4">
                <b-button @click="fetchStars" :disabled="!token" size="lg" variant="outline-primary">
                    {{ fetching ? 'Getting your data' : 'Get starred repos' }}
                </b-button>
            </div>
        </div>
        <div class="mt-4">
            <b-list-group v-if="stars" v-for="star in stars" :key="star.id">
                <b-list-group-item>
                    <div class="d-flex flex-row justify-content-between align-items-center">
                        <div>
                            <img style="width:60px;" class="img-thumbnail" :src="star.owner.avatar_url"/>
                            <a class="ml-2 text-uppercase text-primary fs-3" target="_blank"
                               :href="star.html_url">{{ star.name }}</a>
                        </div>
                        <div>
                            <span>{{ star.watchers }} Watchers</span>
                        </div>
                    </div>
                </b-list-group-item>
            </b-list-group>
        </div>
    </div>
</template>

<script>
import {mapState} from "vuex";

export default {
    name: "GitHubStars",
    methods: {
        fetchStars() {
            this.$store.dispatch('stars/fetchStars')
        },
    },
    created() {

    },
    watch: {
        error(newValue, oldValue) {
            if (newValue !== '' && !this.fetching) {
                this.$bvToast.toast(newValue, {
                    title: 'Oops, there was an error',
                    variant: 'danger',
                    autoHideDelay: 5000,
                })
            }
        }
    },
    computed: mapState({
        token: state => state.token.token,
        stars: state => state.stars.stars,
        error: state => state.stars.error,
        fetching: state => state.stars.fetching
    }),
}
</script>

<style scoped>

</style>
