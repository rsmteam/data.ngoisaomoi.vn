@extends('backend.master')
@section('title')
    <h1 class="page-header">Danh sách Source UTM</h1>
@stop
@section('content')
<!-- /.row -->

<aside class="right-side">
    <!-- Content Header (Page header) -->
    <!-- Modal -->
    <div id="form_utm_source" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Thêm mới Utm Source</h4>
          </div>
          <div class="modal-body">
            <div class="row">
                <form action="{{ URL::route('createUtmSource') }}" method="post" accept-charset="utf-8">
                      {!! csrf_field() !!} 
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Dự án</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="title" value="">
                                </div>
                              </div>
                        </div>
                        <input style="margin:0 auto;display: block" type="submit" class="btn btn-primary" value="Đồng ý"/>
                    </div>
                </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary " style="margin-left: 20px;margin-top: 20px" data-toggle="modal" data-target="#form_utm_source">Thêm mới UTM Source</button>
        </div>
    </div>    
    <!-- Main content -->
    <section class="content">

        <div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> Danh sách Source UTM
    </div>
    <!-- /.panel-heading -->
    <table border="1" style="width: 100%;padding: 5px;">
        <tr>
            <th>STT</th>
            <th>Source UTM</th>
            <th>Hành động</th>
        </tr>
        @php $count = 1; @endphp
        @foreach($result as $item )
        <tr>
            <td>{{ $count++ }}</td>
            <td>{{ $item->title }} </td>
            <td><a  href="{!! URL::route('getFormChangeUTM', $item->utm_source ) !!}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Chỉnh sửa"><i class="fa fa-pencil fa-fw"></i></a></td>
        </tr>
        @endforeach
    </table>
    {{ $result->links() }}
</div>

      
    </section><!-- /.content -->
</aside><!-- /.right-side -->



@stop
