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
                                <div class="col-sm-3">
                                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;margin-bottom: 10px">
                                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                        <span></span> <b class="caret"></b>
                                    </div>
                                </div>
                                <div id ="ajax_html">
                                    <table>
                                        <caption>Báo cáo</caption>
                                        <thead>
                                            <tr>
                                                <th>Utm Source</th>
                                                <th>Tuần 1</th>
                                                <th>Tuần 2</th>
                                                <th>Tuần 3</th>
                                                <th>Tuần 4</th>
                                                <th>Tổng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php $sum_tuan1 = 0;$sum_tuan2 = 0;$sum_tuan3 = 0;$sum_tuan4 = 0; @endphp
                                        @foreach($result as $key => $item)
                                            
                                            <tr>
                                                <td>{{ ($key == '') ? 'NA' : $key }}</td>
                                                <td>
                                                    @foreach($count_week1 as $key_tuan1 => $tuan1)
                                                       {{ ($key == $key_tuan1) ? $tuan1 : '' }}
                                                    @endforeach
                                                   {{ (isset($count_week1[$key])) ? '' : '0' }}
                                                </td>
                                                <td>
                                                    @foreach($count_week2 as $key_tuan2 => $tuan2)
                                                       {{ ($key == $key_tuan2) ? $tuan2 : '' }}
                                                    @endforeach
                                                    {{ (isset($count_week2[$key])) ? '' : '0' }}
                                                </td>
                                                <td>
                                                    @foreach($count_week3 as $key_tuan3 => $tuan3)
                                                       {{ ($key == $key_tuan3) ? $tuan3 : '' }}
                                                    @endforeach
                                                    {{ (isset($count_week3[$key])) ? '' : '0' }}
                                                </td>
                                                <td>
                                                    @foreach($count_week4 as $key_tuan4 => $tuan4)
                                                       {{ ($key == $key_tuan4) ? $tuan4 : '' }}
                                                    @endforeach
                                                    {{ (isset($count_week4[$key])) ? '' : '0' }}
                                                </td>
                                                <td>{{ count($item) }}</td>
                                            </tr>
                                        @endforeach
                                            <tr>
                                                <td>Tổng</td>
                                                <td>
                                                    @foreach($count_week1 as $key_tuan1 => $tuan1)
                                                        @php $sum_tuan1 += $tuan1; @endphp
                                                    @endforeach
                                                    {{ $sum_tuan1 }}
                                                </td>
                                                <td>
                                                    @foreach($count_week2 as $key_tuan2 => $tuan2)
                                                        @php $sum_tuan2 += $tuan2; @endphp
                                                    @endforeach
                                                    {{ $sum_tuan2 }}
                                                </td>
                                                <td>
                                                    @foreach($count_week3 as $key_tuan3 => $tuan3)
                                                        @php $sum_tuan3 += $tuan3; @endphp
                                                    @endforeach
                                                    {{ $sum_tuan3 }}
                                                </td>
                                                <td>
                                                     @foreach($count_week4 as $key_tuan4 => $tuan4)
                                                        @php $sum_tuan4 += $tuan4; @endphp
                                                    @endforeach
                                                    {{ $sum_tuan4 }}
                                                </td>
                                                <td>{{ $sum_tuan1 + $sum_tuan2 + $sum_tuan3 + $sum_tuan4 }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                </div>

                    </section><!-- right col -->
                </div><!-- /.row (main row) -->

            </section><!-- /.content -->
        </aside><!-- /.right-side -->
        @stop