<template>
    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" filter-color="black" data-image="images/login/background.jpg">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="spacer"></div>
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                            <form>
                                <div class="card card-login card-hidden">
                                    <div v-if="isLocalServer">
                                        <div class="card-header text-center" data-background-color="rose">
                                            <img src="images/login/rfid.svg" alt="rfid logo">
                                            <h4 class="card-title">Scan your matric card to login</h4>
                                        </div>
                                        <p class="category text-center">
                                            Or Be Classical
                                        </p>
                                    </div>
                                    <div class="content">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">email</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Email address</label>
                                                <input type="email" v-model="form.email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Password</label>
                                                <input type="password" v-model="form.password" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer text-center">
                                        <button @click.prevent="submit()" class="btn btn-rose btn-wd btn-lg" :disabled="!this.form.valid()">Login</button>
                                        <a href="/register" class="btn btn-simple btn-wd btn-lg">Or SignUp</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <loader v-if="isLoading"></loader>
    </div>
</template>

<script>
    import loader from '../components/Loader.vue'
    import Form from '../core/Form'

    export default {
        data(){
            return {
                form: new Form({
                    "email" : "",
                    "password" : ""
                }),
                isLoading: false,
                url: "/login"
            }
        },
        props: ['server'],
        computed: {
            isLocalServer() {
                return this.server == "local";
            },
        },
        methods: {
            submit() {
                if( ! this.form.valid() ) return;
                
                this.isLoading = true;
                this.form.post(this.url).then(response => {
                    this.isLoading = false;
                    window.location.replace("/portal");
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