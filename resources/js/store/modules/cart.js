import Axios from 'axios'
const baseUrl = 'cart'

export default {
    namespaced: true,
    state: {
        items: [],
        valid_coupon: null,
        coupon_data: null,
        sub_total_amount: 0,
        delivery_fee: 0,
        pay_before_percentage: 60,
        coupon_discount: 0,
        total_fee: null,
    },

    getters: {

        items(state){
            return state.items;
        },
        subTotalAmount(state){
            return state.sub_total_amount;
        },
        totalFee(state){
            return state.total_fee;
        },
        validCoupon(state){
            return state.valid_coupon;
        },
        couponDiscount(state){
            return state.coupon_discount;
        },
        deliveryFee(state){
            return state.delivery_fee
        },
        payBeforePercentage(state){
            return state.pay_before_percentage
        }
    },

    actions: {
        getUserCartItems({ state, commit }){
            return Axios.get(`/${baseUrl}/items`).then(res => {
                console.log(res.data)
                commit('setSubTotalAmount', parseInt(res.data.total_price))
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

                commit('setSubTotalAmount', parseInt(res.data.total_price))
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
                commit('setSubTotalAmount', res.data.total_price)
                const items = state.items.filter((item) => item.id !== itemId);
                commit('setCartItems', items)
                return res.data

            }).catch(err => {

                return err;
            })

        },
        clearCart({ state, commit }){
            return Axios.delete(`/${baseUrl}/clear`).then(res => {
                return res.data
            }).catch(err => {
                return Promise.reject(err)
            })
        },
        couponValidate({ state, commit }, data){
            return Axios.post(`/coupon/validate`, data).then(res => {
                const data = res.data

                if(data.coupon_data.valid) commit('setCouponData', data.coupon_data)

                return res.data
            }).catch(err => {
                return Promise.reject(err)
            })
        },

        resetAllShoppingMutations({ state, commit }){
            commit('setCouponData', [])
            commit('setCartItems', [])
            commit('setSubTotalAmount', 0)
            commit('setTotalFee', 0)
            commit('setValidCoupon', null)
            commit('setCouponDiscount', 0)
            commit('setDeliveryFee', 0)
        }
    },
    mutations: {

        setCartItems(state, items){
            return state['items'] = items;
        },
        setSubTotalAmount(state, sub_total_amount){
            return state['sub_total_amount'] = sub_total_amount;
        },
        setTotalFee(state, price){
            return state['total_fee'] = price;
        },
        setCouponData(state, coupon_data){
            return state['coupon_data'] = coupon_data;
        },
        setValidCoupon(state, validCoupon){
            return state['valid_coupon'] = validCoupon;
        },
        setCouponDiscount(state, coupon_discount){
            return state['coupon_discount'] = coupon_discount;
        },
        setDeliveryFee(state, delivery_fee){
            return state['delivery_fee'] = delivery_fee;
        },
        setPayBeforePercentage(state, pay_before_percentage){
            return state['pay_before_percentage'] = pay_before_percentage;
        },

    }
}
