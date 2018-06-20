<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lib\Redisdb;
use App\Lib\Wechat;

class WechatController extends Controller
{
  protected $wx = null;
  protected $option = [];

  function __construct()
  {
    $this->option = [
      'token'=>env('wx_token'), //填写你设定的key
      'encodingaeskey'=>env('wx_encodingaeskey'), //填写加密用的EncodingAESKey
      'appid'=>env('wx_appid'), //填写高级调用功能的app id, 请在微信开发模式后台查询
      'appsecret'=>env('wx_appsecret') //填写高级调用功能的密钥
    ];
    $this->wx = new Wechat($this->option);
    $this->wx->valid();
  }
   
  public function index(){
    $type = $this->wx->getRev()->getRevType();
    switch($type) {
      case Wechat::MSGTYPE_TEXT:
          $this->wx->text("hello, I'm wechat")->reply();
          exit;
          break;
      case Wechat::MSGTYPE_EVENT:
          break;
      case Wechat::MSGTYPE_IMAGE:
          break;
      default:
          $this->wx->text("help info")->reply();
    }
  }
}
