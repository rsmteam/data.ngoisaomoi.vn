
$(document).ready(function() {
        table = $('#dataTables-example').DataTable( {
		    responsive: true,
		    // 'scrollX': true
		} );

		$('#date_DateJoin').datepicker({
			dateFormat: "yy-mm-dd"
		});
            
        $(document).find('.money').each(function () {
            var number = Number($(this).text().split('.').join("").split(',').join(""));
            // $(this).text(Math.ceil(number).toLocaleString());
            $(this).text(Math.ceil(number).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        });
		$('#reportrange').on('apply.daterangepicker', function(ev, picker) {
    
		    // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		    // var result = host.split('/');
		     var starDay = picker.startDate.format('YYYY-MM-DD');
		     var endDay = picker.endDate.format('YYYY-MM-DD');
		     var val_utm = $( "#select_utm" ).val() || [];
	            if(val_utm.length < 1){
	            	val_utm = ['null'];
	            }
         
		     var val_website = $( "#select_website" ).val() || 'null';
		     var arr = {starDay:starDay,endDay:endDay,utm:val_utm,website:val_website};
		     AjaxLoadData(arr);
		    
		});
    
		$('#select_utm').change(function(e){
        // var val_utm = $('#select_utm option:selected').val();
        var val_utm = $( "#select_utm" ).val() || ['null'];
        var date_val = $('#reportrange span').html();
        var val_website = $( "#select_website" ).val() || 'null';
        if(val_utm[0] == 'NA'){
            val_utm[0] = '';
        }
        date_val = date_val.split('-');
        starDay = new Date (date_val[0]);
        starDay = starDay.getFullYear()  + '-' + (starDay.getMonth()+1) + '-' + starDay.getDate();
  			endDay = new Date (date_val[1]);
  			endDay = endDay.getFullYear()  + '-' + (endDay.getMonth()+1) + '-' + endDay.getDate();
  			var arr = {starDay:starDay,endDay:endDay,utm:val_utm,website:val_website};
               AjaxLoadData(arr);
    });

    $('#select_column').change(function(){
    	$("#select_column option").each(function(){
      	var values = $(this).val();
          console.log(values);
          $('.'+values).css('display','none');
        });
      	var val_utm = $( "#select_column" ).val() || [];
      	$.each(val_utm, function( index, value ) {
  	  	$('.'+value).css('display','table-cell');
    	});
    });

    $('#select_website').change(function(){
      var val_website = $( "#select_website" ).val() || 'null';
      var val_utm = $( "#select_utm" ).val() || [];
      if(val_utm.length < 1){
      	val_utm = ['null'];
      }
      var date_val = $('#reportrange span').html();
      date_val = date_val.split('-');
      starDay = new Date (date_val[0]);
      starDay = starDay.getFullYear()  + '-' + (starDay.getMonth()+1) + '-' + starDay.getDate();
			endDay = new Date (date_val[1]);
			endDay = endDay.getFullYear()  + '-' + (endDay.getMonth()+1) + '-' + endDay.getDate();
			var arr = {starDay:starDay,endDay:endDay,utm:val_utm,website:val_website};
             AjaxLoadData(arr);
    });

    $('.create_report').click(function(){
    	var website = $('.select_website').val();
    	var date_val = $('.reportrange').val();
      date_val = date_val.split('-');
      var startDay = new Date (date_val[0]);
      startDay = startDay.getFullYear()  + '-' + (startDay.getMonth()+1) + '-' + startDay.getDate();
    	var endDay = new Date (date_val[1]);
    	endDay = endDay.getFullYear()  + '-' + (endDay.getMonth()+1) + '-' + endDay.getDate();
    	if(website == '--Website--'){
    		$('.err_form_report').html('Bạn chưa chọn dự án');
    		return false;
    	}
    	if(date_val == 'Thời gian' || date_val == ''){
    		$('.err_form_report').html('Bạn chưa chọn thời gian');
    		return false;
    	}

    	$.ajax({
            type: "POST",
            url: 'https://data.ngoisaomoi.vn/createReport',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                 startDay: startDay, 
                 endDay: endDay,
                 website: website,
            },
            success: function( data ) {
            	if(data == 'Data Null'){
            		$('.err_form_report').html('Không có dữ liệu');
            		return false;
            	}else if(data == 'Report Really Exist'){
            		$('.err_form_report').html('Báo cáo này đã tồn tại');
            		return false;
            	}
              // console.log(data);
                location.reload();
            	// $('.tab-content').append(data);
            }
        }); 
    });
    $('.form_report_utm select').on('change',function(){
    	$('.err_form_report').html('');
    });
     $('.form_report_utm input').on('focus',function(){
        $('.err_form_report').html('');
    });
    $( ".report_data" ).draggable({ handle: "caption" });
  });

