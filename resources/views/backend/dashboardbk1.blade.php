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
                <!-- Modal -->
                <div id="importData" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Import danh sách data</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <form name="myform" class="form-horizontal" role="form" method="POST" action="{!! route('postImport') !!}" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <div class="col-md-12">
                                    <div class="form-group" style="margin-bottom: 20px">
                                        <label class="col-md-4 control-label">File</label>

                                        <div class="col-md-8">
                                            <input type="file" class="form-control" name="file_contact" value="">
                                        </div>
                                    </div>                           
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-6" style="">
                                            <button type="submit" class="btn btn-primary">
                                                Import
                                            </button>
                                        </div>
                                    </div>
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
                @include('backend.import')

                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner inner_data">
                                <h3><span class="total_data">{{ $total_data_date }}</span> / {{ $total_data->count_data }} </h3>
                                <p>
                                    Tổng số data thu về
                                </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#total_data_model">
                                Xem chi tiết <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                        <div id="total_data_model" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Thống kê data theo nguồn website</h4>
                              </div>
                              <div class="modal-body">
                                 @foreach($total_link as $item_link)
                                    <p>{{ $item_link->link }} ({{ $item_link->count_data }})</p>
                                 @endforeach
                                   
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>

                          </div>
                        </div>
                    </div><!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner inner_link">
                                <h3>
                                    <span class="total_link">{{ count($total_link) }} </span> / {{ count($link) }}
                                </h3>
                                <p>
                                   Nguồn website
                                </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#total_data_model">
                Xem chi tiết <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div><!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>
                                    44
                                </h3>
                                <p>
                                    User Registrations
                                </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div><!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>
                                    65
                                </h3>
                                <p>
                                    Unique Visitors
                                </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div><!-- ./col -->
                </div><!-- /.row -->
                <!-- top row -->
                <div class="row">
                    <div class="col-xs-12 ">
                        <div class="col-sm-12">
                            <a style="float: right;margin-bottom: 10px;" class="btn btn-primary export-excel" href="{!! URL::route('admin.invoices.excel',['startDay'=>'startDate','endDay'=>'endDate','utm[]' => '--UTM--','website' => '--Website--']) !!}" > Xuất ra file excel </a>
                            @if(Auth::user()->roleId == App\User::SUPPER_ADMIN)
                            <input type="button" value="Xóa" class="btn btn-danger export-excel btn_delete_data" style="float: right;margin-right:10px"/>
                            <button style="float: right;margin-right: 10px" type="button" class="btn btn-success" href="#" data-toggle="modal" data-target="#importData"> Import data</button>
                            <button style="float: right;margin-right: 10px" type="button" class="btn btn-success" href="#" data-toggle="modal" data-target="#insertData"> Thêm mới data</button>
                            @endif

                       </div>
                    </div><!-- /.col -->
                </div>
                <!-- /.row -->
        
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-12 connectedSortable"> 
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <b><i>Danh sách data</i></b>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-2">
                                    <select id="select_utm" multiple="multiple">
                                        <option value="--UTM--">Chọn hết</option>
                                        @foreach($utm as $key_utm =>  $items )
                                            <option> {{ ($key_utm == '') ? 'NA' : $key_utm }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <!-- <div id="select_website"> -->
                                        <select id="select_website" multiple="multiple" class="form-control">
                                            <option value="--Website--">--Website--</option>
                                            @foreach($link as $item)
                                            @if($item->link_website != '')
                                            <option>{{ $item->link_website }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    <!-- </div> -->
                                </div>
                                <div class="col-sm-2" style="padding-right: 0px;">
                                    <select id="select_column" multiple="multiple">
                                       @foreach($column as $item)
                                            @if($item->status_show == 1)
                                            <option selected value="{{ $item->title_en }}">{{ $item->title_vn }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;margin-bottom: 10px">
                                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                        <span></span> <b class="caret"></b>
                                    </div>
                                </div>
                                <!-- <div id ="ajax_html"> -->
                                    <div class="div-table">
                                         <div class="div-table-row row_head">
                                            @if (Auth::user()->roleId == App\User::SUPPER_ADMIN)
                                                <div  class="div-table-col td_checkbox"><input type="checkbox" name ="idCheckbox[]" class="checkbox_item" value="{{ $item->id }}"/></div>
                                            @endif
                                            @foreach($column as $item)
                                               <div  class="div-table-col">{{ $item->title_vn }}</div>
                                            @endforeach
                                         </div>
                                        <div id="ajax_html">    
                                        @foreach ($todo_items as $key =>  $item)
                                           @php 
                                               $source_cookie_arr = explode('|',$item->source_cookie);
                                           @endphp
                                            <div class="div-table-row {{ (array_key_exists($item->id,$todo_items_child)) ? 'contact_trung' : '' }}" >
                                                @if (Auth::user()->roleId == App\User::SUPPER_ADMIN)
                                                    <div class="div-table-col td_checkbox"><input type="checkbox" name ="idCheckbox[]" class="checkbox_item" value="{{ $item->id }}"/></div>
                                                @endif
                                                <div class="div-table-col" data-toggle="collapse" data-target="#{{$item->id}}">{{ $item->name }} {{ (array_key_exists($item->id,$todo_items_child)) ? '('.count($todo_items_child[$item->id]) .')' : '' }}</div>
                                                <div class="div-table-col">{{ $item->phone }}</div>
                                                <div class="div-table-col">{{ $item->email }}</div>
                                                <div class="div-table-col">{{ $item->comment }}</div>
                                                <div class="div-table-col">{{ $item->register_time }}</div>
                                                <div class="div-table-col">{{ $item->link }}</div>
                                                <div class="div-table-col" data-toggle="modal" data-target="#cource_cookie_{{$item->id }}">{{ (count($source_cookie_arr) > 1 ) ? $source_cookie_arr[0]. ' ('. count($source_cookie_arr). ')' : $item->source_cookie }} </div>
                                                
                                                <div class="div-table-col">{{ $item->utm_source }}</div>
                                                <div class="div-table-col">{{ $item->utm_medium }}</div>
                                                <div class="div-table-col">{{ $item->utm_campaign }}</div>
                                            </div>
                                            @if(count($source_cookie_arr) > 1)
                                            <div id="cource_cookie_{{$item->id }}" class="modal fade" role="dialog">
                                              <div class="modal-dialog">
                                            
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Source cookie</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                        {{ $item->source_cookie }}
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>

                                              </div>
                                            </div>
                                            @endif
                                           @if (array_key_exists($item->id,$todo_items_child))
                                                <div class="div_child collapse" id="{{$item->id}}">
                                                @foreach($todo_items_child[$item->id] as $value)
                                                    <div class="div-table-row">
                                                        <div class="div-table-col">{{ $value->name }}</div>
                                                        <div class="div-table-col">{{ $value->phone }}</div>
                                                        <div class="div-table-col">{{ $value->email }}</div>
                                                        <div class="div-table-col">{{ $value->comment }}</div>
                                                        <div class="div-table-col">{{ $value->register_time }}</div>
                                                        <div class="div-table-col">{{ $value->link }}</div>
                                                        <div class="div-table-col">{{ $value->source_cookie }}</div>
                                                        <div class="div-table-col">{{ $value->utm_source }}</div>
                                                        <div class="div-table-col">{{ $value->utm_medium }}</div>
                                                        <div class="div-table-col">{{ $value->utm_campaign }}</div>
                                                    </div>
                                                @endforeach
                                                </div>
                                            @endif
                                        @endforeach
                                        <div style="float: right">{{ $todo_items->links() }}</div>
                                        </div>
                                        
                                  </div>
                                
                                <!-- </div> -->
                                </div>

                    </section><!-- right col -->
                </div><!-- /.row (main row) -->

            </section><!-- /.content -->
        </aside><!-- /.right-side -->
        @stop