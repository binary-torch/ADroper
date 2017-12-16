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

                                                    <div class="alert alert-info" v-if="form.matric_uuid">
                                                        Card Id: {{ form.matric_uuid }}
                                                    </div>
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
                                                    <input type="text" v-model="form.name" class="form-control" placeholder="First Name...">
                                                </div>
                                                
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">email</i>
                                                    </span>
                                                    <input type="email" v-model="form.email" class="form-control" placeholder="Email...">
                                                </div>
                                                
                                                <div class="input-group" style="display: flex; align-items: center; width: 100%; padding-left: 15px; padding-top: 15px">
                                                    <i class="material-icons">school</i>
                                                    <select class="selectpicker"
                                                            data-style="select-with-transition"
                                                            title="Single Select"
                                                            v-model="form.college_id"
                                                            data-size="10">
                                                        <option disabled selected>Your kulliyah..</option>
                                                        <option v-for="college in colleges" :value="college.id">{{ college.name }}</option>
                                                    </select>
                                                </div>
    
                                                
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">sim_card_alert</i>
                                                    </span>
                                                    <input type="number" v-model="form.matric_number" class="form-control" placeholder="Matric Number...">
                                                </div>
                                                
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">lock_outline</i>
                                                    </span>
                                                    <input type="password" v-model="form.password" placeholder="Password..." class="form-control" />
                                                </div>
                                            </div>
                                            <div class="footer text-center">
                                                <a href="#" class="btn btn-rose btn-round" :disabled="!this.form.valid()" @click.prevent="submit">Register</a>
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
        
        <loader v-if="isLoading"></loader>
    </div>
</template>

<script>
    import loader from '../components/Loader.vue'
    import Form from '../core/Form'
    import Echo from "laravel-echo"
    
    export default {
        data(){
            return {
                form: new Form({
                    "name" : "",
                    "email" : "",
                    "college_id" : "",
                    "matric_number" : "",
                    "matric_uuid" : "",
                    "password" : ""
                }),
                isLoading: false,
                url: "/register"
            }
        },
        props: ['server', 'colleges'],
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
                }).catch(error => {
                    alert("Opps, something went wrong!");
                    this.isLoading = false;
                });
            }
        },
        mounted() {
            if(this.isLocalServer){
                const io = window.io = require('socket.io-client');
                let echo = new Echo({
                    broadcaster: 'socket.io',
                    host: window.location.hostname + ':6001'
                });

                echo.channel('cards')
                    .listen('NewCard', (e) => {
                        this.form.matric_uuid = e.card;
                    });
            }else{
                this.form.removeField('matric_uuid');
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

    .bootstrap-select.btn-group .dropdown-toggle .filter-option {
        text-align: left;
    }
</style>