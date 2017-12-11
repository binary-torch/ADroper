<template>
    <div class="card card-top-bar blue">
        <div class="content">
            <div v-if="! success">
                <h3 class="text-center">{{ title }}</h3>
                <hr>
                <form @submit.prevent="submit">
                    <div class="row">
                        <div class="input-group" style="width: 100%;" :class="{ 'has-error' : form.errors.has('batch_id') }">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <select class="selectpicker"
                                        data-style="btn btn-success"
                                        title="Select Your Favourite Date/Batch"
                                        data-size="5"
                                        name="course_id"
                                        v-model="form.batch_id">
                                    <option disabled selected>Select one</option>
                                    <option v-for="batch in batches" :value="batch.id">Time: {{ batch.date }}, Place: {{ batch.place }}</option>
                                </select>
                            </div>
                            <span v-if="form.errors.has('batch_id')" class="help-block" v-text="form.errors.get('batch_id')"></span>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="input-group" style="display: block" :class="{ 'has-error' : form.errors.has('name') }">
                                <input type="text" class="form-control" placeholder="Your Name..." v-model="form.name" required>
                                <span v-if="form.errors.has('name')" class="help-block" v-text="form.errors.get('name')"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group" style="display: block" :class="{ 'has-error' : form.errors.has('email') }">
                                <input type="email" class="form-control" placeholder="Your Email..." v-model="form.email" required>
                                <span v-if="form.errors.has('email')" class="help-block" v-text="form.errors.get('email')"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group" style="display: block" :class="{ 'has-error' : form.errors.has('password') }">
                                <input type="password" class="form-control" placeholder="Choose Password (later use for student portal)..." v-model="form.password" required>
                                <span v-if="form.errors.has('password')" class="help-block" v-text="form.errors.get('password')"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group" style="display: block" :class="{ 'has-error' : form.errors.has('phone') }">
                                <input type="text" class="form-control" placeholder="Your Phone..." v-model="form.phone" required>
                                <span v-if="form.errors.has('phone')" class="help-block" v-text="form.errors.get('phone')"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="input-group" style="display: block" :class="{ 'has-error' : form.errors.has('message') }">
                        <textarea class="form-control" placeholder="Your Message (optional)" rows="2" v-model="form.message"></textarea>
                        <span v-if="form.errors.has('message')" class="help-block" v-text="form.errors.get('message')"></span>
                    </div>
    
                    <div class="input-group" :class="{ 'has-error' : form.errors.has('coupon') }">
                        <input type="text" class="form-control" placeholder="Have a coupon? (optional)" v-model="form.coupon">
                        <span class="input-group-btn">
                            <button @click="checkCoupon" class="btn btn-simple btn-sm" type="button">Apply</button>
                        </span>
                        <span v-if="form.errors.has('coupon')" class="help-block" v-text="form.errors.get('coupon')"></span>
                    </div>
                    <span v-if="couponMessage" class="help-block" v-text="couponMessage"></span>
    
                    <div>
                        <h3>Total: $ {{ finalPrice }}</h3>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4 text-center">
                            <button class="btn btn-info btn-raised">
                                Confirm Registration
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div v-if="success">
                <div class="text-center">
                    <h1>
                        Congratulations 🎉
                    </h1>
                    <p>You have registered in our {{ title }} successfully. However, your registration will be activated after you process the fees.</p>
                    <hr>
                </div>
                <accordion :image="image">
                    <span slot="title">
                        Bank Transfer
                    </span>
                    <span slot="description">
                        RHB Bank Berhad
                    </span>
                    <div slot="content">
                        <p class="txt-blue-color">Please send the receipt to (payment@binary-torch.com) after you make the payment.</p>
                        <br>
                        Account name: Binary Torch Sdn Bhd
                        <br>
                        Account no.: 21439460005892
                        <br>
                        SWIFT code: RHBAMYKL
                        <br>
                        Location: Lot G-04, Ground Floor, Bangunan KWSP, No. 5, Jalan Raja Laut, Wilayah Persekutuan, 50350 Kuala Lumpur, Malaysia
                    </div>
                </accordion>
            </div>
        </div>
        <loader v-if="isLoading"></loader>
    </div>
</template>

<script>
    import loader from '../components/Loader.vue'
    import accordion from './Accordion.vue'
    import Form from '../core/Form'

    export default {
        props: ['url', 'title', 'batches', 'price', 'image'],
        data(){
            return {
                form: new Form({
                    name: '',
                    email: '',
                    password: '',
                    phone: '',
                    batch_id: '',
                    coupon: '',
                    message: '',
                }),
                discount: 0,
                isLoading: false,
                success: false,
                couponMessage: ''
            }
        },
        computed: {
            finalPrice(){
                return this.price - (this.price * this.discount / 100);
            }
        },
        mounted(){
            this.form.total = 60;
        },
        methods: {
            submit(){
                this.isLoading = true;

                this.form.post(this.url).then(response => {
                    this.isLoading = false;
                    this.success = true;
                }).catch(() => {
                    this.isLoading = false;
                });
                this.couponMessage = '';
            },
            checkCoupon(){
                axios.post('/coupons/' + this.form.coupon + '/verify')
                    .then(response => {
                        this.discount = response.data.message;
                        this.couponMessage = "Success!";
                    })
                    .catch(error => {
                        this.couponMessage = "Invalid!";
                        this.discount = 0;
                    });
            }
        },
        components: {
            loader,
            accordion
        }
    }
</script>