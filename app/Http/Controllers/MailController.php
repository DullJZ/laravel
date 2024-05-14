<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EmailCode;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    //
    public function send($to) {
        // 生成验证码
        $code = $this->createCode($to);
        Mail::raw('你好，我是PHP程序！', function ($message) use ($to, $code){
            $message ->to($to)->subject('验证码' . $code);
        });
        return '发送成功';
    }
    // 生成验证码
    private function createCode($useremail) {
        $code = rand(1000, 9999);
        // 写入数据库
        EmailCode::create([
            'email' => $useremail,
            'code' => $code,
            'generated_at' => time(),
            'expired_at' => time() + 60 * 5
        ]);
        return $code;
    }
}
