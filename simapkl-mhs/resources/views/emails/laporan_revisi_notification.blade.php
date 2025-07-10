@component('mail::message')
# Revisi Laporan Akhir

Halo {{ $mahasiswa->nama }},

Dosen pembimbing telah memberikan revisi untuk laporan akhir Anda dengan judul:  
**{{ $laporan->judul_laporan }}**

{{-- @component('mail::button', ['url' => route('dashboard.mahasiswa')])
Lihat Revisi
@endcomponent --}}

Silahkan cek attachment dari email ini, Terima kasih.  
Tim {{ config('app.name') }}
@endcomponent