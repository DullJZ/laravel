<?php
 
namespace App\Mail;
 
use App\Models\EmailCode;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
 
class Email extends Mailable
{
    use Queueable, SerializesModels;
 
    /**
     * 创建一个新的消息实例。
     */
    public function __construct(
        protected EmailCode $code,
    ) {}
 
    /**
     * 获取消息内容定义。
     */
    public function content(): Content
    {
        return new Content(
            view: 'emailcode',
            with: [
                'code' => $this->code->code,
            ],
        );
    }

    /**
     * 获取消息的信封定义。
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Email Verification Code',
        );
    }
}