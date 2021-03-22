import Axios from 'axios'
const baseUrl = 'account'

export default {
    namespaced: true,
    state: {
        user_orders: [],
        order: null,
    },

    getters: {

        userOrders(state){
            return state.user_orders;
        },
        order(state){
            return state.order;
        }
    },

    actions: {
        getUserOrders({ state, commit }, {reset = false}){
            if(reset){
                commit('setUserOrders', [])
            }
            return Axios.get(`/${baseUrl}/user/orders`).then(res => {
                commit('setUserOrders', res.data)
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
        setOrder(state, order){
            return state['order'] = order;
        }
    }
}
