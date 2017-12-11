<template>
    <div class="card">
        <div class="card-body">
            <div class="col-md-12">
                <form @submit.prevent="submit" class="notify-me">
                    <div class="input-group" :class="{ 'has-error' : form.errors.has('email') }">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                        <input type="email" class="form-control" placeholder="Your Email..." v-model="form.email" required>
                        <span v-if="form.errors.has('email')" class="help-block" v-text="form.errors.get('email')"></span>
                    </div>
                    <span class="txt-blue-color">{{ message }}</span>
                    <button class="btn btn-info btn-block btn-raised">
                        Notify Me
                    </button>
                </form>
            </div>
            <div class="clearfix"></div>
            <loader v-if="isLoading"></loader>
        </div>

    </div>
</template>

<script>
    import loader from '../components/Loader.vue'
    import Form from '../core/Form'

    export default {
        props: ['url', 'interest'],
        data(){
            return {
                form: new Form({
                    email: '',
                    interest: '',
                }),
                isLoading: false,
                message: ''
            }
        },
        methods: {
            submit(){
                this.isLoading = true;
                this.form.interest = this.interest;
                this.form.post(this.url).then(response => {
                    this.isLoading = false;
                    this.message = "Thanks, we will notify you ASAP.";
                }).catch(() => {
                    this.message = "Opps, please try again.";
                    this.isLoading = false;
                });
            }
        },
        components: {
            loader
        }
    }
</script>