$(document).on('click','.pagination a',function(e){
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    var val_website = $( "#select_website" ).val() || 'null';
    var val_utm = $( "#select_utm" ).val() || [];
    if(val_utm.length < 1){
      val_utm = ['null'];
    }
    var date_val = $('#reportrange span').html();
    date_val = date_val.split('-');
    starDay = new Date (date_val[0]);
    starDay = starDay.getFullYear()  + '-' + (starDay.getMonth()+1) + '-' + starDay.getDate();
    endDay = new Date (date_val[1]);
    endDay = endDay.getFullYear()  + '-' + (endDay.getMonth()+1) + '-' + endDay.getDate();
    var search = {starDay:starDay,endDay:endDay,utm:val_utm,website:val_website};
    getPaginationAjax(page,search);
});

function getPaginationAjax(page,search){
  var url = '/search_date';
  $.ajax({
        type: "get",
        url: url+'?page='+page, 
        data: search,
        success: function( data ) {
           $("#ajax_html").html(data);
        }
    });
}

$('#ajax_html').bind("DOMSubtreeModified",function(){
	if($('#ajax_table').length > 0 ){
		table.destroy();
		table = $('#dataTables-example').DataTable( {
		    responsive: true
		} );
	}
	
});

// sự kiện input report change

$(document).on('change','.input_kpi',function() {

    var value = $(this).val();
    var id = $(this).attr("data-id");
    var report_id = $(this).attr("data-id-parent");
    var thucte = $(this).attr("data-thucte");
    var datduoc =  ((thucte/value)*100).toFixed(0);
    var total_thucte = $('.total_thucte_'+report_id).text();
    var total_kpi = 0;

    if(datduoc < 80){
         $('.ketqua_utm_parent_'+id).html(datduoc + ' %');
         $('.ketqua_utm_parent_'+id).css('background-color','#ea1d63');
    }else if(datduoc < 100){
         $('.ketqua_utm_parent_'+id).html(datduoc + ' %');
          $('.ketqua_utm_parent_'+id).css('background-color','#e9900a');
     }else{
        $('.ketqua_utm_parent_'+id).html(datduoc + ' %');
        $('.ketqua_utm_parent_'+id).css('background-color','#31a69a');
     }
   
    $( ".input_kpi" ).each(function( index ) {
       total_kpi = parseInt(total_kpi) + parseInt($(this).val());
    });
   $('.total_kpi_'+report_id).html(total_kpi);
    var total_datduoc = ((total_thucte/total_kpi)*100).toFixed(0);
    if(total_datduoc < 80){
        $('.total_datduoc_'+report_id).html(total_datduoc + ' %');
        $('.total_datduoc_'+report_id).css('background-color','#ea1d63');
    }else if(total_datduoc < 100){
         $('.total_datduoc_'+report_id).html(total_datduoc + ' %');
         $('.total_datduoc_'+report_id).css('background-color','#e9900a');
    }else{
         $('.total_datduoc_'+report_id).html(total_datduoc + ' %');
         $('.total_datduoc_'+report_id).css('background-color','#31a69a');
    }

    
    $.ajax({
        type: "POST",
        url: 'https://data.ngoisaomoi.vn/UpdateUtmParent',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
             id: id, 
             kpi: value,
             ketqua: datduoc,
        },
        success: function( data ) {
            console.log(data);
        }
    });
});

function convertToInt(str){
    return str.replace(/\./g, '');
}

