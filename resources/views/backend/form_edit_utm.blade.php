@extends('backend.master')

@section('content')
 <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Chỉnh sửa Source UTM</h2>
        <ol class="breadcrumb">
          <li class="active">Chỉnh sửa Source UTM</li>
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
            <form class="form-horizontal" role="form" method="POST" action="{!! URL::route('postFormChangeUTM', $utm_name) !!}">
                        {!! csrf_field() !!}
                <div class="col-md-6">
                <div class="aa-myaccount-login">
                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">

                                <label class="col-md-4 control-label">Source UTM</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="source_utm" value="<?php echo $utm_name; ?>" >

                                   
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
