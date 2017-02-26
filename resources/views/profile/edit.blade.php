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
      <div class="box box-info">
        <div class="box-body">
          <form data-toggle="validator" role="form" method="POST" action="{{ route('profile.update', $profile->id) }}">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="form-group has-feedback">
              <label>Name</label>
              <input type="text" class="form-control" name="name" value="{{ $profile->name }}" required>
            </div>
            <div class="form-group has-feedback">
              <label>E-Mail Address</label>
              <input type="email" class="form-control" name="email" value="{{ $profile->email }}" required>
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
