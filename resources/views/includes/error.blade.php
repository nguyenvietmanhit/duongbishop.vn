@foreach ($errors->all() AS $error)

    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Thông báo!</strong> {{ $error }}
    </div>
@endforeach
@if(session()->get('error'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Thông báo!</strong> {{ session()->get('error') }}
    </div>
    @php(session()->forget('error'))
@endif
@if(session()->get('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session()->get('success') }}
    </div>
    @php(session()->forget('success'))
@endif
