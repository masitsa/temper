@extends('master')

@section('title', 'Onboarding')

@section('content')

<!-- Error Messages -->
@if(Session::has('message'))

    <div class="alert alert-danger" role="alert">

        <h4 class="alert-heading">Upload Message</h4>
        
        <p>{{ Session::get('message') }}</p>

    </div>

@endif

<!-- Success Messages -->
@if(Session::has('success'))

    <div class="alert alert-success" role="alert">

        <h4 class="alert-heading">Upload Message</h4>
        
        <p>{{ Session::get('success') }}</p>

    </div>

@endif

<!-- Form to capture CSV -->
<form method='post' action='/registrations' enctype='multipart/form-data' class="form-inline">

    {{ csrf_field() }}

    <div class="form-group">

        <label for="csv_file">Select CSV to view chart</label>

        <input type="file" class="form-control-file" name="csv_file" id="csv_file" aria-describedby="fileHelp">

        <small id="fileHelp" class="form-text text-muted">Select CSV file to view report.</small>

    </div>

    <input type='submit' name='submit' class='btn btn-primary' value='Import'>

</form>

<div class="row">

    <div class="col-xs-1-12">

        <div id="onboarding"></div>

    </div>

</div>

@endsection

@section('scripts')

<script>
    var app = new Vue({

        el: '#onboarding',

        mounted() {

            axios.get('/registrations')
                .then(function (response) {

                    let seriesData = response.data.registrations;

                    if(seriesData.length > 0)
                    {
                        Highcharts.chart('onboarding', {

                            title: {
                                text: response.data.title
                            },

                            subtitle: {
                                text: response.data.subtitle
                            },

                            yAxis: {
                                title: {
                                    text: 'Number of Users'
                                }
                            },

                            xAxis: {
                                title: {
                                    text: 'Registration Progress'
                                },
                                categories: ['Create Account', 'Activate Account', 'Profile Information', 'Job Interest', 'Work Experience', 'Freelancer Status', 'Pending Approval', 'Approval']
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'middle'
                            },

                            plotOptions: {
                                series: {
                                    label: {
                                        connectorAllowed: false
                                    },
                                    pointStart: 0
                                }
                            },

                            series : seriesData,

                            responsive: {
                                rules: [{
                                    condition: {
                                        maxWidth: 500
                                    },
                                    chartOptions: {
                                        legend: {
                                            layout: 'horizontal',
                                            align: 'center',
                                            verticalAlign: 'bottom'
                                        }
                                    }
                                }]
                            }

                        });
                    }
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
        }

    });

</script>

@endsection
