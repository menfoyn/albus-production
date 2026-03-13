@extends('layouts.admin')
@section('title', 'Mesajlar')

@section('content')
<div class="card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Gönderen</th>
                    <th>E-posta</th>
                    <th>Şirket</th>
                    <th>Konu</th>
                    <th>Tarih</th>
                    <th>Durum</th>
                    <th width="120">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr style="{{ !$msg->is_read ? 'font-weight:600' : '' }}">
                    <td>{{ $msg->name }}</td>
                    <td><a href="mailto:{{ $msg->email }}" style="color:var(--red)">{{ $msg->email }}</a></td>
                    <td>{{ $msg->company ?? '-' }}</td>
                    <td>{{ $msg->subject ?: Str::limit($msg->message, 40) }}</td>
                    <td style="white-space:nowrap">{{ $msg->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        @if(!$msg->is_read)
                            <span style="background:#fef2f2;color:#dc2626;padding:3px 8px;border-radius:4px;font-size:12px;font-weight:600">● Yeni</span>
                        @else
                            <span style="color:#bbb;font-size:13px">Okundu</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-secondary btn-sm">Görüntüle</a>
                            <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Mesajı sil?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">✕</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;color:#999;padding:48px">Henüz mesaj yok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($messages->hasPages())
    <div style="padding:16px 24px;border-top:1px solid #f0f0f0">
        {{ $messages->links() }}
    </div>
    @endif
</div>
@endsection
