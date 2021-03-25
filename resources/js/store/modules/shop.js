import Axios from 'axios'
const baseUrl = 'shop'

export default {
    namespaced: true,
    state: {
        categories: [],
        trending_products: [],
        top_selling_products: [],
        new_arrivals_products: [],
    },

    getters: {
        categories(state){
            return state.categories
        },
        trendingProducts(state){
            return state.trending_products
        },
        topSellingProducts(state){
            return state.top_selling_products
        },
        newArrivalsProducts(state){
            return state.new_arrivals_products
        }
    },

    actions: {
        getCategories({ state, commit }, {reset = false}){
            if(!reset && state.categories.length > 0){
                return;
            }
            return Axios.get(`/${baseUrl}/categories`).then(res => {
                commit('setCategories', res.data)
                return res.data
            }).catch(err => {
                return Promise.reject(err)
            })
        },
        getTrendingProducts({ state, commit }, {reset = false}){
            if(!reset && state.trending_products.length > 0){
                return;
            }
            return Axios.get(`/${baseUrl}/trending/products`).then(res => {
                commit('setTrendingProducts', res.data)
                return res.data
            }).catch(err => {
                return Promise.reject(err)
            })
        },
        getTopSellingProducts({ state, commit }, {reset = false, num = 3}){
            if(!reset && state.top_selling_products.length > 0 && num && num <= state.top_selling_products.length){
                return;
            }
            return Axios.get(`/${baseUrl}/top/sellers/${num}`).then(res => {
                commit('setTopSellingProducts', res.data)
                return res.data
            }).catch(err => {
                return Promise.reject(err)
            })
        },
        getNewArrivalsProducts({ state, commit }, {reset = false}){
            if(!reset && state.new_arrivals_products.length > 0){
                return;
            }
            return Axios.get(`/${baseUrl}/new/arrivals`).then(res => {
                commit('setNewArrivalsProducts', res.data)
                return res.data
            }).catch(err => {
                return Promise.reject(err)
            })
        },
    },
    mutations: {

        setCategories(state, categories){
            return state['categories'] = categories;
        },
        setTrendingProducts(state, trending_products){
            return state['trending_products'] = trending_products;
        },
        setTopSellingProducts(state, top_selling_products){
            return state['top_selling_products'] = top_selling_products;
        },
        setNewArrivalsProducts(state, new_arrivals_products){
            return state['new_arrivals_products'] = new_arrivals_products;
        },
    }
}
