<template>
    <div class="wrapper wrapper-full-page">
        <div class="wrapper wrapper-full-page">
            <div class="full-page register-page" filter-color="black" data-image="images/register/background.jpg">
                <div class="container">
                    <div class="row">
                        <div class="spacer"></div>
                        <div :class="containerCardWidth">
                            <div class="card card-signup card-hidden">
                                <h2 class="card-title text-center">Create new account</h2>
                                <div class="row">
                                    <div class="col-md-5 col-md-offset-1" v-if="isLocalServer">
                                        <div class="content">
                                            <div class="info info-horizontal">
                                                <div class="icon icon-rose">
                                                    <i class="material-icons">nfc</i>
                                                </div>
                                                <div class="description">
                                                    <h4 class="info-title">Matric Card</h4>
                                                    <p class="description">
                                                        Scan your matric card and do NOT
                                                        remove it while you are creating
                                                        your account.
                                                    </p>
                                                    <img src="images/register/matric.png" alt="matric card">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div :class="cardWidth">
                                        <form class="form">
                                            <div class="content">
                                                <div class="text-center">
                                                    <h4>Fill your information.</h4>
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">person</i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="First Name...">
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">email</i>
                                                    </span>
                                                    <input type="email" class="form-control" placeholder="Email...">
                                                </div>
                                                
                                                <div class="input-group" style="display: flex; align-items: center; width: 100%; padding-left: 15px;">
                                                    <i class="material-icons">school</i>
                                                    <select class="selectpicker" data-style="select-with-transition" title="Single Select" data-size="10">
                                                        <option disabled selected>Your kulliyah..</option>
                                                        <option value="Engineering">Engineering</option>
                                                        <option value="KICT">KICT</option>
                                                    </select>
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">sim_card_alert</i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="Matric Number...">
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">lock_outline</i>
                                                    </span>
                                                    <input type="password" placeholder="Password..." class="form-control" />
                                                </div>
                                            </div>
                                            <div class="footer text-center">
                                                <a href="#" class="btn btn-rose btn-round" :disabled="!this.form.valid()">Register</a>
                                                <a href="/login" class="btn btn-simple btn-round">Login</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                url: "/register"
            }
        },
        props: ['server'],
        computed: {
            isLocalServer() {
                return this.server == "local";
            },
            cardWidth(){
                return this.server == "local" ? "col-md-5" : "col-md-12";
            },
            containerCardWidth(){
                return this.server == "local" ? "col-md-10 col-md-offset-1" : "col-md-6 col-md-offset-3";
            }
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

<style>
    .btn-group.bootstrap-select.input-group-btn {
        padding: 0 0 0 23px; width: 100% !important;
    }
</style>