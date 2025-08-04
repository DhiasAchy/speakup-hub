@component('mail::message')
# 🔐 Reset Password - SpeakUp Hub

Kami menerima permintaan untuk mereset password akun Anda.  
Klik tombol di bawah ini untuk membuat password baru:

@component('mail::button', ['url' => $actionUrl])
Reset Password
@endcomponent

Jika Anda tidak meminta reset password, abaikan email ini.  
Terima kasih telah menggunakan **SpeakUp Hub**.

Salam hangat,  
SpeakUp Hub Team
@endcomponent
