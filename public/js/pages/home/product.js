let productSection = new Vue({
    el: '#productSection',
    data: {
        products: []
    },
    methods: {
        getProducts(){
            axios.get(productListRoute)
                        .then(response => {
                            if (response.status === 200){
                                this.products = response.data
                            }
                        })
                        .catch(e => {
                            console.log(e.message);
                        })
        }
    },
    computed: {

    },
    watch: {

    },
    mounted() {
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        this.getProducts();
    }
});
