let header = new Vue({
    el: '#header_area',
    data: {
        cartItems: [],
        cartItem: false,
        orderId: '',
    },
    methods: {
        getCartItem(){
            axios.get(cartItemRoute)
                .then(response => {
                    if (response.status === 200){
                        this.cartItem = true;
                        this.cartItems = response.data.details;
                        this.orderId = response.data.id;
                        if (this.cartItems.length === 0){
                            this.cartItem = false;
                        }

                    }
                })
                .catch(e => {
                    switch (e.response.status){
                        case 422:
                            toastr.error('validation failed!')
                            break;
                        case 404:
                            this.cartItem = false;
                            // toastr.error('No Items found in cart!');
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
        },
    },
    computed: {
        totalPrice(){
            let sum = 0;
            if (this.cartItems.length > 0){
                this.cartItems.forEach((item) => {
                    sum += item.price * item.quantity;
                });
                return sum;
            }
            return sum;

        }
    },
    watch: {

    },
    mounted() {
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        this.getCartItem();
    }
});
