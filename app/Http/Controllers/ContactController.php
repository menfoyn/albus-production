<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
        ], [
            'name.required'    => 'Ad soyad alanı zorunludur.',
            'email.required'   => 'E-posta alanı zorunludur.',
            'email.email'      => 'Geçerli bir e-posta adresi giriniz.',
            'message.required' => 'Mesaj alanı zorunludur.',
            'message.min'      => 'Mesaj en az 10 karakter olmalıdır.',
        ]);

        // Veritabanına kaydet
        $contactMessage = ContactMessage::create($validated);

        // Mail gönder
        try {
            Mail::to(config('mail.to_address', env('MAIL_TO_ADDRESS', 'info@albusproduction.com')))
                ->send(new ContactFormMail($contactMessage));
        } catch (\Exception $e) {
            // Mail gönderilemese de form başarılı sayılır
        }

        return back()->with('success', 'Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.');
    }
}
