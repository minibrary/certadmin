@extends('layouts.main')

@push('title')
<title> Dashboard | Certivel </title>
@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
  <h1>
    Dashboard
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
  </ol>
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

      <P>Hello, world!</p>

    </div>
  </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@push('script')
<script type="text/javascript">
<!--

$(document).ready(function () {

window.setTimeout(function() {
    $(".box-message").fadeTo(1500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 5000);

});
//-->
</script>
@endpush
