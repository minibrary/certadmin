@extends('layouts.main')

@push('title')
<title> Cert Admin | Add Certificate </title>
@endpush

@push('css')
<!-- Bootstrap Validator -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css">
@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
  <h1>
    Add Certificate
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
  </ol>
</section>


<!-- page content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="box box-info">
        <div class="box-body">
          <form data-toggle="validator" role="form" method="POST" action="{{ route('list.store') }}">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
              <label>Domain by FQDN</label>
              <input type="text" pattern="^([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,}$" class="form-control" placeholder="(Do Not include https:// )    ex) www.google.com" name="fqdn" value="{{ old('fqdn') }}" required>
            </div>
            <div class="form-group">
              <label>Port Number</label>
              <input type="text" maxlength="5" pattern="^[0-9]*$" class="form-control" placeholder="(Numbers only)    ex) 443" name="port" value="{{ old('port') }}" required>
            </div>
            <div class="form-group">
              <label>Memo</label>
              <textarea class="form-control" rows="3" placeholder="Memo for this certificate" name="memo" value="{{ old('memo') }}"></textarea>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button onclick="goBack()" class="btn btn-danger">Cancel</button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@push('js')
<!-- Bootstrap Validator -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>
@endpush

@push('script')
<script>
function goBack() {
    window.history.back();
}
</script>
@endpush
