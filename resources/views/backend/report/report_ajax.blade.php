@php
    $utm_source = json_decode($result_report->utm_source);
    $week1 = json_decode($result_report->week1);
    $week2 = json_decode($result_report->week2);
    $week3 = json_decode($result_report->week3);
    $week4 = json_decode($result_report->week4);
    $total_utm = json_decode($result_report->total_utm);
    $total_week = json_decode($result_report->total_week);
@endphp
<li style='display:none' id='menu_ajax'><a data-toggle="tab" href="#report_{{$result_report->id}}">{{ $result_report->website }}</a></li>
<div id="report_{{$result_report->id}}" class="report_data tab-pane fade in" >
    <div class="title_report">Báo cáo UTM của website {{ $result_report->website }} từ ngày {{$result_report->startDay}} đến {{$result_report->endDay}}</div>
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
                <tr>
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
            @foreach($result_report_utm_parent as $item)
            @php $thucte[] = $item->thucte;$kpi[] = $item->kpi;  @endphp
                <tr>
                    <td>{{ $item->title }}</td>
                    <td><input type="text" class="input_kpi" data-id-parent="{{$result_report->id}}" data-id="{{ $item->id }}" value="{{ $item->kpi }}" data-thucte="{{ $item->thucte }}" /></td>
                    <td>{{ $item->thucte }}</td>
                    @if($item->ketqua < 80)
                        <td class="ketqua_utm_parent_{{ $item->id }} kpi_phantram" style='color:red'>{{ $item->ketqua }} %</td>
                    @elseif($item->ketqua < 100)
                        <td class="ketqua_utm_parent_{{ $item->id }} kpi_phantram" style='color:#e89b0e'>{{ $item->ketqua }} %</td>
                    @else
                        <td class="ketqua_utm_parent_{{ $item->id }} kpi_phantram" style='color:#0e1fe8'>{{ $item->ketqua }} %</td>
                    @endif
                </tr>
            @endforeach
             @php $sum_datduoc = (array_sum($kpi) != 0) ? (array_sum($thucte[$result_report->id])/array_sum($kpi[$result_report->id]))*100  : '0 %'; @endphp
                <tr>
                    <td>Tổng</td>
                    <td class="total_kpi_{{$result_report->id}}">{{ array_sum($kpi) }}</td>
                    <td class="total_thucte_{{$result_report->id}}">{{ array_sum($thucte) }}</td>
                    @if($sum_datduoc < 80)
                        <td class="total_datduoc_{{$result_report->id}} kpi_phantram" style='color:red'>{{$sum_datduoc}}</td>
                    @elseif($sum_datduoc < 100)
                        <td class="total_datduoc_{{$result_report->id}} kpi_phantram" style='color:#e89b0e'>{{$sum_datduoc}}</td>
                    @else
                        <td class="total_datduoc_{{$result_report->id}} kpi_phantram" style='color:#0e1fe8'>{{$sum_datduoc}}</td>
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
                        <th>Impress/Reach</th>
                        <th>CTR</th>
                        <th>CPC</th>
                        <th>COST</th>
                        <th>CR</th>
                        <th>CPL</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($report_total as $item_report_total)
                    <tr class="{{ $item_report_total->hangmuc }}" data-id="{{ $item_report_total->id }}" >
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
             @php 
                $detail_week1 = json_decode($report_detail->week1);
                $detail_week2 = json_decode($report_detail->week2);
                $detail_week3 = json_decode($report_detail->week3);
                $detail_week4 = json_decode($report_detail->week4);
             @endphp
                 @if(count($detail_week1) > 0)
                <table>
                    <caption class="">Tuần 1</caption>
                    <thead>
                        <tr>
                            <th>Hạng mục</th>
                            <th>Đạt</th>
                            <th>Clicks</th>
                            <th>Impress/Reach</th>
                            <th>CTR</th>
                            <th>CPC</th>
                            <th>COST</th>
                            <th>CR</th>
                            <th>CPL</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($detail_week1 as $key_week => $item_detail)
                            <tr class="week1_{{$key_week}}_{{$report_detail->id}} {{$item_detail->hangmuc }}">
                                <td class="input_hangmuc">{{ $item_detail->hangmuc }}</td>
                                <td class="input_thucte">{{ $item_detail->thucte }}</td>
                                <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_clicks_{{ $item_detail->hangmuc }} input_clicks money" data-id-parent="{{$report_detail->report_id}}" data-key="{{ $key_week }}" data-id="{{ $report_detail->id }}" value="{{ $item_detail->click }}"  /></td>
                                <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_impress_{{ $item_detail->hangmuc }} input_impress money" data-id-parent="{{$report_detail->report_id}}" data-id="{{ $report_detail->id }}" value="{{ $item_detail->Impress }}"  /></td>
                                <td class="input_ctr">{{ $item_detail->ctr }} %</td>
                                <td class="input_cpc">{{ $item_detail->cpc }}</td>
                                <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_cost_{{ $item_detail->hangmuc }} input_cost money" data-id-parent="{{$report_detail->report_id}}" data-id="{{ $report_detail->id }}" value="{{ $item_detail->cost }}"  /></td>
                                <td class="input_cr">{{ $item_detail->cr }} %</td>
                                <td class="input_cpl money">{{ $item_detail->cpl }}</td>
                            </tr>
                        
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
                            <th>Impress/Reach</th>
                            <th>CTR</th>
                            <th>CPC</th>
                            <th>COST</th>
                            <th>CR</th>
                            <th>CPL</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($detail_week2 as $key_week => $item_detail)
                         <tr class="week2_{{$key_week}}_{{$report_detail->id}} {{$item_detail->hangmuc }}">
                            <td class="input_hangmuc">{{ $item_detail->hangmuc }}</td>
                            <td class="input_thucte">{{ $item_detail->thucte }}</td>
                            <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_clicks_{{ $item_detail->hangmuc }} input_clicks money" data-id-parent="{{$report_detail->report_id}}" data-key="{{ $key_week }}" data-id="{{ $report_detail->id }}" value="{{ $item_detail->click }}"  /></td>
                            <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_impress_{{ $item_detail->hangmuc }} input_impress money" data-id-parent="{{$report_detail->report_id}}" data-id="{{ $report_detail->id }}" value="{{ $item_detail->Impress }}"  /></td>
                            <td class="input_ctr">{{ $item_detail->ctr }} %</td>
                            <td class="input_cpc">{{ $item_detail->cpc }}</td>
                            <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_cost_{{ $item_detail->hangmuc }} input_cost money" data-id-parent="{{$report_detail->report_id}}" data-id="{{ $report_detail->id }}" value="{{ $item_detail->cost }}"  /></td>
                            <td class="input_cr">{{ $item_detail->cr }} %</td>
                            <td class="input_cpl money">{{ $item_detail->cpl }}</td>
                        </tr>
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
                            <th>Impress/Reach</th>
                            <th>CTR</th>
                            <th>CPC</th>
                            <th>COST</th>
                            <th>CR</th>
                            <th>CPL</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($detail_week3 as $key_week => $item_detail)
                        <tr class="week3_{{$key_week}}_{{$report_detail->id}} {{$item_detail->hangmuc }}">
                            <td class="input_hangmuc">{{ $item_detail->hangmuc }}</td>
                            <td class="input_thucte">{{ $item_detail->thucte }}</td>
                            <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_clicks_{{ $item_detail->hangmuc }} input_clicks money" data-id-parent="{{$report_detail->report_id}}" data-key="{{ $key_week }}" data-id="{{ $report_detail->id }}" value="{{ $item_detail->click }}"  /></td>
                            <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_impress_{{ $item_detail->hangmuc }} input_impress money" data-id-parent="{{$report_detail->report_id}}" data-id="{{ $report_detail->id }}" value="{{ $item_detail->Impress }}"  /></td>
                            <td class="input_ctr">{{ $item_detail->ctr }} %</td>
                            <td class="input_cpc">{{ $item_detail->cpc }}</td>
                            <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_cost_{{ $item_detail->hangmuc }} input_cost money" data-id-parent="{{$report_detail->report_id}}" data-id="{{ $report_detail->id }}" value="{{ $item_detail->cost }}"  /></td>
                            <td class="input_cr">{{ $item_detail->cr }} %</td>
                            <td class="input_cpl money">{{ $item_detail->cpl }}</td>
                        </tr>
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
                            <th>Impress/Reach</th>
                            <th>CTR</th>
                            <th>CPC</th>
                            <th>COST</th>
                            <th>CR</th>
                            <th>CPL</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($detail_week4 as $key_week => $item_detail)
                        <tr class="week4_{{$key_week}}_{{$report_detail->id}} {{$item_detail->hangmuc }}">
                            <td class="input_hangmuc">{{ $item_detail->hangmuc }}</td>
                            <td class="input_thucte">{{ $item_detail->thucte }}</td>
                            <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_clicks_{{ $item_detail->hangmuc }} input_clicks money" data-id-parent="{{$report_detail->report_id}}" data-key="{{ $key_week }}" data-id="{{ $report_detail->id }}" value="{{ $item_detail->click }}"  /></td>
                            <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_impress_{{ $item_detail->hangmuc }} input_impress money" data-id-parent="{{$report_detail->report_id}}" data-id="{{ $report_detail->id }}" value="{{ $item_detail->Impress }}"  /></td>
                            <td class="input_ctr">{{ $item_detail->ctr }} %</td>
                            <td class="input_cpc">{{ $item_detail->cpc }}</td>
                            <td><input type="text" data-mask="#.##0" data-mask-reverse="true" data-mask-maxlength="false" class="input_cost_{{ $item_detail->hangmuc }} input_cost money" data-id-parent="{{$report_detail->report_id}}" data-id="{{ $report_detail->id }}" value="{{ $item_detail->cost }}"  /></td>
                            <td class="input_cr">{{ $item_detail->cr }} %</td>
                            <td class="input_cpl money">{{ $item_detail->cpl }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
        </div>
    </div>
    <div class="button_report">
         <a href="{!! URL::route('deleteReport', $result_report->id ) !!}"><button type="button" class="btn btn-danger">Xóa</button></a>
        <a href="{!! URL::route('refeshReport', ['id'=>$result_report->id,'website'=>$result_report->website,'startDay' => $result_report->startDay,'endDay' => $result_report->endDay] ) !!}"><button type="button" class="btn btn-success">Làm mới</button></a>
    </div>
   
</div>