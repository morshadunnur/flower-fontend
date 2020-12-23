let app = new Vue({
    el: '#productDetailsPage',
    data: {
        product: {}
    },
    methods: {
        getProductDetails(){

            axios.get(productDetailsRoute, {
                params: {
                    product_id: productId,
                }
            })
                        .then(response => {
                            if (response.status === 200){
                                this.product = response.data;
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
        this.getProductDetails();
    }
});
