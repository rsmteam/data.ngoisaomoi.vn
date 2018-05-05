<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>


    <!-- Bootstrap Core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ url('public/backend/bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ url('public/backend/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ url('public/backend/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ url('public/backend/bower_components/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script src="{{ url('public/backend/js/ckeditor/ckeditor.js') }}"></script>
    <style type="text/css">
        td,th{
            padding:5px;
            min-width: 150px;
            word-break: break-all;
        }
        .table_stt{
            min-width: 45px;
        }
        .navbar-top-links li a{
            float: left;
        }
        .panel-body{
            overflow:overlay;
        }
    </style>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right"  >
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown">
                        <i class="fa fa-user fa-fw"></i>Xin chào <span style="color:blue">{!! Auth::user()->name !!}</span> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="{!! URL::route('getEditUser', Auth::id() ) !!}">Chỉnh sửa tài khoản</a></li>
                    </ul>
                </li>
                <li>
                 <a href="{!! url('getLogOut') !!}">Đăng xuất</a>
                 </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="{!! URL('admin/home')!!}"><i class="glyphicon glyphicon-tasks"></i> Danh sách data<span class="fa arrow"></span></a>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php 
                            $user_loai = Auth::user()->loai;
                            if($user_loai == 'admin'){ ?>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-tasks"></i> Quản lý nhân viên<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! URL('admin/getListUser')!!}"><i class="glyphicon glyphicon-tasks"></i>Danh sách nhân viên<span class="fa arrow"></span></a>
                                    <!-- /.nav-second-level -->
                                </li>
                                <li>
                                    <a href="{!! URL('admin/get-create-user')!!}"><i class="glyphicon glyphicon-tasks"></i>Thêm Nhân viên<span class="fa arrow"></span></a>
                                    
                                </li>
                                
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php } ?>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        @yield('title')
                    </div>

                    <div class="col-lg-12">
                       <!--  @if (Session::has('flash_message'))
                            <div class="alert alert-{!! Session::get('flash_level') !!}">
                                {!! Session::get('flash_message') !!}
                            </div>
                        @endif   -->
                        @yield('content')
                    </div>

                    

                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{ url('public/backend/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ url('public/backend/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ url('public/backend/bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

    <!-- Chart js -->
    <script src="{{ url('public/backend/bower_components/Chart.js-1.1.1/Chart.min.js') }}"></script>
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.1.1/Chart.min.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="{{ url('public/backend/dist/js/sb-admin-2.js') }}"></script>

    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
       <!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

    
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
        $(function() {
            
            
            var start = moment().subtract(29, 'days');
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
                   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);
            cb(start, end);

            
        });

        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
            // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            // var result = host.split('/');
             var starDay = picker.startDate.format('YYYY-MM-DD');
             var endDay = picker.endDate.format('YYYY-MM-DD');
             // $('.key_form').val(CSRF_TOKEN);
             // $('.startDate').val(starDay);
             // $('.endDay').val(endDay);
             // $('.btn_form_date').click();
             $.ajax({
                type: "POST",
                url: 'http://data.ngoisaomoi.vn/search_date',
                data: {
                    "_token": "{{ csrf_token() }}",
                     starDay: starDay, 
                     endDay: endDay
                },
                success: function( data ) {
                    // console.log(data);
                    $("#ajax_html").html(data);
                    $('#dataTables-example').DataTable( {
                        responsive: true
                    } );
                    var count_data = $(".count_data").val();
                    var new_href = $('.export-excel-ajax').attr('href');
                    $(".export-excel").attr("href", new_href);
                    $(".huge_data").html(count_data);
                }
            });
        });

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
                        url: 'http://data.ngoisaomoi.vn/getDeleteData',
                        data: {
                            "_token": "{{ csrf_token() }}",
                             values: values, 
                        },
                        success: function( data ) {
                            location.reload();
                        }
                    });
                }
                return false;
            }
        })
        </script>
</body>

</html>
