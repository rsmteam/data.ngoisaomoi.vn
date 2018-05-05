@extends('backend.master')
@section('title')
    <h1 class="page-header">Danh sách dự án</h1>
@stop
@section('content')
<!-- /.row -->

<aside class="right-side">
    <!-- Content Header (Page header) -->
    <!-- Modal -->
    <div id="form_website" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Thêm mới dự án</h4>
          </div>
          <div class="modal-body">
            <div class="row">
                <form action="{{ URL::route('CreateWebsite') }}" method="post" accept-charset="utf-8">
                      {!! csrf_field() !!} 
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Dự án</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="title" value="{{ @$data->title }}">
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
            <button type="button" class="btn btn-primary " style="margin-left: 20px;margin-top: 20px" data-toggle="modal" data-target="#form_website">Thêm dự án</button>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Danh sách dự án
            </div>
            <!-- /.panel-heading -->
            <table border="1" style="width: 100%;padding: 5px;">
                <tr>
                    <th>STT</th>
                    <th>Dự án</th>
                    <th>Hành động</th>
                </tr>
                <?php $count = 1; ?>
                 @foreach($data as $item )
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ $item->title }} </td>
                    <td><a href="#" type="button" class="btn btn-primary" title="Chỉnh sửa" data-toggle="modal" data-target="#form_website_{{ $item->id }}"><i class="fa fa-pencil fa-fw"></i></a></td>
                </tr>
                <div id="form_website_{{ $item->id }}" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Thêm mới dự án</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <form action="{{ URL::route('editWebsite',$item->id) }}" method="post" accept-charset="utf-8">
                                  {!! csrf_field() !!} 
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label  class="col-sm-2 col-form-label">Dự án</label>
                                            <div class="col-sm-10">
                                              <input type="text" class="form-control" name="title" value="{{ @$item->title }}">
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
                @endforeach
            </table>
            
            <!-- So do so luong san pham hang thang -->
            
        </div>

      
    </section><!-- /.content -->
</aside><!-- /.right-side -->



@stop
