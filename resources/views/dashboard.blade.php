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
          </div>
        </div>
        <div class="box-body">
          {{Session::get('message')}}
        </div>
      </div>
      @endif

      <P>
        <h4>Good day, {{ Auth::user()->name }}!</h4>
      </p>
        <div class="row">
          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
              <a href="{{ url('/list') }}"><span class="info-box-icon bg-aqua"><i class="fa fa-lock"></i></span></a>
              <div class="info-box-content">
                <span class="info-box-text">Total</span>
                <span class="info-box-number">{{ App\Certificate::where('user_id', Auth::user()->id)->count() }}</span>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
              <a href="{{ url('/list/warning') }}"><span class="info-box-icon bg-yellow"><i class="fa fa-lock"></i></span></a>
              <div class="info-box-content">
                <span class="info-box-text">Warning</span>
                <span class="info-box-number">{{ App\Certificate::where('user_id', Auth::user()->id)->whereBetween('daysleft', [30, 90])->count() }}</span>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
              <a href="{{ url('/list/danger') }}"><span class="info-box-icon bg-red"><i class="fa fa-lock"></i></span></a>
              <div class="info-box-content">
                <span class="info-box-text">Danger</span>
                <span class="info-box-number">{{ App\Certificate::where('user_id', Auth::user()->id)->where('daysleft', '<', '30')->count() }}</span>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->

        <?php
        $topfives = App\Certificate::where('user_id', Auth::user()->id)->limit(5)->orderBy('daysleft', 'ASC')->get();
        ?>
        <!-- /.row -->
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Top 5 Certificate by neareast expiry date</h3>

                <div class="box-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <tr>
                    <th>Domain</th>
                    <th>Days left</th>
                    <th>MEMO</th>
                    <th>Port No.</th>
                  </tr>
                  @foreach($topfives as $topfive)
                  <tr>
                    <td>{{ $topfive->fqdn }}</td>
                    <td>{{ $topfive->daysleft }}</td>
                    <td>{{ $topfive->memo }}</td>
                    <td>{{ $topfive->port }}</td>
                  </tr>
                  @endforeach
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>

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
