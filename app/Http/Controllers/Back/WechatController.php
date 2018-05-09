<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    $this->wx = new \App\Lib\Wechat($this->option);
  }
   
  public function index(){
    echo '1';
  }
}
