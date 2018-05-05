<?php 
    // echo "<pre>";
    // var_dump($utm);
    $utm_str = implode(",",$utm);
    $website_str = implode(",",$website_arr);
?>
<a style="float: right;margin-bottom: 10px;display: none" class="btn btn-primary export-excel-ajax" href="{!! URL::route('admin.invoices.excel',['startDay'=>$startDate,'endDay'=>$endDate,'utm' => $utm_str,'website' => $website_str]) !!}" ></a>
<input type="hidden" class="count_data" value="{{ $total_data }}"/>
<input type="hidden" class="count_link" value="{{ count($link) }}"/>
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

<div id="total_data_model_ajax" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Thống kê data theo nguồn website</h4>
      </div>
      <div class="modal-body">
         @foreach($link as $key => $item_link)
            <p>{{ $key }} ({{ count($link[$key]) }})</p>
         @endforeach
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

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