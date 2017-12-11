@extends('portal.components.layout')

@section('main-content')
    <div class="container-fluid">
        <div class="col-md-10 col-md-offset-1">
            <!--      Wizard container        -->
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
                                <li>
                                    <a href="#type" data-toggle="tab">Type</a>
                                </li>
                                <li>
                                    <a href="#course" data-toggle="tab">Course</a>
                                </li>
                                <li>
                                    <a href="#section" data-toggle="tab">Section</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane" id="type">
                                <div class="row text-center">
                                    <h4 class="info-text">Select the application type</h4>
                                    <div class="col-md-6">
                                        <div class="choice" data-toggle="wizard-checkbox">
                                            <input type="checkbox" name="type" value="Add">
                                            <div class="icon">
                                                <i class="fa fa-pencil"></i>
                                            </div>
                                            <h6>Add</h6>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="choice" data-toggle="wizard-checkbox">
                                            <input type="checkbox" name="type" value="Drop">
                                            <div class="icon">
                                                <i class="fa fa-pencil"></i>
                                            </div>
                                            <h6>Drop</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="course">
                                <div class="row">
                                    <div class="col-sm-12 clearfix">
                                        <h4 class="info-text"> Select the course you want to add </h4>
                                    </div>

                                    <div class="col-md-10 col-md-offset-1 clearfix">
                                        <div class="form-group">
                                            <input type="text" placeholder="Search.." class="form-control">
                                        </div>
                                    </div>


                                @foreach(\App\Course::all() as $course)
                                        <div class="col-md-4 margin-top-20 text-center">
                                            <a href="#">
                                                <div class="card">
                                                    <div class="content">
                                                        {{ $course->name }}
                                                        <br>
                                                        <div class="label label-default">
                                                            {{ $course->code }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane" id="section">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="info-text"> Choose your prefered section </h4>
                                    </div>

                                    @foreach(\App\Course::limit(10)->get() as $course)
                                        <div class="col-md-10 col-md-offset-1 clearfix margin-top-20">
                                            <a href="#">
                                                <div class="card">
                                                    <div class="content">
                                                        <span class="pull-left">{{ $course->name }}</span>
                                                        <div class="label pull-right label-default">
                                                            {{ $course->code }}
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="wizard-footer">
                            <div class="pull-right">
                                <input type='button' class='btn btn-next btn-fill btn-rose btn-wd' name='next' value='Next' />
                                <input type='button' class='btn btn-finish btn-fill btn-rose btn-wd' name='finish' value='Submit Application' />
                            </div>
                            <div class="pull-left">
                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- wizard container -->
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        helpers.initMaterialWizard();
    </script>
@endsection