<template>
    <div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="blue">
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
                                        <progress-bar :percentage=application.percentage :type="progressStatus(application.status)"></progress-bar>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                currentApplication: {},
                isLoading: false,
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
            showApplication(){
                console.log("okay la");
            }
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
        background-color: #fafafa;
    }
</style>