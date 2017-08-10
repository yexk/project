@extends('back.layouts.default')

@section('title')
聊天室
@stop

@section('content')
<div class="col-sm-3">
  <section class="panel">
    <header class="panel-heading">
      <div class="input-group text-sm">
        <input class="input-sm form-control" placeholder="Search" type="text">
        <div class="input-group-btn">
          <button type="button" class="btn btn-sm btn-white dropdown-toggle" data-toggle="dropdown">
            Action 
            <span class="caret">
            </span>
          </button>
          <ul class="dropdown-menu pull-right">
            <li>
              <a href="#">
                Action
              </a>
            </li>
            <li>
              <a href="#">
                Another action
              </a>
            </li>
            <li>
              <a href="#">
                Something else here
              </a>
            </li>
            <li class="divider">
            </li>
            <li>
              <a href="#">
                Separated link
              </a>
            </li>
          </ul>
        </div>
      </div>
    </header>
    <ul id="user_lists" class="list-group alt">
        <!-- ajax -->
    </ul>
  </section>
</div>
<!-- START CHATS -->
<div class="col-lg-6">
  <section class="panel">
    <header class="panel-heading">
      chat
      <span class="tools pull-right">
        <a href="javascript:;" class="fa fa-chevron-down">
        </a>
      </span>
    </header>
    <div class="panel-body profile-activity">
      <div id="chat_content" style="overflow: auto;height: 600px">
        @if (count($chat) > 0)
          @foreach ($chat as $v)
          <?php $v = json_decode($v,true); ?>
          <div class="activity terques {{ ($v['userid'] == session('YEXK_USERINFO_ID')) ? 'alt' : '' }}">
            <span>
              <i class="fa">{{ $v['username'] }}</i>
            </span>
            <div class="activity-desk">
              <div class="panel">
                <div class="panel-body">
                  <div class="arrow{{ ($v['userid'] == session('YEXK_USERINFO_ID')) ? '-alt' : '' }}"></div>
                  <p>{{ $v['content'] }}</p>
                </div>
              </div>
            </div>
          </div>
        @endforeach
          <div class="text-center">以上是历史记录</div>
      @endif
      </div>
      <div class="chat-form">
      <div class="input-cont ">
        <textarea id="chats_message" class="form-control col-lg-12" placeholder="Type a message here..."></textarea>
      </div>
      <div class="form-group">
        <div class="pull-right chat-features">
          <a id="chats_send" class="btn btn-info btn-lg" href="javascript:;"> Send </a>
        </div>
      </div>
    </div>
    </div>
  </section>
</div>
<!-- END CHATS -->
@stop

@section('scripts')
<script>
ws = new WebSocket("ws://192.168.10.18:11104");
ws.onopen = function() {
  ws.send('{"id":"{{ $id }}" }');
};
ws.onclose = function() {
  ws.send('{"id":"{{ $id }}" }');
};
ws.onmessage = function(e) {
  var data = JSON.parse(e.data);
  if (1 == data.login) {
    update_userlist();
    return false;
  }else if(0 == data.login){
    update_userlist();
    return false;
  }
  var id = {{ session('YEXK_USERINFO_ID') ? session('YEXK_USERINFO_ID') : '0' }};
  var alt = '';
  var arrow_alt = 'arrow';
  if (id == data.userid) {
    alt = 'alt';
    arrow_alt = 'arrow-alt';
  }
  var _html = '<div class="activity '+alt+' green">\
      <span>\
        <i class="fa">'+data.username+'</i>\
      </span>\
      <div class="activity-desk">\
        <div class="panel">\
          <div class="panel-body">\
            <div class="'+arrow_alt+'">\
            </div>\
            <p style="font-size:14px">'+data.content+'</p>\
            <!--<p style="border-top: 1px dotted #ccc;font-size:10px"><i class=""></i>'+data.date+'</p>-->\
          </div>\
        </div>\
      </div>\
    </div>';
    $('#chat_content').append(_html).scrollTop( $('#chat_content')[0].scrollHeight );
};

$(function(){
  // 自动滚动到底部
  $('#chat_content').scrollTop( $('#chat_content')[0].scrollHeight );

  $('#chats_send').on('click', function(event) {
    event.preventDefault();
    var content = $('#chats_message').val();
    if ('' == content) {
      return false;
    }
    var send_content = {};
    send_content.content = content;
    send_content.username = '{{ session('YEXK_USERINFO') ? ucfirst(substr(json_decode(session('YEXK_USERINFO'))->name,0,3)) : '' }}';
    send_content.userid = {{ session('YEXK_USERINFO_ID') ? session('YEXK_USERINFO_ID') : '0' }};
    $('#chats_message').val('');
    ws.send(JSON.stringify(send_content));
  });

  /**
   * 组合键监听（Ctrl+enter 和 alt + s）
   * metaKey   是 windows键 或者 Command 键
   * @Author   Yexk       <yexk@yexk.cn>
   * @DateTime 2017-08-10
   * @param    {[type]}      [description]
   * @return   {[type]}      [description]
   */
  $(document).keydown(function(e){ 
    var e = e || window.event;
    var ctrlKey = e.ctrlKey || e.metaKey;
    var altKey = e.altKey || e.metaKey;
    var code = e.keyCode || e.which || e.charCode;  
    if(altKey && code == 83 || ctrlKey && code == 13) {    
      $("#chats_send").trigger('click'); 
      return false;
    } 
  }); 

  update_userlist();
});

/**
 * 更新在线用户
 * @Author   Yexk       <yexk@yexk.cn>
 * @DateTime 2017-08-10
 * @return   {[type]}   [description]
 */
function update_userlist() {
  $.ajax({
    url: '{{ route("chat.chats") }}',
    type: 'get',
    dataType: 'json',
    data: {"user": "1"},
    success:function(data) {
      var _html = '';
      for (var i = 0; i < data.length; i++) {
        _html += '<li class="list-group-item">\
              <div class="media">\
                <span class="pull-left thumb-sm">\
                  <img src="img/chat-avatar2.jpg" alt="John said" class="img-circle">\
                </span>\
                <div class="pull-right text-success m-t-sm">\
                  <i class="fa fa-circle"></i>\
                </div>\
                <div class="media-body">\
                  <div>\
                    <a href="javascript:;">\
                      '+data[i].name+'\
                    </a>\
                  </div>\
                  <small class="text-muted">\
                    '+data[i].last_login_ip+'\
                  </small>\
                </div>\
              </div>\
            </li>';
      }
      $('#user_lists').html(_html);
    }
  })
}



</script>
@stop
