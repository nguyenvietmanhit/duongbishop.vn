@extends('frontends.layouts.main')
@section('content')
<h3 class="text-center">
  Danh sách báo cáo
</h3>
<br />
<table class="table table-hover">
  <tr>
    <th>STT</th>
    <th>Họ tên user</th>
    <th>Ngày sinh</th>
    <th>Link báo cáo</th>
    <th>Ngày tạo báo cáo</th>
  </tr>
  @foreach ($reports AS $key => $report)
  <tr>
    <td>{{ $key + 1 }}</td>
    <td>{{ $report->user_fullname }}</td>
    <td>{{ date('d-m-Y', strtotime($report->user_birthday)) }}</td>
    <td>
      <a href="{{ url('/user/report', ['report_id' => $report->id]) }}" class="link-report" title="Xem báo cáo">
        Xem báo cáo
      </a>
    </td>
    <td>{{ date('H:i d-m-Y', strtotime($report->created_at)) }}</td>
  </tr>
  @endforeach
</table>
{{ $reports->links() }}
@endsection()