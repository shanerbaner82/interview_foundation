const state = () => ({
    token: null
})

const actions = {
    checkForToken ({commit}) {
        axios.get('api/token').then(data => {
            commit('setToken', data.data.token)
        })
    },
    addToken({commit}, token){
        axios.put('/api/token', {token}).then(() => {
            commit('setToken', token)
        })
    },
    deleteToken({commit}){
        axios.delete('/api/token').then(() => {
            commit('setToken', null)
            commit('stars/setStars', null, { root: true })
        })
    }
}

const mutations = {
    setToken(state, token){
        state.token = token
    }
}

export default {
    namespaced: true,
    state,
    actions,
    mutations
}
