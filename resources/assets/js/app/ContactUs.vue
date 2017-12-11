<template>
    <div class="card card-top-bar blue">
        <div class="content">
            <h3>Our team is happy to answer your questions. Fill out the form and we’ll be in touch as soon as possible.</h3>
            <hr>
            <form @submit.prevent="submit">
                <div class="row">
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

                <div class="input-group" style="display: block" :class="{ 'has-error' : form.errors.has('message') }">
                    <textarea class="form-control" placeholder="Your Message..." rows="10" v-model="form.message" required></textarea>
                    <span v-if="form.errors.has('message')" class="help-block" v-text="form.errors.get('message')"></span>
                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-4 text-center">
                        <button class="btn btn-info btn-raised">
                            Send Message
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <loader v-if="isLoading"></loader>
    </div>
</template>

<script>
    import loader from '../components/Loader.vue'
    import Form from '../core/Form'

    export default {
        props: ['url'],
        data(){
            return {
                form: new Form({
                    name: '',
                    email: '',
                    message: '',
                }),
                isLoading: false,
            }
        },
        methods: {
            submit(){
                this.isLoading = true;

                this.form.post(this.url).then(response => {
                    this.isLoading = false;
                }).catch(() => {
                    this.isLoading = false;
                });
            }
        },
        components: {
            loader
        }
    }
</script>