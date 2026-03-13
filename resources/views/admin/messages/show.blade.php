@extends('layouts.admin')
@section('title', 'Mesaj Detayı')

@section('topbar-actions')
    <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">← Geri</a>
    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Bu mesajı silmek istediğinizden emin misiniz?')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger">Sil</button>
    </form>
@endsection

@section('content')
<div style="max-width:720px">
    <div class="card">
        <div class="card-body">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:28px">
                <div>
                    <div style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#999;margin-bottom:4px">Gönderen</div>
                    <div style="font-size:16px;font-weight:600">{{ $message->name }}</div>
                </div>
                <div>
                    <div style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#999;margin-bottom:4px">E-posta</div>
                    <a href="mailto:{{ $message->email }}" style="font-size:16px;color:var(--red)">{{ $message->email }}</a>
                </div>
                @if($message->phone)
                <div>
                    <div style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#999;margin-bottom:4px">Telefon</div>
                    <div>{{ $message->phone }}</div>
                </div>
                @endif
                @if($message->company)
                <div>
                    <div style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#999;margin-bottom:4px">Şirket</div>
                    <div>{{ $message->company }}</div>
                </div>
                @endif
                @if($message->subject)
                <div style="grid-column:span 2">
                    <div style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#999;margin-bottom:4px">Konu</div>
                    <div>{{ $message->subject }}</div>
                </div>
                @endif
                <div>
                    <div style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#999;margin-bottom:4px">Gönderim Tarihi</div>
                    <div>{{ $message->created_at->format('d.m.Y H:i') }}</div>
                </div>
            </div>

            <div style="border-top:1px solid #f0f0f0;padding-top:24px">
                <div style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#999;margin-bottom:12px">Mesaj</div>
                <div style="font-size:16px;line-height:1.8;color:#333;background:#f8f8f8;padding:24px;border-radius:8px;border-left:4px solid var(--red)">
                    {!! nl2br(e($message->message)) !!}
                </div>
            </div>

            <div style="margin-top:24px">
                <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="btn btn-primary">
                    ✉ {{ $message->name }}'e Cevap Ver
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
