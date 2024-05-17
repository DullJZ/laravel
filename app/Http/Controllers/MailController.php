<?php
#  我真诚地保证：
#  我自己独立地完成了整个程序从分析、设计到编码的所有工作。
#  如果在上述过程中，我遇到了什么困难而求教于人，那么，我将在程序实习报告中
#  详细地列举我所遇到的问题，以及别人给我的提示。
#  在此，我感谢 ChatGPT 对我的启发和帮助。下面的报告中，我还会具体地提到
#  他们在各个方法对我的帮助。
#  我的程序里中凡是引用到其他程序或文档之处，
#  例如教材、课堂笔记、网上的源代码以及其他参考书上的代码段,
#  我都已经在程序的注释里很清楚地注明了引用的出处。

#  我从未没抄袭过别人的程序，也没有盗用别人的程序，
#  不管是修改式的抄袭还是原封不动的抄袭。
#  我编写这个程序，从来没有想过要去破坏或妨碍其他计算机系统的正常运转。 
#  江浙

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
