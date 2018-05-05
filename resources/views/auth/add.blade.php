@extends('backend.master')

@section('content')
 <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Thêm mới nhân viên</h2>
        <ol class="breadcrumb">
          <li class="active">Thêm mới nhân viên</li>
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
            <form name="myform" class="form-horizontal" role="form" method="POST" action="{!! route('post-create-user') !!}">
                        {!! csrf_field() !!}
                 <input type="hidden" name="length" value="10">
                <div class="col-md-6">
                <p style="text-align: center;color:red"><?php echo (isset($message) ? $message  : ''); ?></p>
                <div class="aa-myaccount-login">
                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">

                                <label class="col-md-4 control-label">Tài khoản</label>

                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="name" value="">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">E-Mail</label>

                                <div class="col-md-5">
                                    <input type="email" class="form-control" name="email" value="">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Mật khẩu</label>

                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="password"> 
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <input type="button" class="generate_pass" value="Random password" onClick="generate();" />
                            </div>
                             <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Phân quyền</label>

                                <div class="col-md-5">
                                    @php $link_website = App\NhanVien::getLinkWebsite() @endphp
                                    <select class="select_link_website" multiple="multiple" name="phan_quyen[]">
                                        <option value="Supper Admin" >Supper Admin</option>
                                        <option  value="admin" >Admin</option>
                                        @foreach($link_website as $items )
                                          @if($items->link_website != '')
                                            <option >{{ $items->link_website }}</option>
                                          @endif
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Thời gian</label>
                                <div class="col-md-5">
                                    <input type="text"  id = "date_DateJoin" class="form-control" value="" name="dateJoin">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4" style="margin-left: 21.333333%;">
                        <button type="submit" class="aa-browse-btn">
                            <i class="fa fa-btn fa-user"></i>Thêm mới
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
