<template>
    <div v-cloak>
        <div v-if="!token" >
            <div class="row">
                <div class="col-md-6">
                    <b-alert show>
                        <a class="alert-link" target="_blank" href="https://docs.github.com/en/free-pro-team@latest/github/authenticating-to-github/creating-a-personal-access-token">No Token? Click here to learn how to make token </a>
                    </b-alert>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <b-form @submit="addToken" >
                        <b-form-group
                            id="input-group-1"
                            label="Enter your GitHub token"
                            label-for="input-1"
                        >
                            <b-form-input
                                id="input-1"
                                v-model="form.token"
                                type="text"
                                required
                            ></b-form-input>
                        </b-form-group>
                        <b-button type="submit" variant="info">Save</b-button>
                    </b-form>
                </div>
            </div>

        </div>
        <div v-else>
            <div class="row">
                <div class="col-md-12">
                    <b-alert variant="light" show>
                        <div class="row justify-content-between align-items-center">
                            <span>Your Github API Token: {{token}}</span>
                            <span><b-button @click="deleteToken" variant="danger">Delete Your Token</b-button></span>
                        </div>

                    </b-alert>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import { mapState} from 'vuex';
export default {
    name: "GithubTokenForm",
    data(){
        return {
            form: {
                token: null
            }
        }
    },
    computed: mapState({
        token: state => state.token.token
    }),
    methods: {
        addToken(){
            this.$store.dispatch('token/addToken', this.form.token)
        },
        deleteToken(){
            this.$store.dispatch('token/deleteToken')
        }
    },
    created () {
        this.$store.dispatch('token/checkForToken')
    }
}
</script>

