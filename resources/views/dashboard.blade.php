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

      <P>Hello, world!</p>

        <!-- ./col -->
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-info"></i>

              <h3 class="box-title">Issued To</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Common Name (CN)</dt>
                <dd>mail.minibrary.com</dd>
                <dt>Organization (O)</dt>
                <dd></dd>
                <dt>Organizational Unit (OU)</dt>
                <dd></dd>
                <dt>Serial Number</dt>
                <dd>03:23:E5:2B:A2:85:5C:2B:32:ED:09:0B:3B:22:38:80:1F:C9</dd>
              </dl>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-info"></i>

              <h3 class="box-title">Issued By</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Common Name (CN)</dt>
                <dd>Let's Encrypt Authority X3</dd>
                <dt>Organization (O)</dt>
                <dd>Let's Encrypt</dd>
                <dt>Organizational Unit (OU)</dt>
                <dd></dd>
              </dl>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- ./col -->



    </div>
  </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
