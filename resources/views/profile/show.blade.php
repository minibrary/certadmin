@extends('layouts.main')

@push('title')
<title> Show Profile | Certivel </title>
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
    Your Profile
  </h1>
</section>

<!-- page content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      @if(Session::has('message'))
      <div class="box box-solid box-success box-message">
        <div class="box-header with-border">
          <h3 class="box-title">Information</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
          {{Session::get('message')}}
        </div><!-- /.box-body -->
      </div><!-- /.box -->
      @endif

      <div class="box box-info">
        <div class="box-body">
          <form data-toggle="validator" role="form">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" value="{{ $profile->name }}" disabled>
            </div>
            <div class="form-group">
              <label>E-Mail Address</label>
              <input type="email" class="form-control" value="{{ $profile->email }}" disabled>
            </div>
            <div class="form-group">
              <label>Joined Certivel at</label>
              <input type="text" class="form-control" value="{{ $profile->created_at }}" disabled>
            </div>
          </form>
      </div>
    </div>

    <a class="btn btn-warning" aria-label="Center Align" title="Edit" href="{{ route('profile.edit', $profile->id) }}">Edit Profile</a>
    <!-- Password Reset, need to dev -->
    <a class="btn btn-info" aria-label="Center Align" title="Change Password (Comming Soon)" href="#">Change Password (by mail)</a>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletemodal-{{ $profile->id }}" aria-label="Center Align" title="Leave Certivel">Leave Certivel</button>
    <!-- Modal -->
    <div class="modal fade" id="deletemodal-{{ $profile->id }}" tabindex="-1" role="dialog" aria-labelledby="deletemodalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="deletemodal-{{ $profile->id }}">Leave Certivel</h3><br>
            <strong>[Warning]</strong> All related data will be destoried.<br>
          </div>
          <div class="modal-body">
            We will miss you so much!<br>
            Are you sure to leave Certivel?
          </div>
          <div class="modal-footer">
            <form method="POST" action="{{ route('profile.destroy', $profile->id) }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger">Yes, I wan't to leave Certivel.</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal -->
  </div>
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@push('script')
<script type="text/javascript">
$(document).ready(function () {

window.setTimeout(function() {
    $(".box-message").fadeTo(1500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 5000);

});
</script>
@endpush
