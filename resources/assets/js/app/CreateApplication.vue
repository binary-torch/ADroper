<template>
    <div class="wizard-container">
        <div class="card wizard-card" data-color="rose" id="wizardProfile">
            <form>
                <div class="wizard-header">
                    <h3 class="wizard-title">
                        New Add/Drop Application
                    </h3>
                    <h5>
                        Add or drop your courses within a minute!
                    </h5>
                </div>
                <div class="wizard-navigation margin-top-20">
                    <ul>
                        <li v-for="step in steps">
                            <a v-bind:href="'#' + step" data-toggle="tab" v-text="step"></a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" style="height: 500px; overflow: scroll">
                    <div class="tab-pane" id="Type">
                        <div class="row text-center">
                            <h4 class="info-text">Select the application type</h4>
                            <div class="col-md-6" v-for="type in types">
                                <div class="choice" @click="selectedType = type" :class="{'active' : selectedType == type}">
                                    <input type="radio" name="job">
                                    <div class="icon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <h6>
                                        {{ type.name }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="Course">
                        <div class="row">
                            <div class="col-sm-12 clearfix">
                                <h4 class="info-text"> Select the course you want to add </h4>
                            </div>

                            <div class="col-md-10 col-md-offset-1 clearfix">
                                <div class="form-group">
                                    <input type="text" v-model="queryCourse" placeholder="Search.." class="form-control">
                                </div>
                            </div>
    
    
                            <div class="col-md-4 margin-top-20 text-center"
                                 v-for="course in filteredCourses">
                                <a href="#">
                                    <div class="card"
                                         @click="selectedCourse = course; sections = selectedCourse.sections; selectedSection = '';"
                                         :class="{'selected red' : selectedCourse == course}">
                                        <div class="content">
                                            {{ course.name }}
                                            <br>
                                            <div class="label label-default">
                                                {{ course.code }}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="Section">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="info-text"> Choose your preferred section </h4>
                            </div>
                            
                            <div class="col-md-10 col-md-offset-1 clearfix">
                                <div class="form-group">
                                    <input type="text" v-model="querySection" placeholder="Search.." class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-10 col-md-offset-1 clearfix margin-top-20"
                                 v-for="section in filteredSections">
                                <a href="#">
                                    <div class="card"
                                         @click="selectedSection = section"
                                         :class="{'selected red' : selectedSection == section}">
                                        <div class="content">
                                            <span class="pull-left">
                                                {{ section.lecturer }} | {{ section.date }}
                                            </span>
                                            <div class="label pull-right label-default">
                                                {{ section.number }}
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="wizard-footer">
                    <div class="pull-right">
                        <input type='button'
                               class='btn btn-next btn-fill btn-rose btn-wd'
                               :disabled="! validate()"
                               value='Next'/>
                        <input type='button'
                               @click="submit()"
                               class='btn btn-finish btn-fill btn-rose btn-wd'
                               :disabled="! validate()"
                               value='Submit' />
                    </div>
                    <div class="pull-left">
                        <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
        
        <loader v-if="isLoading"></loader>
    </div>
</template>

<script>
    import loader from '../components/Loader.vue'
    import { isEmpty } from 'lodash';
    
    export default {
        data(){
            return {
                steps: ["Type", "Course", "Section"],
                currentStep: 0,
                types: [],
                courses: [],
                sections: [],
                selectedType: '',
                selectedCourse: '',
                selectedSection: '',
                queryCourse: '',
                querySection: '',
                isLoading: false,
            }
        },
        computed: {
            filteredCourses: function () {
                return this.findBy(this.courses, this.queryCourse, ['name', 'code'])
            },
            filteredSections: function () {
                return this.findBy(this.sections, this.querySection, ['number', 'date', 'lecturer'])
            }
        },
        methods: {
            init(){
                this.initMaterialWizard();
                this.fetchCoursesWithSections();
                this.fetchApplicationTypes();
            },
            findBy: function(list, value, columns) {
                return list.filter(function (item) {
                    let found = false;

                    columns.forEach(column => {
                        if(item[column].toLowerCase().includes(value.toLowerCase())){
                            found = true;
                        }
                    });
                    
                    return found;
                })
            },
            initMaterialWizard() {
                let mv = this;
                $('.wizard-card').bootstrapWizard({
                    'tabClass': 'nav nav-pills',
                    'nextSelector': '.btn-next',
                    'previousSelector': '.btn-previous',

                    onNext: function() {
                        if(mv.validate()){
                            mv.currentStep++;
                            return true
                        }
                        return false
                    },
                    onPrevious: function() {
                        mv.currentStep--;
                    },
                    onInit : function(tab, navigation, index){

                        //check number of tabs and fill the entire row
                        let $total = navigation.find('li').length;
                        let $width = 100/$total;
                        let $wizard = navigation.closest('.wizard-card');

                        let $display_width = $(document).width();

                        if($display_width < 600 && $total > 3){
                            $width = 50;
                        }

                        navigation.find('li').css('width',$width + '%');
                        let $first_li = navigation.find('li:first-child a').html();
                        let $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
                        $('.wizard-card .wizard-navigation').append($moving_div);
                        refreshAnimation($wizard, index);
                        $('.moving-tab').css('transition','transform 0s');
                    },

                    onTabClick : function(tab, navigation, index){
                        return false;
                    },

                    onTabShow: function(tab, navigation, index) {
                        var $total = navigation.find('li').length;
                        var $current = index+1;

                        let $wizard = navigation.closest('.wizard-card');

                        // If it's the last tab then hide the last button and show the finish instead
                        if($current >= $total) {
                            $($wizard).find('.btn-next').hide();
                            $($wizard).find('.btn-finish').show();
                        } else {
                            $($wizard).find('.btn-next').show();
                            $($wizard).find('.btn-finish').hide();
                        }

                        let button_text = navigation.find('li:nth-child(' + $current + ') a').html();

                        setTimeout(function(){
                            $('.moving-tab').text(button_text);
                        }, 150);

                        var checkbox = $('.footer-checkbox');

                        if( !index == 0 ){
                            $(checkbox).css({
                                'opacity':'0',
                                'visibility':'hidden',
                                'position':'absolute'
                            });
                        } else {
                            $(checkbox).css({
                                'opacity':'1',
                                'visibility':'visible'
                            });
                        }

                        refreshAnimation($wizard, index);
                    }
                });
                
                $('[data-toggle="wizard-radio"]').click(function(){
                    wizard = $(this).closest('.wizard-card');
                    wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
                    $(this).addClass('active');
                    $(wizard).find('[type="radio"]').removeAttr('checked');
                    $(this).find('[type="radio"]').attr('checked','true');
                });

                $('.set-full-height').css('height', 'auto');

                $(window).resize(function(){
                    $('.wizard-card').each(function(){
                        let $wizard = $(this);
                        let index = $wizard.bootstrapWizard('currentIndex');
                        refreshAnimation($wizard, index);

                        $('.moving-tab').css({
                            'transition': 'transform 0s'
                        });
                    });
                });

                function refreshAnimation($wizard, index){
                    let total_steps = $wizard.find('li').length;
                    let move_distance = $wizard.width() / total_steps;
                    let step_width = move_distance;
                    move_distance *= index;

                    let $current = index + 1;

                    if($current == 1){
                        move_distance -= 8;
                    } else if($current == total_steps){
                        move_distance += 8;
                    }

                    $wizard.find('.moving-tab').css('width', step_width);
                    $('.moving-tab').css({
                        'transform':'translate3d(' + move_distance + 'px, 0, 0)',
                        'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'
                    });
                }
            },
            fetchCoursesWithSections(){
                this.isLoading = true;
                axios.post('/portal/application/courses')
                    .then(response => {
                        this.courses = response.data.data.courses;
                        this.isLoading = false;
                    }).catch(error => {
                        this.isLoading = false;
                    });
            },
            fetchApplicationTypes(){
                this.isLoading = true;
                axios.post('/portal/application/types')
                    .then(response => {
                        this.types = response.data.data.types;
                        this.isLoading = false;
                    }).catch(error => {
                        this.isLoading = false;
                    });
            },
            validate: function () {
                if (this.currentStep === 0) {
                    if(this.selectedType == ""){
                        return false;
                    }
                }else if (this.currentStep === 1) {
                    if(this.selectedCourse == ""){
                        return false;
                    }
                }else if (this.currentStep === 2) {
                    if(this.selectedSection == ""){
                        return false;
                    }
                }
                return true;
            },
            submit(){
                this.isLoading = true;
                axios.post('/portal/application/store', {
                    "application_type_id" : this.selectedType.id,
                    "course_id" : this.selectedCourse.id,
                    "section_id" : this.selectedSection.id
                }).then(response => {
                    this.isLoading = false;
                    window.location.replace("/portal");
                }).catch(error => {
                    alert("something went wrong!");
                    this.isLoading = false;
                });
            }
        },
        mounted(){
            this.init();
        },
        components: {
            loader,
        }
    }
</script>

<style>
    .card.selected.red {
        box-shadow: 0 0 0 1px #bc4c73, 0 0 0 1px white inset;
    }
</style>