let app = new Vue({
    el: '#productDetailsPage',
    data: {
        product: {},
        cart: [],
        singleItemCart: {
            productId: '',
            quantity: 1,
            price: '',
        }
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
        },
        plusOne(){
            this.singleItemCart.quantity += 1;
        },

        minusOne() {
            if (this.singleItemCart.quantity > 1){
                this.singleItemCart.quantity -= 1;
            }else {
                toastr.warning("Quantity must be one!", {timeOut: 1000});
            }
        },

        addToCart(route, product){
            let data = {
                product_id: product.id,
                selling_price: product.prices[0].selling_price,
                quantity: this.singleItemCart.quantity
            }
            axios.post(route, data)
                        .then(response => {
                            if (response.status === 200){
                                toastr.success('Cart added');
                            }

                        })
                        .catch(e => {
                            switch (e.response.status){
                                case 422:
                                    toastr.error('validation error');
                                    break;
                                case 406:
                                    toastr.error('Invalid Data');
                                    break;
                                case 500:
                                    toastr.error('Something went wrong!');
                                    break;
                                case 401:
                                    console.log('Hello');
                                    window.location.href = '/login';
                                    break;
                                default:
                                    toastr.error('Can not process data');
                                    break;
                            }

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
