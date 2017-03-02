@extends('layouts.main')

@push('title')
<title> Warning List | Certivel </title>
@endpush

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">
@endpush

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
  <h1>
    Certificate List
  </h1>
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
    <table id="list" class="display nowrap table" cellspacing="0"
width="100%">
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
                <a class="btn btn-info btn-xs" aria-label="Center Align" title="Detail" href="{{ route('list.show', $certificate->id) }}">
                  <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                </a>
                <a class="btn btn-warning btn-xs" aria-label="Center Align" title="Edit" href="{{ route('list.edit', $certificate->id) }}">
                  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deletemodal-{{ $certificate->id }}" aria-label="Center Align" title="Delete">
                  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </button>
              </div>
            </div>
          </td>
        </tr>
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
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Modal -->
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
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>
<!-- SlimScroll -->
<script src="{{ asset("plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset("dist/js/demo.js") }}"></script>
@endpush

@push('script')
<script>
$(document).ready(function() {
    $('#list').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copy', exportOptions: { columns: ':visible' } },
            { extend: 'csv', exportOptions: { columns: ':visible' } },
            { extend: 'excel', exportOptions: { columns: ':visible' } },
            { extend: 'pdf', exportOptions: { columns: ':visible' } },
            { extend: 'print', exportOptions: { columns: ':visible' } },
            'colvis'
        ],
        order: [1, 'asc' ],
        autoWidth: true,
        scrollX: true,
        responsive: true
    } );
} );
</script>
@endpush
