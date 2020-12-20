const state = () => ({
    stars: [],
    fetching: false,
    error: ''
})

const actions = {
    fetchStars({commit}) {
        commit('setFetching', true);
        commit('setStars', null)
        commit('setError', '');
        axios.get('api/stars').then(data => {
            commit('setFetching', false);
            commit('setStars', data.data.repos)
        }).catch(error => {
            commit('setFetching', false);
            commit('setError', error.response.data.message);
        })
    },
}

const mutations = {
    setFetching(state, value) {
        state.fetching = value
    },
    setStars(state, stars) {
        state.stars = stars
    },
    setError(state, error) {
        state.error = error
    }
}

export default {
    namespaced: true,
    state,
    actions,
    mutations
}
