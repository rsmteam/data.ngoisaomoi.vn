@extends('backend.master')

@section('content')
 <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Chỉnh sửa thông tin</h2>
        <ol class="breadcrumb">
          <li class="active">Chỉnh sửa thông tin</li>
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
            <form class="form-horizontal" role="form" method="POST" action="{!! URL::route('postEditUser', $users[0]->id ) !!}">
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
                                    <input type="email" class="form-control" name="email" value="<?php echo $users[0]->email; ?>" >

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Mật khẩu</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="aa-browse-btn">
                            <i class="fa fa-btn fa-user"></i>Cập nhật
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
