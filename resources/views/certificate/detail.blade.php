@extends('layouts.main')

@push('title')
<title> Detail | Certivel </title>
@endpush

@push('css')
<style>
@media (min-width: 768px) {
  .dl-horizontal dt {
      width: 200px;
  }
  .dl-horizontal dd {
    margin-left: 220px;
  }
}
  dd, dt {
    word-wrap: break-word;
    line-height: 2;
    }
</style>
@endpush

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
  <h1>
    Certificate Detail: {{$certificatedetail->fqdn}}
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
  </ol>
</section>


<!-- page content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <!-- ./col -->
      <div class="col-md-12">
        <div class="box box-solid">
          <div class="box-header with-border">
            <i class="fa fa-info"></i>
            <h3 class="box-title">Information</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <dl class="dl-horizontal">
              <dt>Valid From</dt>
              <dd><?php echo date("Y-m-d H:i:s", $certificatedetail->validFrom_time_t); ?></dd>
              <dt>Valid To</dt>
              <dd><?php echo date("Y-m-d H:i:s", $certificatedetail->validTo_time_t); ?></dd>
              <dt>Version</dt>
              <dd>{{$certificatedetail->version}}
              <dt>Hash</dt>
              <dd>{{$certificatedetail->hash}}</dd>
              <dt>Serial Number</dt>
              <dd>{{$certificatedetail->serialNumber}}</dd>
              <dt>Signature Type</dt>
              <dd>{{$certificatedetail->signatureTypeLN}}</dd>
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
              <h3 class="box-title">Issued To</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Common Name (CN)</dt>
                <dd>{{$certificatedetail->subject_CN}}</dd>
                <dt>Organization (O)</dt>
                <dd>{{$certificatedetail->subject_O}}</dd>
                <dt>Location</dt>
                <dd>{{$certificatedetail->subject_L}} {{$certificatedetail->subject_ST}} {{$certificatedetail->subject_C}}</dd>
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
              <h3 class="box-title">Issued From</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Common Name (CN)</dt>
                <dd>{{$certificatedetail->issuer_CN}}</dd>
                <dt>Organization (O)</dt>
                <dd>{{$certificatedetail->issuer_O}}</dd>
                <dt>Location</dt>
                <dd>{{$certificatedetail->issuer_C}}</dd>
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
              <h3 class="box-title">Extensions</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Alt names</dt>
                <dd>
                  <?php
                    $orig_strings = array('DNS:', ',', ' ');
                    $mod_strings = array('', '', '<br>');
                    $altname = str_replace($orig_strings, $mod_strings, $certificatedetail->extensions_subjectAltName);
                    echo $altname;
                  ?>
                </dd>
                <dt>Authority Info Access</dt>
                <dd>{{$certificatedetail->extensions_authorityInfoAccess}}</dd>
                <dt>Subject Key Identifier</dt>
                <dd>{{$certificatedetail->extensions_subjectKeyIdentifier}}</dd>
                <dt>Authority Key Identifier</dt>
                <dd>{{$certificatedetail->extensions_authorityKeyIdentifier}}</dd>
                <dt>Certificate Policies</dt>
                <dd>{{$certificatedetail->extensions_certificatePolicies}}</dd>
              </dl>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- ./col -->

        <button onclick="goBack()" class="btn btn-danger">Go Back</button>



    </div>
  </div>
</section>
<!-- /.content -->

@endsection

@push('script')
<script>
function goBack() {
    window.history.back();
}
</script>
@endpush
