import Axios from 'axios'
const baseUrl = 'cart'

export default {
    namespaced: true,
    state: {
        items: [],
        total_price: [],
    },

    getters: {

        items(state){
            return state.items;
        },
        totalPrice(state){
            return state.total_price;
        }
    },

    actions: {
        getUserCartItems({ state, commit }){

            return Axios.get(`/${baseUrl}/user`).then(res => {
                console.log(res.data)
                commit('setTotalPrice', res.data.total_price)
                commit('setCartItems', res.data.items)
                return res.data
            }).catch(err => {
                return Promise.reject(err)
            })

        },
        addItemsToCart({ state, commit }, items){
            return Axios.post(`/${baseUrl}/add/item`, {
                items
            }).then(res => {

                commit('setTotalPrice', res.data.total_price)
                const data = res.data.items;
                data.forEach((newItem) => {
                    const itemIndex = state.items.findIndex((item, index) => item.id === newItem.id)
                    if (itemIndex >= 0){
                        const items = state.items;
                        items.splice(itemIndex, 1, newItem)
                        commit('setCartItems', items)
                    }else{
                        const newItems = [newItem, ...state.items]
                        commit('setCartItems', newItems)
                    }
                })
                return res.data

            }).catch(err => {
                return Promise.reject(err)
            })

        },

        removeItemFromCart({ state, commit }, itemId){
            return Axios.delete(`/${baseUrl}/remove/item/${itemId}`).then(res => {
                commit('setTotalPrice', res.data.total_price)
                const items = state.items.filter((item) => item.id !== itemId);
                commit('setCartItems', items)
                return res.data

            }).catch(err => {

                return err;
            })

        },
        clearCart({ state, commit }){
            return Axios.delete(`/${baseUrl}/clear`).then(res => {
                commit('setTotalPrice', 0)
                commit('setCartItems', [])
                return res.data
            }).catch(err => {
                return Promise.reject(err)
            })
        }

    },
    mutations: {

        setCartItems(state, items){

            return state['items'] = items;
        },

        setTotalPrice(state, price){

            return state['total_price'] = price;
        }


    }
}
