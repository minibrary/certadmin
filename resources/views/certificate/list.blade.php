@extends('layouts.main')

@push('title')
<title> Cert Admin | Dashboard </title>
@endpush

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
<section class="content-header">
  <h1>
    Certificate List
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>


<!-- page content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
<!-- TABLE START -->
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Certificate List</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Domain(FQDN)</th>
          <th>Days Left</th>
          <th>MEMO</th>
          <th>Port No.</th>
          <th>Updated</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
      @foreach($certificates as $certificate)
        <tr>
          <td>{{$certificate->fqdn}}</td>
          <td>{{$certificate->daysleft}}</td>
          <td>{{$certificate->memo}}</td>
          <td>{{$certificate->port}}</td>
          <td>{{$certificate->updated_at}}</td>
          <td>
            <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-default" aria-label="Center Align" title="Detail">
              <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
            </button>
            <button type="button" class="btn btn-default" aria-label="Center Align" title="Edit">
              <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </button>
            <button type="button" class="btn btn-default" aria-label="Center Align" title="Delete">
              <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            </button>
          </div>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
  </div>
  </div>
</div>
</section>
<!-- /.content -->
@endsection

@push('js')
<!-- DataTables -->
<script src="{{ asset("plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("plugins/datatables/dataTables.bootstrap.min.js") }}"></script>
<!-- SlimScroll -->
<script src="{{ asset("plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset("dist/js/demo.js") }}"></script>
@endpush

@push('script')
<script>
  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
@endpush
