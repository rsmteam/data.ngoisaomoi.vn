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

                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner inner_data">
                                <h3>{{ $total_data_date->count_data }} / {{ $total_data }}
                                </h3>
                                <p>
                                    Tổng số data thu về
                                </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Xem chi tiết <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div><!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>
                                    {{ $total_link }} / {{ count($link) }}
                                </h3>
                                <p>
                                   Nguồn website
                                </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">
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
                    <div class="col-xs-12 connectedSortable">
                        <div class="col-sm-12">
                            <a style="float: right;margin-bottom: 10px;" class="btn btn-primary export-excel" href="{!! URL::route('admin.invoices.excel',['startDay'=>'startDate','endDay'=>'endDate','utm[]' => '--UTM--','website' => '--Website--']) !!}" > Xuất ra file excel </a>
                            @if(Auth::user()->loai == App\User::SUPPER_ADMIN)
                            <input type="button" value="Xóa" class="btn btn-danger export-excel btn_delete_data" style="float: right;margin-right:10px"/>
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
                                <div id ="ajax_html">
                                <table class="table table-striped table-bordered table-hover" id="" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            @if (Auth::user()->loai == App\User::SUPPER_ADMIN)
                                            <th class="table_action"><input type="checkbox" class="checkbox_all"/></th>
                                            @endif
                                           <th class="table_stt">STT</th>
                                           @foreach($column as $item)
                                                <th class="{{ $item->title_en }}">{{ $item->title_vn }}</th>
                                                
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $stt = 1;?>
                                        @foreach ($todo_items as $key =>  $item)
                                        <tr>
                                            @if (Auth::user()->loai == App\User::SUPPER_ADMIN)
                                                <td class="table_action"><input type="checkbox" name ="idCheckbox[]" class="checkbox_item" value="{{ $item->id }}"/></td>
                                            @endif
                                            <td class="table_stt"><?php echo $stt++; ?></td>
                                            <td class="name">{{ $item->name }}</td>
                                            <td class="phone">{{ $item->phone }}</td>
                                            <td class="email">{{ $item->email }}</td>
                                            <td class="comment">{{ $item->comment }}</td>
                                            <td class="register_time">{{ $item->register_time }}</td>
                                            <td class="link">{{ $item->link }}</td>
                                            <td class="source_cookie">{{ $item->source_cookie }}</td>
                                            <td class="utm_source">{{ $item->utm_source }}</td>
                                            <td class="utm_medium">{{ $item->utm_medium }}</td>
                                            <td class="utm_campaign">{{ $item->utm_campaign }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <div style="float: right">{{ $todo_items->links() }}</div>
                                </div>
                                </div>

                    </section><!-- right col -->
                </div><!-- /.row (main row) -->

            </section><!-- /.content -->
        </aside><!-- /.right-side -->
        @stop