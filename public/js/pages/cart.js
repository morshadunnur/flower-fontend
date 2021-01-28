let app = new Vue({
    el: '#singleCartPage',
    data: {
        cart: [],

    },
    methods: {
        getCartItem(){
            axios.get(cartItemRoute)
                        .then(response => {
                            if (response.status === 200){
                                toastr.success('Device Registered');
                                console.log(response.data);

                            }
                        })
                        .catch(e => {
                            switch (e.response.status){
                                case 422:
                                    toastr.error('validation failed!')
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
