@extends('layouts.main')

@push('title')
<title> Cert Admin | Certificate List </title>
@endpush

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("plugins/datatables/dataTables.bootstrap.css") }}">
@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
  <h1>
    Certificate List
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Certificate List: All</li>
  </ol>
</section>


<!-- page content -->
<section class="content">
  @if(Session::has('message'))
    <div class="alert alert-success">
        {{Session::get('message')}}
    </div>
    @endif
  <div class="row">
    <div class="col-xs-12">
<!-- TABLE START -->
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Certificate List</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="danger" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Domain</th>
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
            <div class="box-body">
              <div class="low" style="float:left">
                <button type="button" class="btn btn-xs" aria-label="Center Align" title="Detail">
                  <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                </button>
                <button type="button" class="btn btn-xs" aria-label="Center Align" title="Edit">
                  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </button>
                  <form method="POST" action="{{ route('list.destroy', $certificate->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                      <button type="submit" class="btn btn-danger btn-xs" aria-label="Center Align" title="Delete">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                  </form>
                </button>
                
                <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="myModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        MODAL BODY?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
              </div>
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
</div>
<!-- /.content-wrapper -->
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
    $('#danger').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "scrollX": true
    });
  });
</script>
@endpush
