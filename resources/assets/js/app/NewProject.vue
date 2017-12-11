<template>
    <div class="container">
        <div class="col-md-4">
        </div>
        <div class="col-md-8">
            <ul class="nav nav-pills nav-pills-info" role="tablist">
                <li class="active" @click="setNDA('no')">
                    <a href="#1" role="tab" data-toggle="tab">
                        I've Got Brief
                    </a>
                </li>
                <li @click="setNDA('yes')">
                    <a href="#2" role="tab" data-toggle="tab">
                        I need NDA
                    </a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
        <div class="spacer"></div>
        <div class="col-md-4">
            <h2><span>1/3</span> <br>Type of project</h2>
        </div>
        <div class="col-md-8">
            <ul class="nav nav-pills nav-pills-info" role="tablist">
                <li class="active" @click="setType('ios')">
                    <a href="#3" role="tab" data-toggle="tab">
                        <i class="material-icons">phone_iphone</i>
                        iOS app
                    </a>
                </li>
                <li @click="setType('android')">
                    <a href="#4" role="tab" data-toggle="tab">
                        <i class="material-icons">phone_android</i>
                        Android app
                    </a>
                </li>
                <li @click="setType('web')">
                    <a href="#5" role="tab" data-toggle="tab">
                        <i class="material-icons">phonelink</i>
                        Web app
                    </a>
                </li>
                <li @click="setType('machine vision')">
                    <a href="#6" role="tab" data-toggle="tab">
                        <i class="material-icons">filter_center_focus</i>
                        Machine Vision
                    </a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
        <div class="spacer"></div>
        <div class="col-md-4">
            <h2><span>2/3</span> <br>Specification</h2>
        </div>
        <div class="col-md-8">
            <ul class="nav nav-pills nav-pills-info" role="tablist">
                <li class="active" @click="setSpecification('idea')">
                    <a href="#7" role="tab" data-toggle="tab">
                        <i class="material-icons">filter_tilt_shift</i>
                        I just have idea
                    </a>
                </li>
                <li @click="setSpecification('brief')">
                    <a href="#8" role="tab" data-toggle="tab">
                        <i class="material-icons">adjust</i>
                        I have brief
                    </a>
                </li>
                <li @click="setSpecification('specification')">
                    <a href="#9" role="tab" data-toggle="tab">
                        <i class="material-icons">tune</i>
                        I have specification
                    </a>
                </li>
                <li @click="setSpecification('wireframes')">
                    <a href="#10" role="tab" data-toggle="tab">
                        <i class="material-icons">view_quilt</i>
                        I have wireframes
                    </a>
                </li>
            </ul>
        </div>

        <div class="clearfix"></div>
        <div class="spacer"></div>
        <div class="col-md-4">
            <h2><span>3/3</span> <br>Caption</h2>
        </div>
        <div class="col-md-8">
            <div class="form-group label-floating" :class="{ 'has-error' : form.errors.has('caption') }">
                <label class="control-label">Describe your projects</label>
                <textarea class="form-control" v-model="form.caption" required rows="10"></textarea>
                <span v-if="form.errors.has('caption')" class="help-block" v-text="form.errors.get('caption')"></span>
            </div>
            <br>
            <br>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group label-floating" :class="{ 'has-error' : form.errors.has('name') }">
                        <label class="control-label">Your name</label>
                        <input type="text" class="form-control" v-model="form.name" required>
                        <span v-if="form.errors.has('name')" class="help-block" v-text="form.errors.get('name')"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group label-floating" :class="{ 'has-error' : form.errors.has('email') }">
                        <label class="control-label">Your email</label>
                        <input type="email" class="form-control" v-model="form.email" required>
                        <span v-if="form.errors.has('email')" class="help-block" v-text="form.errors.get('email')"></span>
                    </div>
                </div>
                <div class="clearfix"></div>
                <br>
                <br>
                <p class="txt-green-color" v-if="success">Form submitted successfully. Thank you for your trust, we will reach you back soon.</p>
                <div class="btn btn-info" @click="submit">Estimate my project</div>
                <div class="clearfix"></div>
            </div>
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
                    nda: '',
                    type: '',
                    specification: '',
                    caption: '',
                }),
                isLoading: false,
                success: false
            }
        },
        mounted(){
            this.form.nda = 'no';
            this.form.type = 'ios';
            this.form.specification = 'idea';
        },
        methods: {
            submit(){
                this.isLoading = true;
                this.success = false;

                let nda = this.form.nda;
                let type = this.form.type;
                let specification = this.form.specification;

                this.form.post(this.url).then(response => {
                    this.success = true;
                    this.isLoading = false;

                    this.form.nda = nda;
                    this.form.type = type;
                    this.form.specification = specification;
                }).catch(() => {
                    this.isLoading = false;

                    this.form.nda = nda;
                    this.form.type = type;
                    this.form.specification = specification;
                });
            },
            setNDA(bool){
                this.form.nda = bool;
            },
            setType(type){
                this.form.type = type;
            },
            setSpecification(specification){
                this.form.specification = specification;
            }
        },
        components: {
            loader
        }
    }
</script>