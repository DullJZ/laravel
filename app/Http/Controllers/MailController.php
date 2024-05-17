<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EmailCode;
use App\Mail\Email;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    //
    public function send($to) {
        // 生成验证码
        $this->createCode($to);
        // 发送邮件
        $mailable = new Email(EmailCode::where('email', $to)->first());
        Mail::to($to)->send($mailable);
        return '验证码已发送';
    }
    public function check($to, $code) {
        if ($this->checkCode($to, $code)) {
            return true;
        } else {
            return false;
        }
    }
    // 生成验证码
    private function createCode($useremail) {
        $code = rand(1000, 9999);
        // 如果数据库中已经有了这个邮箱的验证码，就把之前的验证码无效
        EmailCode::where('email', $useremail)->where('expired_at', '>', now())->update(['expired_at' => now()]);
        // 写入数据库
        EmailCode::create([
            'email' => $useremail,
            'code' => $code,
            'generated_at' => now(),
            'expired_at' => now()->addMinutes(5)
        ]);
        return $code;
    }
    // 检查验证码
    private function checkCode($useremail, $code) {
        $record = EmailCode::where('email', $useremail)->where('code', $code)->where('expired_at', '>', now())->first();
        if ($record) {
            $record->expired_at = now();
            $record->save();
            return true;
        }
        return false;
    }
}
