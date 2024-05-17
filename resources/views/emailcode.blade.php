<!DOCTYPE html>
<!--
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
-->
<html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif; 
            }

            .container {
                width: 100%;
                max-width: 600px;
                margin: auto;
            }

            .header {
                background-color: #f0f0f0;
                padding: 20px;
                text-align: center;
            }

            .content {
                padding: 20px;
            }

            .code {
                background-color: #f0f0f0;
                padding: 20px;
                text-align: center;
                font-size: 24px;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h2>Email Verification</h2>
            </div>
            <div class="content">
                <p>Dear user,</p>
                <p>Your verification code is:</p>
                <div class="code">{{ $code }}</div>
            </div>
        </div>
    </body>
</html>