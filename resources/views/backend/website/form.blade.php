@extends('backend.master')
<!-- Right side column. Contains the navbar and content of the page -->
 @section('content')      
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                BẢNG ĐIỀU KHIỂN
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Main row -->
            <div class="row">
                <div class="col-md-6">
                <div class="row">
                    <form action="{{ (isset($data) ? URL::route('editWebsite',$data->id) : URL::route('CreateWebsite')) }}" method="post" accept-charset="utf-8">
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
                      
                    </div>
                    </form>
                </div>
                </div>
                <!-- Left col -->
            </div><!-- /.row (main row) -->

        </section><!-- /.content -->
    </aside><!-- /.right-side -->
@stop