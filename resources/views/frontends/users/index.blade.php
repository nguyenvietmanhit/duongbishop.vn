@extends('frontends.layouts.main')
@section('content')
    <div class="container">
        <h1>Danh sách báo cáo</h1>
        <table class="table table-hover table-striped">
            <tr>
                <th>#</th>
                <th>Tên báo cáo</th>
                <th>Tên khách hàng</th>
                <th>Thời gian triển khai</th>
                <th>Mô tả</th>
                <th>Link báo cáo</th>
            </tr>
            @foreach($reports AS $key => $report)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $report->name }}</td>
                    <td>{{ $report->client }}</td>
                    <td>{{ $report->time_start ? date('d-m-Y', strtotime($report->time_start)) : ''}}</td>
                    <td>{!! $report->description !!}</td>
                    <td>
                        <a href="{{ route('report', ['report_slug' => $report->report_slug, 'report_id' => $report->id]) }}" class="link-report"
                           title="Click để xem chi tiết báo cáo">
                            Click
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection()