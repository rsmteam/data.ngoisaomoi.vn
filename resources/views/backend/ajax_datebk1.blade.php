<?php 
    // echo "<pre>";
    // var_dump($utm);
    $utm_str = implode(",",$utm);
    $website_str = implode(",",$website_arr);
?>
<a style="float: right;margin-bottom: 10px;display: none" class="btn btn-primary export-excel-ajax" href="{!! URL::route('admin.invoices.excel',['startDay'=>$startDate,'endDay'=>$endDate,'utm' => $utm_str,'website' => $website_str]) !!}" ></a>
<input type="hidden" class="count_data" value="<?php echo count($todo_items); ?>"/>
<select style="display: none" id="select_utm_ajax" class="form-control pull-right" multiple size="6">
        <option>--UTM--</option>
            @if(getType(@$utm_select) == 'array' )
             @foreach(@$utm_select as $key => $items )
               
                <option value="{{ ($key == '') ? 'NA' : $key }}"<?php for($i = 0; $i <= count($utm)-1;$i++){echo ($key == $utm[$i]) ? 'selected' : '' ; } ?>  > {{ ($key == '') ? 'NA' : $key }} </option>

            @endforeach
            @endif
</select>

<select style="display: none" id="select_website_ajax" class="form-control pull-right" multiple size="6">
            <option>--Website--</option>
            @if(getType(@$website_select) == 'array' )
             @foreach(@$website_select as $key => $items )
                @if($key != '')
                <option value="{{ $key }}"<?php for($i = 0; $i <= count($utm)-1;$i++){echo ($key == $utm[$i]) ? 'selected' : '' ; } ?>  > {{ $key }} </option>
                @endif
            @endforeach
            @endif
</select>

<table class="table table-striped table-bordered table-hover" id="dataTables-example" cellspacing="0" width="100%">
        
        <thead>
            <tr>
                @if(Auth::user()->loai == App\User::SUPPER_ADMIN)
                <th class="table_action"><input type="checkbox" class="checkbox_all"/></th>
                @endif
               <th class="table_stt">STT</th>
                <th>Họ tên</th>
                <th>Điện thoại</th>
                <th>Email</th>
                <th class="col-md-2">Nội dung</th>
                <th>Ngày</th>
                <th>Nguồn</th>
                <th>Source cookie</th>
                <th>utm_source</th>
                <th>utm_medium</th>
                <th>utm_campaign</th>
                
            </tr>
        </thead>
        <tbody>
            @php $stt = 1; @endphp
                @foreach($todo_items as $item )
                <tr>
                    @if(Auth::user()->loai == App\User::SUPPER_ADMIN)
                    <td class="table_action"><input type="checkbox" name ="idCheckbox[]" class="checkbox_item " value="{{ $item->id }}"/></td>
                    @endif
                    <td class="table_stt"><?php echo $stt++; ?></td>
                    <td>{{ $item->name }} </td>
                    <td>{{ $item->phone }} </td>
                    <td>{{ $item->email }} </td>
                    <td>{{ $item->comment }} </td>
                    <td>{{ $item->register_time }} </td>
                    <td>{{ $item->link }} </td>
                    <td>{{ $item->source_cookie }} </td>
                    <td>{{ $item->utm_source }} </td>
                    <td>{{ $item->utm_medium }} </td>
                    <td>{{ $item->utm_campaign }} </td>
                </tr>
                @endforeach
        </tbody>
    </table>
