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
                    <button style="margin-left: 20px" class="btn btn-round btn-primary hidden-xs pull-left" data-dismiss="modal" data-toggle="modal" data-target="#report">Tạo thống kê</button>
                    <!-- Left col -->
                    <section class="col-lg-12 connectedSortable">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <b><i>Danh sách data</i></b>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <!-- popup tạo thống kê -->
                                <div id="report" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="smalltitle active">Tạo thống kê</h4>

                                            </div>

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 report_right">
                                                        <form class="form_report_utm formcol hozform"  method="post" accept-charset="utf-8">
                                                            <div class="form-group row">
                                                                 <label class="control-label hidden-xs col-sm-3">Dự án</label>
                                                                 <div class="col-sm-9">
                                                                    <select  class="select_website form-control">
                                                                        <option value="--Website--">--Website--</option>
                                                                        @foreach($link as $item)
                                                                        @if($item->link_website != '')
                                                                        <option>{{ $item->link_website }}</option>
                                                                        @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                 <label class="control-label hidden-xs col-sm-3">Thời gian</label>
                                                                 <div class="col-sm-9">
                                                                     <input type="text" class="form-control reportrange" value="Thời gian" />
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <p style="text-align: center;color: red" class="err_form_report"></p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <div class="row kqdgaction">
                                                    <div class="col-sm-8 text-left hidden-xs">
                                                    </div>
                                                    <div class="col-sm-4 text-right">
                                                        <button type="button" class="btn btn-default btn-icon create_report"><span class="icon-user-o"></span> Tạo thống kê </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end popup tạo thống kê -->
                                <div class="report_load">
                                 <ul id="menu_tab" class="nav nav-tabs">

                                    @foreach($result as $key_menu => $item_menu_tab)
                                        <li {{ ($key_menu == 0) ? 'class=active' : '' }}><a data-toggle="tab" href="#report_{{$item_menu_tab->id}}">{{ $item_menu_tab->website }}</a></li>
                                    @endforeach
                                  </ul>
                                   <div class="tab-content">
                                @foreach($result as $key_report =>  $item_result)
                                @php
                                    $utm_source = json_decode($item_result->utm_source);
                                    $week1 = json_decode($item_result->week1);
                                    $week2 = json_decode($item_result->week2);
                                    $week3 = json_decode($item_result->week3);
                                    $week4 = json_decode($item_result->week4);
                                    $total_utm = json_decode($item_result->total_utm);
                                    $total_week = json_decode($item_result->total_week);
                                @endphp
                                     
                                    <div id="report_{{$item_result->id}}" class="report_data tab-pane fade in {{ ($key_report == 0) ? 'active' : '' }}" >
                                        <div class="title_report">Báo cáo UTM của website {{ $item_result->website }} từ ngày {{$item_result->startDay}} đến {{$item_result->endDay}}</div>
                                        <div class="col-left">
                                            <div class="report_utm">
                                                <table>
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
                                                    @foreach($utm_source as $item)
                                                        
                                                        <tr>
                                                            <td>{{ $item }}</td>
                                                            <td>
                                                                @if(count($week1) > 0)
                                                                    @foreach($week1 as $key_tuan1 => $tuan1)
                                                                       {{ ($item == $key_tuan1) ? $tuan1 : '' }}
                                                                    @endforeach
                                                                    {{ (isset($week1->$item)) ? '' : '0' }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if(count($week2) > 0)
                                                                    @foreach($week2 as $key_tuan2 => $tuan2)
                                                                       {{ ($item == $key_tuan2) ? $tuan2 : '' }}
                                                                    @endforeach
                                                                    {{ (isset($week2->$item)) ? '' : '0' }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td>
                                                               @if(count($week3) > 0)
                                                                    @foreach($week3 as $key_tuan3 => $tuan3)
                                                                       {{ ($item == $key_tuan3) ? $tuan3 : '' }}
                                                                    @endforeach
                                                                    {{ (isset($week3->$item)) ? '' : '0' }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if(count($week4) > 0)
                                                                    @foreach($week4 as $key_tuan4 => $tuan4)
                                                                       {{ ($item == $key_tuan4) ? $tuan4 : '' }}
                                                                    @endforeach
                                                                    {{ (isset($week4->$item)) ? '' : '0' }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            
                                                            <td>
                                                                @foreach($total_utm as $key => $item_total)
                                                                   {{ ($item == $key) ? $item_total : '' }}
                                                                @endforeach
                                                                {{ (isset($total_utm->$item)) ? '' : '0' }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                        <tr class="tr_tong">
                                                            <td>Tổng</td>
                                                            @foreach($total_week as $item)
                                                                <td>{{ $item }}</td>
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="report_utm_parent">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>Hạng mục</th>
                                                            <th>KPI</th>
                                                            <th>Thực tế</th>
                                                            <th>% Đạt</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        $thucte = array();
                                                        $kpi = array();
                                                    @endphp
                                                    @foreach($item_result->utm_parent as $item)
                                                    @php $thucte[$item_result->id][] = $item->thucte;$kpi[$item_result->id][] = $item->kpi;  @endphp
                                                        <tr>
                                                            <td>{{ $item->title }}</td>
                                                            <td><input type="text" class="input_kpi" data-id-parent="{{$item_result->id}}" data-id="{{ $item->id }}" value="{{ $item->kpi }}" data-thucte="{{ $item->thucte }}" /></td>
                                                            <td>{{ $item->thucte }}</td>
                                                            @if($item->ketqua < 80)
                                                                <td class="ketqua_utm_parent_{{ $item->id }} kpi_phantram" style='background-color:#ea1d63'>{{ $item->ketqua }} %</td>
                                                            @elseif($item->ketqua < 100)
                                                                <td class="ketqua_utm_parent_{{ $item->id }} kpi_phantram" style='background-color:#e9900a'>{{ $item->ketqua }} %</td>
                                                            @else
                                                                <td class="ketqua_utm_parent_{{ $item->id }} kpi_phantram" style='background-color:#31a69a'>{{ $item->ketqua }} %</td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                    @php $sum_datduoc = (array_sum($kpi[$item_result->id]) != 0) ? round((array_sum($thucte[$item_result->id])/array_sum($kpi[$item_result->id]))*100) : '0'; @endphp
                                                        <tr class="tr_tong">
                                                            <td>Tổng</td>
                                                            <td class="total_kpi_{{$item_result->id}}">{{ array_sum($kpi[$item_result->id]) }}</td>
                                                            <td class="total_thucte_{{$item_result->id}}">{{ array_sum($thucte[$item_result->id]) }}</td>
                                                            @if($sum_datduoc < 80)
                                                                <td class="total_datduoc_{{$item_result->id}} kpi_phantram" style='background-color:#ea1d63'>{{$sum_datduoc}} %</td>
                                                            @elseif($sum_datduoc < 100)
                                                                <td class="total_datduoc_{{$item_result->id}} kpi_phantram" style='background-color:#e9900a'>{{$sum_datduoc}} %</td>
                                                            @else
                                                                <td class="total_datduoc_{{$item_result->id}} kpi_phantram" style='background-color:#31a69a'>{{$sum_datduoc}} %</td>
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-right">
                                            <div class="report_total">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>Hạng mục</th>
                                                            <th>Đạt</th>
                                                            <th>Clicks</th>
                                                            <th>Reach</th>
                                                            <th>CTR</th>
                                                            <th>CPC</th>
                                                            <th>COST</th>
                                                            <th>CR</th>
                                                            <th>CPL</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       @foreach($item_result->report_total as $item_report_total)
                                                        <tr class="{{ $item_report_total->hangmuc }}_{{$item_result->id}} {{ ($item_report_total->hangmuc == 'Tổng') ? 'sum_total_'.$item_result->id : '' }}" data-id="{{ $item_report_total->id }}" >
                                                            <td>{{ $item_report_total->hangmuc }}</td>
                                                            <td class="input_thucte">{{ $item_report_total->thucte }}</td>
                                                            <td class="input_clicks_{{ $item_report_total->hangmuc }} input_clicks"><span class="money">{{ $item_report_total->click }}</span></td>
                                                            <td class="input_impress_{{ $item_report_total->hangmuc }} input_impress"><span class="money">{{ $item_report_total->impress }}</span></td>
                                                            <td class="input_ctr">{{ $item_report_total->ctr }} %</td>
                                                            <td class="input_cpc"><span class="money">{{ $item_report_total->cpc }}</span></td>
                                                            <td class="input_cost_{{ $item_report_total->hangmuc }} input_cost"><span class="money">{{ $item_report_total->cost }}</span></td>
                                                            <td class="input_cr">{{ $item_report_total->cr }} %</td>
                                                            <td class="input_cpl money">{{ $item_report_total->cpl }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="detail_week">
                                                 @foreach($item_result->detail_week as $key_detail => $item)
                                                 @php 
                                                    $detail_week1 = json_decode($item->week1);
                                                    $detail_week2 = json_decode($item->week2);
                                                    $detail_week3 = json_decode($item->week3);
                                                    $detail_week4 = json_decode($item->week4);
                                                 @endphp
                                                     @if(count($detail_week1) > 0)
                                                    <table class="table_report_detail">
                                                        <caption class="">Tuần 1</caption>
                                                        <thead>
                                                            <tr>
                                                                <th>Hạng mục</th>
                                                                <th>Đạt</th>
                                                                <th>Clicks</th>
                                                                <th>Reach</th>
                                                                <th>CTR</th>
                                                                <th>CPC</th>
                                                                <th>COST</th>
                                                                <th>CR</th>
                                                                <th>CPL</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="{{ 'week1_'.$item_result->id }}">
                                                           @foreach($detail_week1 as $key_week => $item_detail)
                                                           @if($item_detail->hangmuc != 'Tổng')
                                                                <tr class="week1_{{$key_week}}_{{$item_result->id}} {{$item_detail->hangmuc }}_{{$item_result->id}} ">
                                                                    <td class="input_hangmuc">{{ $item_detail->hangmuc }}</td>
                                                                    <td class="input_thucte">{{ $item_detail->thucte }}</td>
                                                                    <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_clicks_{{ $item_detail->hangmuc }} input_clicks" data-id-parent="{{$item_result->id}}" data-key="{{ $key_week }}" data-id="{{ $item->id }}" value="{{ $item_detail->click }}"  /></td>
                                                                    <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_impress_{{ $item_detail->hangmuc }} input_impress" data-id-parent="{{$item_result->id}}" data-id="{{ $item->id }}" value="{{ $item_detail->Impress }}"  /></td>
                                                                    <td class="input_ctr">{{ $item_detail->ctr }} %</td>
                                                                    <td class="input_cpc">{{ $item_detail->cpc }}</td>
                                                                    <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_cost_{{ $item_detail->hangmuc }} input_cost" data-id-parent="{{$item_result->id}}" data-id="{{ $item->id }}" value="{{ $item_detail->cost }}"  /></td>
                                                                    <td class="input_cr">{{ $item_detail->cr }} %</td>
                                                                    <td class="input_cpl money">{{ $item_detail->cpl }}</td>
                                                                </tr>
                                                            @else
                                                                <tr class="week1_'{{$item_result->id}}">
                                                                    <td >{{ $item_detail->hangmuc }}</td>
                                                                    <td class="sum_week_thucte">{{ $item_detail->thucte }}</td>
                                                                    <td class="sum_week_click">{{ $item_detail->click }}</td>
                                                                    <td class="sum_week_impress">{{ $item_detail->Impress }}</td>
                                                                    <td class="sum_week_ctr">{{ $item_detail->ctr }} %</td>
                                                                    <td class="sum_week_cpc">{{ $item_detail->cpc }}</td>
                                                                    <td class="sum_week_cost">{{ $item_detail->cost }}</td>
                                                                    <td class="sum_week_cr">{{ $item_detail->cr }} %</td>
                                                                    <td class="sum_week_cpl">{{ $item_detail->cpl }}</td>
                                                                </tr>
                                                            @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @endif

                                                    @if(count($detail_week2) > 0)
                                                    <table>
                                                        <caption class="">Tuần 2</caption>
                                                        <thead>
                                                            <tr>
                                                                <th>Hạng mục</th>
                                                                <th>Đạt</th>
                                                                <th>Clicks</th>
                                                                <th>Reach</th>
                                                                <th>CTR</th>
                                                                <th>CPC</th>
                                                                <th>COST</th>
                                                                <th>CR</th>
                                                                <th>CPL</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="{{ 'week2_'.$item_result->id }}">
                                                           @foreach($detail_week2 as $key_week => $item_detail)
                                                            @if($item_detail->hangmuc != 'Tổng')
                                                                <tr class="week2_{{$key_week}}_{{$item_result->id}} {{$item_detail->hangmuc }}_{{$item_result->id}} ">
                                                                    <td class="input_hangmuc">{{ $item_detail->hangmuc }}</td>
                                                                    <td class="input_thucte">{{ $item_detail->thucte }}</td>
                                                                    <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_clicks_{{ $item_detail->hangmuc }} input_clicks" data-id-parent="{{$item_result->id}}" data-key="{{ $key_week }}" data-id="{{ $item->id }}" value="{{ $item_detail->click }}"  /></td>
                                                                    <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_impress_{{ $item_detail->hangmuc }} input_impress" data-id-parent="{{$item_result->id}}" data-id="{{ $item->id }}" value="{{ $item_detail->Impress }}"  /></td>
                                                                    <td class="input_ctr">{{ $item_detail->ctr }} %</td>
                                                                    <td class="input_cpc">{{ $item_detail->cpc }}</td>
                                                                    <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_cost_{{ $item_detail->hangmuc }} input_cost" data-id-parent="{{$item_result->id}}" data-id="{{ $item->id }}" value="{{ $item_detail->cost }}"  /></td>
                                                                    <td class="input_cr">{{ $item_detail->cr }} %</td>
                                                                    <td class="input_cpl money">{{ $item_detail->cpl }}</td>
                                                                </tr>
                                                            @else
                                                                <tr class="week2_'{{$item_result->id}}">
                                                                    <td >{{ $item_detail->hangmuc }}</td>
                                                                    <td class="sum_week_thucte">{{ $item_detail->thucte }}</td>
                                                                    <td class="sum_week_click">{{ $item_detail->click }}</td>
                                                                    <td class="sum_week_impress">{{ $item_detail->Impress }}</td>
                                                                    <td class="sum_week_ctr">{{ $item_detail->ctr }} %</td>
                                                                    <td class="sum_week_cpc">{{ $item_detail->cpc }}</td>
                                                                    <td class="sum_week_cost">{{ $item_detail->cost }}</td>
                                                                    <td class="sum_week_cr">{{ $item_detail->cr }} %</td>
                                                                    <td class="sum_week_cpl">{{ $item_detail->cpl }}</td>
                                                                </tr>
                                                            @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @endif

                                                    @if(count($detail_week3) > 0)
                                                    <table>
                                                        <caption class="">Tuần 3</caption>
                                                        <thead>
                                                            <tr>
                                                                <th>Hạng mục</th>
                                                                <th>Đạt</th>
                                                                <th>Clicks</th>
                                                                <th>Reach</th>
                                                                <th>CTR</th>
                                                                <th>CPC</th>
                                                                <th>COST</th>
                                                                <th>CR</th>
                                                                <th>CPL</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="{{ 'week3_'.$item_result->id }}">
                                                           @foreach($detail_week3 as $key_week => $item_detail)
                                                            @if($item_detail->hangmuc != 'Tổng')
                                                                <tr class="week3_{{$key_week}}_{{$item_result->id}} {{$item_detail->hangmuc }}_{{$item_result->id}} ">
                                                                    <td class="input_hangmuc">{{ $item_detail->hangmuc }}</td>
                                                                    <td class="input_thucte">{{ $item_detail->thucte }}</td>
                                                                    <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_clicks_{{ $item_detail->hangmuc }} input_clicks" data-id-parent="{{$item_result->id}}" data-key="{{ $key_week }}" data-id="{{ $item->id }}" value="{{ $item_detail->click }}"  /></td>
                                                                    <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_impress_{{ $item_detail->hangmuc }} input_impress" data-id-parent="{{$item_result->id}}" data-id="{{ $item->id }}" value="{{ $item_detail->Impress }}"  /></td>
                                                                    <td class="input_ctr">{{ $item_detail->ctr }} %</td>
                                                                    <td class="input_cpc">{{ $item_detail->cpc }}</td>
                                                                    <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_cost_{{ $item_detail->hangmuc }} input_cost" data-id-parent="{{$item_result->id}}" data-id="{{ $item->id }}" value="{{ $item_detail->cost }}"  /></td>
                                                                    <td class="input_cr">{{ $item_detail->cr }} %</td>
                                                                    <td class="input_cpl money">{{ $item_detail->cpl }}</td>
                                                                </tr>
                                                            @else
                                                                <tr class="week3_'{{$item_result->id}}">
                                                                    <td >{{ $item_detail->hangmuc }}</td>
                                                                    <td class="sum_week_thucte">{{ $item_detail->thucte }}</td>
                                                                    <td class="sum_week_click">{{ $item_detail->click }}</td>
                                                                    <td class="sum_week_impress">{{ $item_detail->Impress }}</td>
                                                                    <td class="sum_week_ctr">{{ $item_detail->ctr }} %</td>
                                                                    <td class="sum_week_cpc">{{ $item_detail->cpc }}</td>
                                                                    <td class="sum_week_cost">{{ $item_detail->cost }}</td>
                                                                    <td class="sum_week_cr">{{ $item_detail->cr }} %</td>
                                                                    <td class="sum_week_cpl">{{ $item_detail->cpl }}</td>
                                                                </tr>
                                                            @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @endif

                                                    @if(count($detail_week4) > 0)
                                                    <table>
                                                        <caption class="">Tuần 4</caption>
                                                        <thead>
                                                            <tr>
                                                                <th>Hạng mục</th>
                                                                <th>Đạt</th>
                                                                <th>Clicks</th>
                                                                <th>Reach</th>
                                                                <th>CTR</th>
                                                                <th>CPC</th>
                                                                <th>COST</th>
                                                                <th>CR</th>
                                                                <th>CPL</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="{{ 'week4_'.$item_result->id }}">
                                                           @foreach($detail_week4 as $key_week => $item_detail)
                                                           @if($item_detail->hangmuc != 'Tổng')
                                                                <tr class="week4_{{$key_week}}_{{$item_result->id}} {{$item_detail->hangmuc }}_{{$item_result->id}} ">
                                                                    <td class="input_hangmuc">{{ $item_detail->hangmuc }}</td>
                                                                    <td class="input_thucte">{{ $item_detail->thucte }}</td>
                                                                    <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_clicks_{{ $item_detail->hangmuc }} input_clicks" data-id-parent="{{$item_result->id}}" data-key="{{ $key_week }}" data-id="{{ $item->id }}" value="{{ $item_detail->click }}"  /></td>
                                                                    <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_impress_{{ $item_detail->hangmuc }} input_impress" data-id-parent="{{$item_result->id}}" data-id="{{ $item->id }}" value="{{ $item_detail->Impress }}"  /></td>
                                                                    <td class="input_ctr">{{ $item_detail->ctr }} %</td>
                                                                    <td class="input_cpc">{{ $item_detail->cpc }}</td>
                                                                    <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_cost_{{ $item_detail->hangmuc }} input_cost" data-id-parent="{{$item_result->id}}" data-id="{{ $item->id }}" value="{{ $item_detail->cost }}"  /></td>
                                                                    <td class="input_cr">{{ $item_detail->cr }} %</td>
                                                                    <td class="input_cpl money">{{ $item_detail->cpl }}</td>
                                                                </tr>
                                                            @else
                                                                <tr class="week4_'{{$item_result->id}}">
                                                                    <td >{{ $item_detail->hangmuc }}</td>
                                                                    <td class="sum_week_thucte">{{ $item_detail->thucte }}</td>
                                                                    <td class="sum_week_click">{{ $item_detail->click }}</td>
                                                                    <td class="sum_week_impress">{{ $item_detail->Impress }}</td>
                                                                    <td class="sum_week_ctr">{{ $item_detail->ctr }} %</td>
                                                                    <td class="sum_week_cpc">{{ $item_detail->cpc }}</td>
                                                                    <td class="sum_week_cost">{{ $item_detail->cost }}</td>
                                                                    <td class="sum_week_cr">{{ $item_detail->cr }} %</td>
                                                                    <td class="sum_week_cpl">{{ $item_detail->cpl }}</td>
                                                                </tr>
                                                            @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @endif
                                                 @endforeach
                                            </div>
                                        </div>
                                        <div class="button_report">
                                            <a href="{!! URL::route('deleteReport', $item_result->id ) !!}"><button type="button" class="btn btn-danger">Xóa</button></a>
                                            <a href="{!! URL::route('refeshReport', ['id'=>$item_result->id,'website'=>$item_result->website,'startDay' => $item_result->startDay,'endDay' => $item_result->endDay] ) !!}"><button type="button" class="btn btn-success">Làm mới</button></a>
                                        </div>
                                    </div>
                                    
                                    @endforeach
                                    <!-- </div> -->
                                </div>

                            </div>
                        </div>

                    </section><!-- right col -->
                </div><!-- /.row (main row) -->

            </section><!-- /.content -->
        </aside><!-- /.right-side -->
        @stop