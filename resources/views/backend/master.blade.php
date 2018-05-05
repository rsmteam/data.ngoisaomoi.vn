<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data ngôi sao mới</title>
    <link rel="SHORTCUT ICON" href="{{ url('public/favicon.ico') }}">

    <!-- Bootstrap Core CSS -->
    <link href="{{ url('public/backend/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="{{ url('public/backend/bootstrap/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{ url('public/backend/bootstrap/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="{{ url('public/backend/bootstrap/css/morris/morris.css') }}" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="{{ url('public/backend/bootstrap/css/jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
    <!-- fullCalendar -->
    <link href="{{ url('public/backend/bootstrap/css/fullcalendar/fullcalendar.css') }}" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="{{ url('public/backend/bootstrap/css/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="{{ url('public/backend/bootstrap/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Theme style -->
    <link href="{{ url('public/backend/bootstrap/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/backend/bootstrap/css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ url('public/backend/css/jquery-ui.css') }}">

<link href="{{ url('public/backend/css/bootstrap-multiselect.css') }}" rel="stylesheet"/>
<link href="{{ url('public/backend/css/style.css') }}" rel="stylesheet" type="text/css" />
    

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script src="{{ url('public/backend/js/ckeditor/ckeditor.js') }}"></script>
    <style type="text/css">
        
    </style>

</head>

<body class = "skin-black  pace-done">
    <header class="header">
        
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <!-- Notifications: style can be found in dropdown.less -->
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-user"></i>
                            <span>{!! Auth::user()->name !!} <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{!! URL::route('getEditUser', Auth::id() ) !!}" class="btn btn-default btn-flat">Chỉnh sửa tài khoản</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{!! url('getLogOut') !!}" class="btn btn-default btn-flat">Đăng xuất</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left info">
                        <p>Xin chào, {!! Auth::user()->name !!}</p>

                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <li>
                        <a href="{!! URL('admin/home')!!}">
                            <i class="fa fa-dashboard"></i> <span>Danh sách data</span>
                        </a>
                    </li>
                   
                    @php $user_loai = Auth::user()->roleId; @endphp
                    @if($user_loai == App\User::ADMIN or $user_loai == App\User::SUPPER_ADMIN)
                    <li>
                        <a href="{!! URL('getReport')!!}">
                            <i class="fa fa-dashboard"></i> <span>Báo cáo</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-bar-chart-o"></i>
                            <span>Quản lý nhân viên</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{!! URL('admin/getListUser')!!}"><i class="fa fa-angle-double-right"></i> Danh sách nhân viên</a></li>
                            <li><a href="{!! URL('admin/get-create-user')!!}"><i class="fa fa-angle-double-right"></i> Thêm Nhân viên</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="{!! URL('admin/getUtmSource')!!}">
                            <i class="fa fa-dashboard"></i> <span>Danh sách source UTM</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! URL('listWebsite')!!}">
                            <i class="fa fa-dashboard"></i> <span>Danh sách dự án</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://api.ngoisaomoi.vn/platform.php" target="_blank">
                            <i class="fa fa-dashboard"></i> <span>Subscribed page to App</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://developers.facebook.com/tools/lead-ads-testing" target="_blank">
                            <i class="fa fa-dashboard"></i> <span>lead ads testing</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        @yield('content')
        @yield('formInsert')
    </div><!-- ./wrapper -->

    <!-- jQuery 2.0.2 -->
        <script src="{{ url('public/backend/js/jquery.min.js') }}"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="{{ url('public/backend/bootstrap/js/jquery-ui-1.10.3.min.js') }}" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="{{ url('public/backend/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        
        <!-- Sparkline -->
        <script src="{{ url('public/backend/bootstrap/js/plugins/sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="{{ url('public/backend/bootstrap/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('public/backend/bootstrap/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="{{ url('public/backend/bootstrap/js/plugins/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ url('public/backend/bootstrap/js/plugins/jqueryKnob/jquery.knob.js') }}" type="text/javascript"></script>
        <!-- daterangepicker -->
       <script type="text/javascript" src="{{ url('public/backend/js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ url('public/backend/js/daterangepicker.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ url('public/backend/css/daterangepicker.css') }}" />
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{ url('public/backend/bootstrap/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="{{ url('public/backend/bootstrap/js/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="{{ url('public/backend/bootstrap/js/AdminLTE/app.js') }}" type="text/javascript"></script>
        <script src="{{ url('public/backend/bootstrap/js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
        <script src="{{ url('public/backend/bootstrap/js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>
        <script src="{{ url('public/backend/js/jquery-ui.js') }}"></script>
        <script src="{{ url('public/backend/js/bootstrap-multiselect.js') }}"></script>
        <script src="{{ url('public/backend/js/jquery.mask.js') }}"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
          


   
    <!-- My JavaScript -->
    <script src="{{ url('public/backend/js/myscript.js') }}"></script>


    <script type="text/javascript">
        function randomPassword(length) {
            var chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
            var pass = "";
            for (var x = 0; x < length; x++) {
                var i = Math.floor(Math.random() * chars.length);
                pass += chars.charAt(i);
            }
            return pass;
        }

        function generate() {
            myform.password.value = randomPassword(myform.length.value);
            // alert('bao');
        }

          
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
              @if(count($errors) != 0)
                $('#insertData').modal('show');
              @endif
            $("#dataTables-example").dataTable();
            $('#select_utm').multiselect({
                maxHeight: 200,
                buttonWidth: '200px',
                nonSelectedText: 'Hãy chọn UTM',
                includeSelectAllOption: true,
                selectAllValue: '--UTM--',
                selectAllText: 'Chọn tất cả',
                enableFiltering: true,
                filterBehavior: 'text',
                // buttonClass: 'pull-right'
            });

            $('#select_website').multiselect({
                maxHeight: 400,
                buttonWidth: '200px',
                nonSelectedText: 'Hãy chọn website',
                includeSelectAllOption: true,
                selectAllValue: '--Website--',
                selectAllText: 'Chọn tất cả',
                enableFiltering: true,
                filterBehavior: 'text',
            });
            $('.select_link_website').multiselect({
                maxHeight: 350,
                buttonWidth: '100%',
                nonSelectedText: 'Chọn dự án quản lý',
                enableFiltering: true,
                filterBehavior: 'text'
                // buttonClass: 'pull-right'
            });
            

            $('#select_column').multiselect({
                maxHeight: 200,
                buttonWidth: '200px',
                nonSelectedText: 'Hãy chọn cột hiển thị',
                includeSelectAllOption: true,
                selectAllValue: 'all',
                selectAllText: 'Chọn tất cả',
                enableFiltering: true,
                filterBehavior: 'text',
                allSelectedText:'Chọn cột hiển thị',
            });

        });

        

        $(function() {
            var start = moment().startOf('month');
            var end = moment();  

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
           
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                   'Today': [moment(), moment()],
                   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                   'This Month': [moment().startOf('month'), moment().endOf('month')],
                   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                }
            }, cb);
            cb(start, end);

            var date_val = $('#reportrange span').html();
            if(typeof date_val !== "undefined"){
                date_val = date_val.split('-');
                startDate = new Date (date_val[0]);
                startDate = startDate.getFullYear()  + '-' + (startDate.getMonth()+1) + '-' + startDate.getDate();
                endDate = new Date (date_val[1]);
                endDate = endDate.getFullYear()  + '-' + (endDate.getMonth()+1) + '-' + endDate.getDate();
                var href_export = "{!! URL::route('admin.invoices.excel',['startDay'=>'startDay','endDay'=>'endDate','utm' => '--UTM--','website' => 'null']) !!}";
                href_export = href_export.replace('startDay', startDate);
                href_export = href_export.replace('endDate', endDate+ ' 23:59:59');
                $('.export-excel').attr("href", href_export);
            }
            
        });

        $(function() {
            $('input[name="register_time"]').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                timePickerIncrement: 1,
                locale: {
                    format: 'YYYY/MM/DD h:mm:ss'
                }
            });
        });

        $(function() {
            $('.reportrange').daterangepicker({
              autoUpdateInput: false,
              locale: {
                  cancelLabel: 'Clear'
              }
          });

          $('.reportrange').on('apply.daterangepicker', function(ev, picker) {
              $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
          });

          $('.reportrange').on('cancel.daterangepicker', function(ev, picker) {
              $(this).val('');
          });
        });

        $( function() {
            $( "#accordion" ).accordion({
              collapsible: true
            });
        });

        function AjaxLoadData(item){

            $.ajax({
                type: "GET",
                url: '/search_date',
                data: {
                    "_token": "{{ csrf_token() }}",
                     starDay: item.starDay, 
                     endDay: item.endDay,
                     utm: item.utm,
                     website: item.website
                },
                success: function( data ) {
                    console.log(data);
                    $("#ajax_html").html(data);
                    $('#dataTables-example').DataTable( {
                        responsive: true
                    } );
                    var count_data = $(".count_data").val();
                    var count_link = $(".count_link").val();
                    var html_total_data = $("#total_data_model_ajax").html();
                    var new_href = $('.export-excel-ajax').attr('href');
                    var html_select_utm = $('#select_utm_ajax').html();
                    var html_select_website = $('#select_website_ajax').html();
                    var count_option = $('#select_utm_ajax option').size();
                    var count_option_select_website = $('#select_website_ajax option').size();
                    if(count_option > 1){
                        $('#select_utm').html(html_select_utm);
                        $('#select_utm').multiselect ('rebuild');
                    }

                    if(count_option_select_website > 1){
                        $('#select_website').html(html_select_website);
                        $('#select_website').multiselect ('rebuild');
                    }
                    
                    
                    $(".export-excel").attr("href", new_href);
                    $(".inner_data .total_data").html(count_data);
                    $(".inner_link .total_link").html(count_link);
                    $("#total_data_model").html(html_total_data);
                }
            });
        }

        // Xóa hàng loạt
        $('.checkbox_all').click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        $('.btn_delete_data').click(function(){
            var values = $('input:checkbox:checked.checkbox_item').map(function () {
                return this.value;
            }).get();
            if(values == ""){
                alert('Bạn chưa chọn data để xóa');
            }else{
                 if (confirm("Bạn có chắc muốn xóa dữ liệu này không ???")) {
                    $.ajax({
                        type: "POST",
                        url: 'https://data.ngoisaomoi.vn/getDeleteData',
                        data: {
                            "_token": "{{ csrf_token() }}",
                             id: values, 
                        },
                        success: function( data ) {
                            // console.log(data);
                            location.reload();
                        }
                    });
                }
                return false;
            }
        });


</script>
