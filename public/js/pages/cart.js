let app = new Vue({
    el: '#singleCartPage',
    data: {
        cartItems: [],
        cartItem: false,

    },
    methods: {
        getCartItem(){
            axios.get(cartItemRoute)
                        .then(response => {
                            if (response.status === 200){
                                toastr.success('Cart Items');
                                this.cartItem = true;
                                this.cartItems = response.data.details;


                            }
                        })
                        .catch(e => {
                            switch (e.response.status){
                                case 422:
                                    toastr.error('validation failed!')
                                    break;
                                case 404:
                                    this.cartItem = false;
                                    toastr.error('No Items found in cart!');
                                    break;
                                case 406:
                                    toastr.error('Can not process the given data!');
                                    break;
                                case 500:
                                    toastr.error('Something went wrong');
                                    break;
                                default:
                                    toastr.error('Something went wrong');
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
        this.getCartItem();
    }
});
