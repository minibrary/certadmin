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
  <div class="box box-solid box-danger box-success">
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
  <div class="row">
    <div class="col-xs-12">
<!-- TABLE START -->
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Certificate List</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list" class="table table-bordered table-striped">
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
                <a class="btn btn-warning btn-xs" aria-label="Center Align" title="Edit" href="{{ route('list.edit', $certificate->id) }}">
                  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deletemodal-{{ $certificate->id }}" aria-label="Center Align" title="Delete">
                  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </button>

                  <!-- Modal -->
                  <div class="modal fade" id="deletemodal-{{ $certificate->id }}" tabindex="-1" role="dialog" aria-labelledby="deletemodalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="deletemodal{{ $certificate->id }}">Delete: {{$certificate->fqdn}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Are you sure to delete?
                        </div>
                        <div class="modal-footer">
                          <form method="POST" action="{{ route('list.destroy', $certificate->id) }}">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Modal -->
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
    $('#list').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "scrollX": false
    });
  });
</script>
@endpush
