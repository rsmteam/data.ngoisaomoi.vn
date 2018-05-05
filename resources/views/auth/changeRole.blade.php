@extends('backend.master')

@section('content')
 <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Phân quyền nhân viên</h2>
        <ol class="breadcrumb">
          <li class="active">Phân quyền nhân viên</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  </section>
  <!-- / product category -->
 <!-- Cart view section -->
 <section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
            <form class="form-horizontal" role="form" method="POST" action="{!! URL::route('admin.postChangeRole', $users[0]->id ) !!}">
                        {!! csrf_field() !!}
                <div class="col-md-6">
                <p style="text-align: center;color:red"><?php echo (isset($message) ? $message  : ''); ?></p>
                <div class="aa-myaccount-login">
                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">

                                <label class="col-md-4 control-label">Tài khoản</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="<?php echo $users[0]->name; ?>" disabled="true">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">E-Mail</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="<?php echo $users[0]->email; ?>" disabled="true">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                             <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Phân quyền</label>
                                <div class="col-md-6">
                                    @php $link_website = App\NhanVien::getLinkWebsite() @endphp
                                    <select class="select_link_website" multiple="multiple" name="phan_quyen[]">
                                        <option value="Supper Admin" {{ (strpos($users[0]->loai,'Supper Admin') !== false) ? 'selected' : ' ' }}>Supper Admin</option>
                                        <option  value="admin" {{ (strpos($users[0]->loai,'admin') !== false) ? 'selected' : ' ' }}>Admin</option>
                                        @foreach($link_website as $items )
                                          @if($items->link_website != '')
                                            <option {{ (strpos($users[0]->loai,$items->link_website) !== false) ? 'selected' : ' ' }} >{{ $items->link_website }}</option>
                                          @endif
                                        @endforeach

                                    </select>
                                   
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Thời gian</label>
                                <div class="col-md-6">
                                    <input type="text"  id = "date_DateJoin" class="form-control" value="<?php echo $users[0]->dateJoin; ?>" name="dateJoin">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="aa-browse-btn">
                            <i class="fa fa-btn fa-user"></i>Chỉnh sửa
                        </button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
   </div>
 </section>
 <!-- / Cart view section -->
@endsection
