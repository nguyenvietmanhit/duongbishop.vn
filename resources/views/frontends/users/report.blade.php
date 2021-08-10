@extends('frontends.layouts.main')
@section('content')
    {{--<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">--}}


    <div class="chart container">
        <h1 class="chart-heading font-helvetica-neue">Overall Campaign performance
            <i class="chart-fa fa fa-info-circle"></i>
        </h1>
        <p class="date-filter font-helvetica-neue">
            {{ $date_from }} / {{ $date_to }}
        </p>
        <div class="char-date">
            <form method="get" action="" id="form-reportrange">
                <div id="reportrange" class="range-common">
                    <i class="fas fa-calendar-alt"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>
                <input type="hidden" value="{{ $date_from }}" id="date_from" name="date_from"/>
                <input type="hidden" value="{{ $date_to }}" id="date_to" name="date_to"/>
                <input type="submit" name="filter" value="" class="hide"/>
            </form>
            <div class="timezone range-common">
                <i class="fas fa-globe-asia"></i>&nbsp;
                <span></span> (UTC+07:00) Asia/Bangkok
            </div>
        </div>
        <div class="row-chart row">
            <div class="chart-des col-md-9 col-sm-9 col-12">
                <div class="chart-content">
                    <h1 class="chart-heading">
                        {{--Hiệu suất hàng ngày--}}
                    </h1>
                    <div id="highchart"></div>
                </div>
            </div>
            <div class="performance col-md-3 col-sm-3 col-12">
                <div class="chart-content">
                    <h1 class="chart-heading">
                        Performance Overview
                    </h1>
                    <div class="performance-content">
                        <div class="performance-item">
                            <span class="performance-total">{{ number_format($statistic_totals['total_result']) }}</span>
                            <span class="performance-text">
                                RESULTS
                            </span>
                        </div>
                        <div class="performance-item">
                            <span class="performance-total">{{ number_format($statistic_totals['total_reach']) }}</span>
                            <span class="performance-text">
                                REACH
                            </span>
                        </div>
                        <div class="performance-item">
                            <span class="performance-total">{{ number_format($statistic_totals['total_click']) }}</span>
                            <span class="performance-text">Click-throughs</span>
                        </div>
                        <div class="performance-item">
                            <span class="performance-total">{{ number_format($statistic_totals['total_cpc']) }}</span>
                            <span class="performance-text">
                                {{--Lượt tương tác <span class="n-a">ER: N/A</span>--}}
                                CPC
                            </span>
                        </div>

                        {{--<div class="performance-item">--}}
                        {{--<span class="performance-total">0</span>--}}
                        {{--<span class="performance-text">--}}
                        {{--Ngân sách <span class="n-a">CPA: N/A</span>--}}
                        {{--</span>--}}
                        {{--</div>--}}
                        {{--<div class="performance-item">--}}
                        {{--<span class="performance-total">0.00</span>--}}
                        {{--<span class="performance-text">--}}
                        {{--Doanh thu <span class="n-a">ROI: N/A</span>--}}
                        {{--</span>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="statistic container">
        <div class="statistic-content">
            <div class="statistic-item-large statistic-item">
                <span class="statistic-count">{{ number_format($statistic_totals['total_result']) }}</span>
                {{--<span class="statistic-list">Frequency: N/A</span>--}}
                <span class="statistic-title">RESULTS</span>
            </div>
            <div class="statistic-item-small statistic-item">
                <span class="statistic-count">{{ number_format($statistic_totals['total_reach']) }}</span>
                {{--<span class="statistic-list">Frequency: N/A</span>--}}
                <span class="statistic-title">REACH</span>
            </div>
            <div class="statistic-item-small statistic-item">
                <span class="statistic-count">{{ number_format($statistic_totals['total_display']) }}</span>
                {{--<span class="statistic-list">Frequency: N/A</span>--}}
                <span class="statistic-title">IMPRESSION</span>
            </div>
            <div class="statistic-item-small statistic-item">
                <span class="statistic-count">{{ number_format($statistic_totals['total_budget']) }}</span>
                {{--<span class="statistic-list">Frequency: N/A</span>--}}
                <span class="statistic-title">BUDGET SPENT</span>
            </div>
            <div class="statistic-item-large statistic-item">

            </div>
        </div>
    </div>
    <div class="table-content container">
        <!--        CAMPAIGN-->
    @include('includes.table_content', [
        'contents' => $campaigns,
        'title' => 'Campaign',
        'count' => $count_campaign,
        'type' => Helper::TYPE_CAMPAIGN,
        'statistic_totals' => $statistic_totals,
        'sql_raw' => $sql_raw,

    ])
    <!--    AD Group-->
    @include('includes.table_content', [
        'contents' => $ad_groups,
        'title' => 'Ad Group',
        'count' => $count_ad_group,
        'type' => Helper::TYPE_AD_GROUP,
        'statistic_totals' => $statistic_totals,
        'sql_raw' => $sql_raw,
    ])

    <!--    Ad -->
        @include('includes.table_content', [
            'contents' => $ads,
            'title' => 'Creative',
            'count' => $count_ad,
            'type' => Helper::TYPE_AD,
            'statistic_totals' => $statistic_totals,
            'sql_raw' => $sql_raw,
        ])
    </div>
    <div class="footer">
        <a href="#" class="footer-link">Terms</a>
        <a href="#" class="footer-link">Privacy Policy</a>
    </div>

    <input type="hidden" value="{{ $date_to_range }}" id="date-to-range" />
    <input type="hidden" value="{{ $date_from_range }}" id="date-from-range" />
    <input type="hidden" value="{{ count($date_ranges) }}" id="date-count" />
    <script type="text/javascript">
        $(function () {

            var start = $('#date_from').val();
            start = moment(start);
            var end = $('#date_to').val();
            end = moment(end);

            var to_range = $('#date-to-range').val();
            to_range = moment(to_range);
            var from_range = $('#date-from-range').val();
            from_range = moment(from_range);

            function cb(start, end) {
                $('#reportrange span').html(start.format('DD/MM/YYYY') + '<span class="split-date">-</span>' + end.format('DD/MM/YYYY'));
                $('#date_from').val(start.format('YYYY-MM-DD'));
                $('#date_to').val(end.format('YYYY-MM-DD'));
                // console.log(end);
            }

            $('#reportrange').on('apply.daterangepicker', function () {
                $('#form-reportrange').find('input[type=submit]').click();
            });
            $('#reportrange').daterangepicker({
                // timePicker: true,
                locale: {
                    format: "DD/MM/YYYY",
                    cancelLabel: 'Clear'
                },

                "showCustomRangeLabel": true,
                minDate: from_range,
                maxDate: to_range,
                startDate: start,
                endDate: end,
                alwaysShowCalendars: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
            }, cb)


            cb(start, end);
        });


        $(function () {
            console.log(Highcharts.getOptions());
            Highcharts.setOptions({
                lang: {
                    decimalPoint: '.',
                    thousandsSep: ','
                }
            });
            Highcharts.chart('highchart', {
                chart: {
                    zoomType: 'xy'
                },
                title: {
                    text: 'Daily Performance',
                    align: 'left'
                },
                // subtitle: {
                //     text: 'Source: WorldClimate.com',
                //     align: 'left'
                // },
                xAxis: [{
                    categories: [
                        @foreach ($statistic_by_days['impressions'] AS $date => $statistic)
                            '{{ $date }}',
                        @endforeach
                        // 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                        // 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                    ],
                    crosshair: true
                }],
                plotOptions: {
                    series: {
                        pointWidth: 1000 / $('#date-count').val()
                    }
                },
                yAxis: [{ // Primary yAxis
                    labels: {
                        format: '{value:,.2f}',
                        style: {
                            color: Highcharts.getOptions().colors[2]
                        }
                    },
                    title: {
                        text: 'REACH',
                        format: '{value:,.2f}',
                        style: {
                            color: Highcharts.getOptions().colors[2]
                        }
                    },
                    opposite: true

                },
                    { // Secondary yAxis
                        gridLineWidth: 0,
                        title: {
                            text: '',

                            style: {
                                color: Highcharts.getOptions().colors[0]
                            }
                        },
                        labels: {
                            format: '{value:,f}',
                            style: {
                                color: Highcharts.getOptions().colors[0]
                            }
                        }

                    }
                    ,
                    { // Tertiary yAxis
                        gridLineWidth: 0,
                        title: {
                            text: 'SBudget Spent',

                            style: {
                                color: Highcharts.getOptions().colors[1]
                            }
                        },
                        labels: {

                            format: '{value:,2f}',
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            }
                        },
                        opposite: true
                    }],
                tooltip: {
                    shared: true
                },
                // legend: {
                //     layout: 'vertical',
                //     align: 'left',
                //     x: 80,
                //     verticalAlign: 'top',
                //     y: 55,
                //     floating: true,
                //     backgroundColor:
                //         Highcharts.defaultOptions.legend.backgroundColor || // theme
                //         'rgba(255,255,255,0.25)'
                // },
                series: [{
                    name: 'Impressions',
                    type: 'column',
                    yAxis: 1,
                    data: [
                        @foreach ($statistic_by_days['impressions'] AS $date => $total_impression)
                        {{ $total_impression }},
                        @endforeach
                        // 149.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4, 1, 1
                    ],
                    tooltip: {
                        // valueSuffix: ' mm'
                    }

                }, {
                    name: 'Budget Spent',
                    type: 'spline',
                    yAxis: 2,
                    data: [
                        @foreach ($statistic_by_days['budgets'] AS $date => $total_budget)
                        {{ $total_budget }},
                        @endforeach
                        // 1119, 1016, 1015.9, 1015.5, 1012.3, 1009.5, 1009.6, 1010.2, 1013.1, 1016.9, 1018.2, 1016.7,1,1
                    ],
                    marker: {
                        enabled: false
                    },
                    // dashStyle: 'shortdot',
                    tooltip: {
                        // valueSuffix: ' mb'
                    }

                }, {
                    name: 'REACH',
                    type: 'spline',
                    data: [
                        @foreach ($statistic_by_days['reachs'] AS $date => $total_reach)
                        {{ $total_reach }},
                        @endforeach
                        // 7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6
                    ],
                    tooltip: {
                        // valueSuffix: ' °C'
                    }
                }],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                floating: false,
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom',
                                x: 0,
                                y: 0
                            },
                            yAxis: [{
                                labels: {
                                    align: 'right',
                                    x: 0,
                                    y: -6
                                },
                                showLastLabel: false
                            }, {
                                labels: {
                                    align: 'left',
                                    x: 0,
                                    y: -6
                                },
                                showLastLabel: false
                            }, {
                                visible: false
                            }]
                        }
                    }]
                }
            });

        });
    </script>


@endsection()