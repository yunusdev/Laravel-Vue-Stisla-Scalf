import Axios from 'axios'
const baseUrl = 'locality'

export default {
    namespaced: true,
    state: {
        states: [],
        countries: [],
    },

    getters: {
        states(state){
            return state.states
        },
        countries(state){
            return state.countries
        }
    },

    actions: {
        getCountries({ state, commit }){
            return Axios.get(`/${baseUrl}/countries`).then(res => {
                commit('setCountries', res.data)
                return res.data
            }).catch(err => {
                return Promise.reject(err)
            })

        },
        getNigerianStates({ state, commit }){
            return Axios.get(`/${baseUrl}/nigerian/states`).then(res => {
                commit('setStates', res.data)
                return res.data
            }).catch(err => {
                return Promise.reject(err)
            })

        },

        getNigeriaStatesLGA({ state, commit }, $stateId){
            return Axios.get(`/${baseUrl}/nigerian/states/${$stateId}/lga`).then(res => {
                return res.data
            }).catch(err => {
                return Promise.reject(err)
            })

        },
    },
    mutations: {

        setStates(state, states){
            return state['states'] = states;
        },
        setCountries(state, countries){
            return state['countries'] = countries;
        },
    }
}
