@extends('layouts.main')

@push('title')
<title> Edit Profile | Certivel </title>
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
    Edit Profile
  </h1>
</section>


<!-- page content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">


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
