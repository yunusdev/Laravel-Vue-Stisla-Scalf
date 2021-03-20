import Vue from 'vue'
import Vuex from 'vuex'
import cart from './modules/cart'
import createPersistedState from 'vuex-persistedstate'
Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        cart,
    },
    plugins: [
        createPersistedState({
            storage: {
                getItem: key => localStorage.getItem(key),
                setItem: (key, value) => localStorage.setItem(key, value),
                removeItem: key => localStorage.removeItem(key)
            }
        })
    ],
    mutations: {
        setItems(state, { resource, items }) {
            state[resource].items = items
        },
        setActiveItems(state, { resource, activeItems }) {
            state[resource].activeItems = activeItems
        },
        setActiveItem(state, { resource, activeItem }) {
            state[resource].activeItem = activeItem
        },
        setItem(state, { resource, item }) {
            state[resource].item = item
        },
        addItemToArray(state, { item, index, resource }) {
            Vue.set(state[resource].items, index, item)
        }
    }
})
