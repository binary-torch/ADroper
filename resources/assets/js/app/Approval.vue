<template>
    <div class="section">
        <div class="container text-center">
            <h1>One last step!</h1>
            <h3>Please confirm your approval!</h3>
            
            <div class="col-md-8 col-md-offset-2" v-if="confirmReject">
                <div class="card card-top-bar red">
                    <div class="content">
                        <div class="form-group">
                            <label class="control-label">Please type the reason..</label>
                            <input type="text" v-model="message" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="clearfix"></div>
            
            <div class="margin-top-20">
                <a href="#" class="btn btn-success" @click.prevent="approve">Approve Application</a>
                <a href="#" class="btn btn-danger" @click.prevent="confirmReject = true" v-if="!confirmReject">Reject With Reason</a>
                <a href="#" class="btn btn-danger" @click.prevent="reject" :disabled="!readyToReject" v-if="confirmReject">Confirm Rejection</a>
            </div>
        </div>
        
        <loader v-if="isLoading"></loader>
    </div>
</template>

<script>
    import loader from '../components/Loader.vue'

    export default {
        data(){
            return {
                confirmReject: false,
                message: '',
                isLoading: false,
                approved: false
            }
        },
        computed: {
            url() {
                return '/application/' + this.token + "/update"
            },
            readyToReject(){
                return this.message != '';
            }
        },
        props: ["token"],
        methods: {
            approve(){
                this.approved = true;
                this.submit();
            },
            reject(){
                this.approved = false;
                this.submit();
            },
            submit(){
                this.isLoading = true;
                axios.post(this.url, {
                    "approved" : this.approved
                }).then(response => {
                    this.isLoading = false;
                    alert("Success!, thank you!");
                    window.location.replace("/");
                }).catch(error => {
                    this.isLoading = false;
                });
            }
        },
        components: {
            loader,
        }
    }
</script>