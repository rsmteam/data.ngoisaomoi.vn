@extends('backend.master')
@section('title')
    <h1 class="page-header">Danh sách nhân viên</h1>
@stop
@section('content')
<!-- /.row -->

<aside class="right-side">
            <!-- Content Header (Page header) -->
            
            <!-- Main content -->
            <section class="content">

                <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Danh sách user
            </div>
            <!-- /.panel-heading -->
            <table border="1" style="width: 100%;padding: 5px;">
                <tr>
                    <th>STT</th>
                    <th>username</th>
                    <th>Email</th>
                    <th>Quyền</th>
                    <th>Thời gian tiếp nhận</th>
                    <th>Hành động</th>
                </tr>
                <?php $count = 1; ?>
                 <?php foreach($data as $item ){ ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $item->name; ?> </td>
                    <td><?php echo $item->email; ?> </td>
                    <td><?php echo $item->loai; ?> </td>
                    <td><?php echo $item->dateJoin; ?> </td>
                    <td><a <?php echo ($item ->loai == Auth::user()->loai or $item ->loai == 'Supper Admin' ) ? 'style =  "pointer-events: none;background-color:#43484c"' : ''; ?> href="{!! URL::route('getFormChangeRole', $item->id ) !!}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Chỉnh sửa"><i class="fa fa-pencil fa-fw"></i></a></td>
                </tr>
                    <?php } ?>
            </table>
            <?php 
                // echo "<pre>";
                // var_dump($result);

            ?>
            <!-- So do so luong san pham hang thang -->
            
        </div>

              
            </section><!-- /.content -->
        </aside><!-- /.right-side -->



@stop
