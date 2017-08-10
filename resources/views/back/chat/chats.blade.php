@extends('back.layouts.default')

@section('title')
聊天室
@stop

@section('links')
  <link href="assets/jquery-emoji/lib/css/jquery.mCustomScrollbar.min.css" rel="stylesheet"><!-- FONT AWESOME ICON CSS -->
  <link href="assets/jquery-emoji/css/jquery.emoji.css" rel="stylesheet"><!-- FONT AWESOME ICON CSS -->
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
                  <p class="emoji_parse"><?php echo $v['content']; ?></p>
                  <p style="border-top: 1px dotted #ccc;font-size:10px">{{ $v['date'] }}</p>
                </div>
              </div>
            </div>
          </div>
        @endforeach
          <div class="text-center">以上是历史记录</div>
      @endif
      </div>
      <div class="chat-form">
      <div class="col-lg-12" style="padding-bottom: 10px">
        <button id="emoji_btn" class="btn"><i class="fa fa-smile-o"></i></button>
      </div>

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
<script src="assets/jquery-emoji/lib/script/jquery.mousewheel-3.0.6.min.js"></script>
<script src="assets/jquery-emoji/lib/script/jquery.mCustomScrollbar.min.js"></script>
<script src="assets/jquery-emoji/js/jquery.emoji.min.js"></script>
<script>
ws = new WebSocket("ws://192.168.0.120:11104");
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
            <p class="emoji_parse" style="font-size:14px">'+data.content+'</p>\
            <!--<p style="border-top: 1px dotted #ccc;font-size:10px"><i class=""></i>'+data.date+'</p>-->\
          </div>\
        </div>\
      </div>\
    </div>';
    $('#chat_content').append(_html).scrollTop( $('#chat_content')[0].scrollHeight );
    emoji_parse();
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


  /**
   * 表情包添加
   * @type {Boolean}
   */
  $("#chats_message").emoji({
      showTab: true,
      button:'#emoji_btn',
      animation: 'fade',
      icons: [{
          name: "贴吧表情",
          path: "assets/jquery-emoji/img/tieba/",
          maxNum: 50,
          file: ".jpg",
          placeholder: ":{alias}:",
          alias: {
              1: "hehe",
              2: "haha",
              3: "tushe",
              4: "a",
              5: "ku",
              6: "lu",
              7: "kaixin",
              8: "han",
              9: "lei",
              10: "heixian",
              11: "bishi",
              12: "bugaoxing",
              13: "zhenbang",
              14: "qian",
              15: "yiwen",
              16: "yinxian",
              17: "tu",
              18: "yi",
              19: "weiqu",
              20: "huaxin",
              21: "hu",
              22: "xiaonian",
              23: "neng",
              24: "taikaixin",
              25: "huaji",
              26: "mianqiang",
              27: "kuanghan",
              28: "guai",
              29: "shuijiao",
              30: "jinku",
              31: "shengqi",
              32: "jinya",
              33: "pen",
              34: "aixin",
              35: "xinsui",
              36: "meigui",
              37: "liwu",
              38: "caihong",
              39: "xxyl",
              40: "taiyang",
              41: "qianbi",
              42: "dnegpao",
              43: "chabei",
              44: "dangao",
              45: "yinyue",
              46: "haha2",
              47: "shenli",
              48: "damuzhi",
              49: "ruo",
              50: "OK"
          },
          title: {
              1: "呵呵",
              2: "哈哈",
              3: "吐舌",
              4: "啊",
              5: "酷",
              6: "怒",
              7: "开心",
              8: "汗",
              9: "泪",
              10: "黑线",
              11: "鄙视",
              12: "不高兴",
              13: "真棒",
              14: "钱",
              15: "疑问",
              16: "阴脸",
              17: "吐",
              18: "咦",
              19: "委屈",
              20: "花心",
              21: "呼~",
              22: "笑脸",
              23: "冷",
              24: "太开心",
              25: "滑稽",
              26: "勉强",
              27: "狂汗",
              28: "乖",
              29: "睡觉",
              30: "惊哭",
              31: "生气",
              32: "惊讶",
              33: "喷",
              34: "爱心",
              35: "心碎",
              36: "玫瑰",
              37: "礼物",
              38: "彩虹",
              39: "星星月亮",
              40: "太阳",
              41: "钱币",
              42: "灯泡",
              43: "茶杯",
              44: "蛋糕",
              45: "音乐",
              46: "haha",
              47: "胜利",
              48: "大拇指",
              49: "弱",
              50: "OK"
          }
      }, {
          path: "assets/jquery-emoji/img/qq/",
          maxNum: 91,
          excludeNums: [41, 45, 54],
          file: ".gif",
          placeholder: "#qq_{alias}#"
      }]
  });

  emoji_parse();
  update_userlist();
});

/**
 * emoji parse
 * @Author Yexk       <yexk@yexk.cn>
 * @Date   2017-08-11
 * @return {[type]}   [description]
 */
function emoji_parse()
{ 
  $(".emoji_parse").emojiParse({
    icons: [{
        path: "assets/jquery-emoji/img/tieba/",
        file: ".jpg",
        placeholder: ":{alias}:",
        alias: {
            1: "hehe",
            2: "haha",
            3: "tushe",
            4: "a",
            5: "ku",
            6: "lu",
            7: "kaixin",
            8: "han",
            9: "lei",
            10: "heixian",
            11: "bishi",
            12: "bugaoxing",
            13: "zhenbang",
            14: "qian",
            15: "yiwen",
            16: "yinxian",
            17: "tu",
            18: "yi",
            19: "weiqu",
            20: "huaxin",
            21: "hu",
            22: "xiaonian",
            23: "neng",
            24: "taikaixin",
            25: "huaji",
            26: "mianqiang",
            27: "kuanghan",
            28: "guai",
            29: "shuijiao",
            30: "jinku",
            31: "shengqi",
            32: "jinya",
            33: "pen",
            34: "aixin",
            35: "xinsui",
            36: "meigui",
            37: "liwu",
            38: "caihong",
            39: "xxyl",
            40: "taiyang",
            41: "qianbi",
            42: "dnegpao",
            43: "chabei",
            44: "dangao",
            45: "yinyue",
            46: "haha2",
            47: "shenli",
            48: "damuzhi",
            49: "ruo",
            50: "OK"
        }
    }, {
        path: "assets/jquery-emoji/img/qq/",
        file: ".gif",
        placeholder: "#qq_{alias}#"
    }]
  });
}

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
