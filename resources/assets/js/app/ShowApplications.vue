<template>
    <div>
        <div class="col-md-12">
            <transition enter-active-class="fadeInUp"
                        leave-active-class="fadeOutDown" v-on:after-leave="startShowOneApplication">
                <div id="applications" v-if="showAllApplications" class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">school</i>
                    </div>
                    <br>
                    <h4 class="card-title">
                        Applications
                    </h4>
                    <div class="content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Course</th>
                                    <th>Lecturer</th>
                                    <th>Section</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Progress</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="tableRow"
                                    v-for="application, index in applications"
                                    @click="showApplication(application)">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ application.course }}</td>
                                    <td>{{ application.lecturer }}</td>
                                    <td>{{ application.section }}</td>
                                    <td>{{ application.type }}</td>
                                    <td>{{ application.status }}</td>
                                    <td>
                                        <progress-bar style="margin-top: 15px;" :percentage=application.percentage :type="progressStatus(application.status)"></progress-bar>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </transition>
            
            <transition enter-active-class="fadeInUp"
                        leave-active-class="fadeOutDown" v-on:after-leave="startShowAllApplication">
                <div id="application-show" v-if="showOneApplication" class="card">
                    <div class="card-header card-header-icon" data-background-color="blue">
                        <i class="material-icons">assignment</i>
                    </div>
                    <br>
                    <div class="pull-right">
                        <button class="btn btn-round btn-compact btn-sm" style="margin-right: 20px;" @click="closeApplication">x</button>
                    </div>
                    <h4 class="card-title">
                        Application Status
                    </h4>
                    <div class="clearfix"></div>
                    <div class="content">
                        <div>
                            <h3><i class="material-icons">assignment</i> Application Type: <span class="label" :class="label(selectedApplication.type)">{{ selectedApplication.type }}</span></h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Lecturer</th>
                                    <th>Section</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ selectedApplication.course }}</td>
                                    <td>{{ selectedApplication.lecturer }}</td>
                                    <td>{{ selectedApplication.section }}</td>
                                    <td>{{ selectedApplication.status }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="margin-top-20">
                            <h3><i class="material-icons">assignment</i> Application Progress: <span class="label" :class="label(selectedApplication.type)">{{ selectedApplication.type }}</span></h3>
    
                            <div class="alert alert-info alert-with-icon" data-notify="container">
                                <i class="material-icons" data-notify="icon">notifications</i>
                                <span data-notify="message">
                                    Your application in progress of getting lecturer approval.
                                </span>
                            </div>
    
                            <br>
                            <progress-bar style="margin-top: 15px;" :percentage=selectedApplication.percentage :type="progressStatus(selectedApplication.status)"></progress-bar>
                            <div class="col-md-3">
                                <h6>
                                    Sent
                                </h6>
                            </div>
                            <div class="col-md-3">
                                <h6>
                                    Lecturer Approval
                                </h6>
                            </div>
                            <div class="col-md-3">
                                <h6>
                                    S.A. Approval
                                </h6>
                            </div>
                            <div class="col-md-3">
                                <h6>
                                    Course Added
                                </h6>
                            </div>
                            
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>

        <loader v-if="isLoading"></loader>
    </div>
</template>

<script>
    import ProgressBar from '../components/ProgressBar.vue';
    import loader from '../components/Loader.vue'
    import { isEmpty } from 'lodash';

    export default {
        data(){
            return {
                applications: [],
                selectedApplication: null,
                isLoading: false,
                showAllApplications: true,
                showOneApplication: false
            }
        },
        methods: {
            init(){
                this.fetchApplications();
            },
            fetchApplications(){
                this.isLoading = true;
                axios.post('/portal/applications')
                    .then(response => {
                        this.applications = response.data.data.applications;
                        this.isLoading = false;
                    }).catch(error => {
                        this.isLoading = false;
                    });
            },
            progressStatus(status){
                return status.includes('Rej') ? "danger" : "success";
            },
            label(status){
                return status.includes('Rej') ? "label-danger" : "label-success";
            },
            showApplication(application){
                this.showAllApplications = false;
                this.selectedApplication = application;
            },
            startShowOneApplication(){
                this.showOneApplication = true;
            },
            closeApplication(){
                this.showOneApplication = false;
                this.selectedApplication = null;
            },
            startShowAllApplication(){
                this.showAllApplications = true;
            },
        },
        mounted(){
            this.init();
        },
        components: {
            loader,
            ProgressBar
        }
    }
</script>

<style>
    .tableRow {
        cursor: pointer;
        padding: 5px;
        transition: all 0.3s;
    }

    .tableRow:hover {
        background-color: #eaeaea;
    }


    .fade-enter-active, .fade-leave-active {
        transition: opacity 1s
    }

    .fade-enter,
    .fade-leave-to
    {
        opacity: 0
    }
</style>