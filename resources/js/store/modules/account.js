import Axios from 'axios'
const baseUrl = 'account'

export default {
    namespaced: true,
    state: {
        user_orders: [],
        user_wishlist: [],
        order: null,
    },

    getters: {

        userOrders(state){
            return state.user_orders;
        },
        userWishlist(state){
            return state.user_wishlist;
        },
        order(state){
            return state.order;
        }
    },

    actions: {
        getUserOrders({ state, commit }, {reset = false}){
            if(!reset && state.user_orders.length > 0){
                return;
            }
            return Axios.get(`/${baseUrl}/user/orders`).then(res => {
                commit('setUserOrders', res.data)
                return res.data
            }).catch(err => {
                return Promise.reject(err)
            })

        },

        getUserWishlist({ state, commit }, {reset = false}){
            if(!reset && state.user_wishlist.length > 0){
                return;
            }
            return Axios.get(`/${baseUrl}/user/wishlist`).then(res => {
                commit('setUserWishlist', res.data)
                return res.data
            }).catch(err => {
                return Promise.reject(err)
            })

        },
    },
    mutations: {

        setUserOrders(state, user_orders){
            return state['user_orders'] = user_orders;
        },
        setUserWishlist(state, user_wishlist){
            return state['user_wishlist'] = user_wishlist;
        },
        setOrder(state, order){
            return state['order'] = order;
        }
    }
}