$(document).on('change', '.input_clicks, .input_impress, .input_cost' ,function(e) {
    var report_id = $(this).attr("data-id-parent");
    var class_current = $(this).attr('class');
    var parent = $(this).parent().parent();
    var class_parent = parent.attr('class');
    var class_table =  $(this).parent().parent().parent().attr('class');
    class_parent = class_parent.split(' ');
    var class_tr = class_parent[0];
    var click = $('.'+class_tr+' .input_clicks').val();
    var impress = $('.'+class_tr+' .input_impress').val();
    var thucte = $('.'+class_tr+' .input_thucte').text();
    var cost = $('.'+class_tr+' .input_cost').val();
    var id = $(this).attr("data-id");
    var key = $(this).attr("data-key");
    var hangmuc = $('.'+class_tr+' .input_hangmuc').text();
    var ctr = 0;
    var cr =0;
    var cpl = 0;
    var cpc = 0;
    var sum_ctr = 0;
    var sum_cr = 0;
    var sum_cpc = 0;
    var sum_cpl = 0;
    var sum_week_ctr = 0;
    var sum_week_cr = 0;
    var sum_week_cpc = 0;
    var sum_week_cpl = 0;
     var sum_total_ctr = 0;
    var sum_total_cr = 0;
    var sum_total_cpc = 0;
    var sum_total_cpl = 0;
    var col = class_tr.split("_");
    click = click.replace(/\./g, '');
    cost = cost.replace(/\./g, '');
    impress = impress.replace(/\./g, '');
    // console.log(class_table);
    // tính tổng
    var class_hangmuc = class_parent[1];

    var report_total_id = $('.'+class_hangmuc).attr('data-id');
    class_current = class_current.split(' ');
    var sum_thucte = convertToInt($('.report_total .'+class_hangmuc+' .input_thucte').text());
    var sum_week_thucte = convertToInt($('.'+class_table+ ' .sum_week_thucte').text());
    var sum_total_thucte = convertToInt($('.sum_total_'+report_id + ' .input_thucte').text());
    var sum_click = 0;var sum_impress = 0;var sum_cost = 0;
    var sum_week_click = 0;var sum_week_impress = 0;var sum_week_cost = 0;
    var sum_total_click = 0;var sum_total_impress = 0;var sum_total_cost = 0;
    if(class_current[1] == 'input_clicks'){
        $('#report_'+report_id+' .input_clicks').each(function(){
                sum_total_click += convertToInt($(this).val()) << 0;
        });
        $('.'+class_table+' .'+class_current[1]).each(function(){
                sum_week_click += convertToInt($(this).val()) << 0;
        });
        
        $('.'+class_current[0]).each(function(){
            sum_click += convertToInt($(this).val()) << 0;
        });
       $('.report_total .'+class_current[0]+' .money').text(sum_click);
       $('.sum_total_'+report_id + ' .input_clicks .money').text(sum_total_click);
       $('.'+class_table+ ' .sum_week_click').text(sum_week_click);
    }else{
        sum_click = convertToInt($('.report_total .'+class_hangmuc+' .input_clicks').text());
        sum_week_click = convertToInt($('.'+class_table+ ' .sum_week_click').text());
        sum_total_click = convertToInt($('.sum_total_'+report_id + ' .input_clicks .money').text());
    }

    if(class_current[1] == 'input_impress'){
        $('#report_'+report_id+' .input_impress').each(function(){
                sum_total_impress += convertToInt($(this).val()) << 0;
        });
        $('.'+class_table+' .'+class_current[1]).each(function(){
                sum_week_impress += convertToInt($(this).val()) << 0;
        });
        $('.'+class_current[0]).each(function(){
            sum_impress += convertToInt($(this).val()) << 0;
        });
        $('.sum_total_'+report_id + ' .input_impress .money').text(sum_total_impress);
        $('.report_total .'+class_current[0]+' .money').text(sum_impress);
        $('.'+class_table+ ' .sum_week_impress').text(sum_week_impress);
    }else{
        sum_impress = convertToInt($('.report_total .'+class_hangmuc+' .input_impress').text());
        sum_week_impress = convertToInt($('.'+class_table+ ' .sum_week_impress').text());
        sum_total_impress = convertToInt($('.sum_total_'+report_id + ' .input_impress .money').text());
    }
   
    if(sum_click != '0' && sum_impress != '0'){
        sum_ctr = ((sum_click/sum_impress)*100).toFixed(2);
        sum_week_ctr = ((sum_week_click/sum_week_impress)*100).toFixed(2);
        sum_total_ctr = ((sum_total_click/sum_total_impress)*100).toFixed(2);
        $('.report_total .'+class_hangmuc+' .input_ctr').text(sum_ctr+' %');
        $('.'+class_table+ ' .sum_week_ctr').text(sum_week_ctr+' %');
        $('.sum_total_'+report_id + ' .input_ctr').text(sum_total_ctr+' %');
    }

    if(class_current[1] == 'input_cost'){
        $('#report_'+report_id+' .input_cost').each(function(){
                sum_total_cost += convertToInt($(this).val()) << 0;
        });
         $('.'+class_table+' .'+class_current[1]).each(function(){
                sum_week_cost += convertToInt($(this).val()) << 0;
        });
        $('.'+class_current[0]).each(function(){
            sum_cost += convertToInt($(this).val()) << 0;
        });
        $('.sum_total_'+report_id + ' .input_cost .money').text(sum_total_cost);
        $('.'+class_table+ ' .sum_week_cost').text(sum_week_cost);
        $('.report_total .'+class_current[0]+' .money').text(sum_cost);
    }else{
        sum_cost = convertToInt($('.report_total .'+class_hangmuc+' .input_cost').text());
        sum_week_cost = convertToInt($('.'+class_table+ ' .sum_week_cost').text());
        sum_total_cost = convertToInt($('.sum_total_'+report_id + ' .input_cost .money').text());
    }

    sum_cr = ((sum_thucte/sum_click)*100).toFixed(2); 
    sum_cpc = (sum_cost/sum_click).toFixed(0);
    sum_cpl = (sum_cost/sum_thucte).toFixed(0);
    sum_week_cr = ((sum_week_thucte/sum_week_click)*100).toFixed(2); 
    sum_week_cpc = (sum_week_cost/sum_week_click).toFixed(0);
    sum_week_cpl = (sum_week_cost/sum_week_thucte).toFixed(0);
    sum_total_cr = ((sum_total_thucte/sum_total_click)*100).toFixed(2); 
    sum_total_cpc = (sum_total_cost/sum_total_click).toFixed(0);
    sum_total_cpl = (sum_total_cost/sum_total_thucte).toFixed(0);
    
     $('.report_total .'+class_hangmuc+' .input_cr').text(sum_cr+' %');
    $('.report_total .'+class_hangmuc+' .input_cpc .money').text(sum_cpc);
    $('.report_total .'+class_hangmuc+' .input_cpl').text(sum_cpl);
    $('.'+class_table+ ' .sum_week_cr').text(sum_week_cr+' %');
    $('.'+class_table+ ' .sum_week_cpc').text(sum_week_cpc);
    $('.'+class_table+ ' .sum_week_cpl').text(sum_week_cpl);
    $('.sum_total_'+report_id + ' .input_cr').text(sum_total_cr);
    $('.sum_total_'+report_id + ' .input_cpc').text(sum_total_cpc);
    $('.sum_total_'+report_id + ' .input_cpl').text(sum_total_cpl);
    // end tinh tong

    
    if(click != '0' && impress != '0'){
        ctr = ((click/impress)*100).toFixed(2);
        $('.'+class_tr+' .input_ctr').text(ctr+' %');
    }
    if(click != '0'){
        cr = ((thucte/click)*100).toFixed(2);
         $('.'+class_tr+' .input_cr').text(cr+' %');
         cpc = (cost/click).toFixed(0);
        $('.'+class_tr+' .input_cpc').text(cpc);
    }

    if(cost != '0'){
        cpl = (cost/thucte).toFixed(0);
        $('.'+class_tr+' .input_cpl').text(cpl);
    }
    $('.money').mask('000.000.000.000.000', {reverse: true});
    $(document).find('.money').each(function () {
        var number = Number($(this).text().split('.').join("").split(',').join(""));
       $(this).text(Math.ceil(number).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
    });

    $.ajax({
        type: "POST",
        url: 'https://data.ngoisaomoi.vn/UpdateDetailWeek',
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
             id: id, 
             click: click,
             impress: impress,
             thucte: thucte,
             cost : cost,
             ctr : ctr,
             cr : cr,
             cpc: cpc,
             col: col[0],
             hangmuc:hangmuc,
             cpl:cpl,
             sum_click : sum_click,
             sum_impress : sum_impress,
             sum_cost : sum_cost,
             sum_ctr : sum_ctr,
             sum_cr : sum_cr,
             sum_cpc : sum_cpc,
             sum_cpl : sum_cpl,
             sum_week_click : sum_week_click,
             sum_week_impress : sum_week_impress,
             sum_week_cost : sum_week_cost,
             sum_week_ctr : sum_week_ctr,
             sum_week_cr : sum_week_cr,
             sum_week_cpc : sum_week_cpc,
             sum_week_cpl : sum_week_cpl,
             sum_total_click : sum_total_click,
             sum_total_impress : sum_total_impress,
             sum_total_cost : sum_total_cost,
             sum_total_ctr : sum_total_ctr,
             sum_total_cr : sum_total_cr,
             sum_total_cpc : sum_total_cpc,
             sum_total_cpl : sum_total_cpl,
             report_total_id : report_total_id,
             report_id : report_id

        },
        success: function( data ) {
            console.log(data);
        }
    });
});




