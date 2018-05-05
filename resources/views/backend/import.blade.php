
<!-- Modal -->
  <div id="insertData" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Thêm mới data</h4>
        </div>
        <div class="modal-body">
          <div class="row">
              <form name="myform" class="form-horizontal" role="form" method="POST" action="{!! route('insertData') !!}" >
                  {!! csrf_field() !!}
                  <div class="col-md-5">
                      <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}" style="margin-bottom: 20px">
                          <input type="text" class="form-control" name="name" placeholder="Name(*)" value="{{ old('name') }}">
                          <span  class="help-block">{{ $errors->first('name') }}</span>
                      </div>  
                      <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}" style="margin-bottom: 20px">
                          <input type="number" class="form-control" name="phone" placeholder="Phone(*)" value="{{ old('phone') }}">
                          <span  class="help-block">{{ $errors->first('phone') }}</span>
                      </div>
                      <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}" style="margin-bottom: 20px">
                          <input type="text" class="form-control" name="email" placeholder="Email(*)" value="{{ old('email') }}">
                          <span  class="help-block">{{ $errors->first('email') }}</span>
                      </div>
                      <div class="form-group" style="margin-bottom: 20px">
                          <textarea name="comment" class="form-control" placeholder="Comment" value="{{ old('comment') }}"></textarea>
                      </div>   
                      <div class="form-group {{ $errors->has('register_time') ? 'has-error' : '' }}" style="margin-bottom: 20px">
                          <input type="text" class="form-control" name="register_time" placeholder="Thời gian(*)" value="{{ old('register_time') }}">
                          <span  class="help-block">{{ $errors->first('register_time') }}</span>
                      </div>                       
                      
                  </div>
                  <div class="col-md-5" style="float: right">
                       
                      <div class="form-group {{ $errors->has('link') ? 'has-error' : '' }}" style="margin-bottom: 20px">
                          <!-- <input type="text" class="form-control" name="link" placeholder="website(*)" value="{{ old('link') }}"> -->
                          <select name="link" class="form-control">
                              <option value="--Website--">--Website--</option>
                              @foreach($link as $item)
                              @if($item->link_website != '')
                              <option {{ (old('link') == $item->link_website) ? 'selected' : '' }}>{{ $item->link_website }}</option>
                              @endif
                              @endforeach
                          </select>
                          <span  class="help-block">{{ $errors->first('link') }}</span>
                      </div>
                      <div class="form-group" style="margin-bottom: 20px">
                          <input type="text" class="form-control" name="source_cookie" placeholder="Source Cookie" value="{{ old('source_cookie') }}">
                      </div>
                      <div class="form-group" style="margin-bottom: 20px">
                          <input type="text" class="form-control" name="utm_source" placeholder="Utm Source" value="{{ old('utm_source') }}">
                      </div>
                      <div class="form-group" style="margin-bottom: 20px">
                          <input type="text" class="form-control" name="utm_medium" placeholder="Utm Medium" value="{{ old('utm_medium') }}">
                      </div>
                      <div class="form-group" style="margin-bottom: 20px">
                          <input type="text" class="form-control" name="utm_campaign" placeholder="Utm Campaign" value="{{ old('utm_campaign') }}">
                      </div>
                      
                  </div>
                  <div class="form-group">
                      <div class="col-md-6 col-md-offset-5" style="">
                          <button type="submit" class="btn btn-primary">
                              Thêm mới
                          </button>
                      </div>
                  </div>
              </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
  </div>


