<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Yeni İletişim Mesajı</title>
<style>
body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 20px; }
.container { max-width: 600px; margin: 0 auto; background: #fff; border-radius: 8px; overflow: hidden; }
.header { background: #0a0a1a; padding: 32px; text-align: center; }
.header h1 { color: #fff; font-size: 24px; margin: 0; letter-spacing: -0.5px; }
.header span { color: #E8001C; }
.body { padding: 40px; }
.body h2 { font-size: 20px; color: #111; margin-bottom: 24px; }
.field { margin-bottom: 20px; border-bottom: 1px solid #f0f0f0; padding-bottom: 16px; }
.field .label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #999; margin-bottom: 4px; }
.field .value { font-size: 15px; color: #111; line-height: 1.6; }
.message-box { background: #f8f8f8; border-left: 4px solid #E8001C; padding: 20px; border-radius: 4px; margin-top: 24px; font-size: 15px; line-height: 1.7; color: #333; }
.footer { background: #f8f8f8; padding: 20px 40px; text-align: center; font-size: 12px; color: #999; }
</style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>—<span>A</span>LBUS Production</h1>
    </div>
    <div class="body">
        <h2>Yeni İletişim Formu Mesajı</h2>
        <div class="field">
            <div class="label">Gönderen</div>
            <div class="value">{{ $contactMessage->name }}</div>
        </div>
        <div class="field">
            <div class="label">E-posta</div>
            <div class="value"><a href="mailto:{{ $contactMessage->email }}" style="color:#E8001C">{{ $contactMessage->email }}</a></div>
        </div>
        @if($contactMessage->phone)
        <div class="field">
            <div class="label">Telefon</div>
            <div class="value">{{ $contactMessage->phone }}</div>
        </div>
        @endif
        @if($contactMessage->company)
        <div class="field">
            <div class="label">Şirket</div>
            <div class="value">{{ $contactMessage->company }}</div>
        </div>
        @endif
        @if($contactMessage->subject)
        <div class="field">
            <div class="label">Konu</div>
            <div class="value">{{ $contactMessage->subject }}</div>
        </div>
        @endif
        <div class="message-box">{{ $contactMessage->message }}</div>
        <p style="margin-top:24px;font-size:13px;color:#999">
            Gönderim tarihi: {{ $contactMessage->created_at->format('d.m.Y H:i') }}
        </p>
    </div>
    <div class="footer">
        Bu mesaj Albus Production web sitesindeki iletişim formundan gönderilmiştir.
    </div>
</div>
</body>
</html>
