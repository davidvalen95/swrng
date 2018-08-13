<h2>
    5 Tahap pengajuan iklan
</h2>
<ol style="margin-bottom: 24px">
    <li>
        Mengisi Form<a href="{{route('get.myAdvertisement')}}"> (klik di sini)</a> dan mengumpulkan. Status pemasangan akan menjadi {!! getReadableStatus("pe") !!}
    </li>
    <li>
        Melakukan pembayaran pada bank dengan mengisi berita acara sesuai dengan nomer refrensi iklan.<br/>
        Contoh membayar ke BCA rekening xxxx dengan berita acara xxxxx (nomer invoice)
    </li>
    <li>
        Melakukan konfirmasi dengan upload bukti pembayaran <a href="{{route('get.advertisementPayment')}}">(klik di sini)</a>
    </li>
    <li>
        Admin akan memeriksa, jika sesuai maka status iklan akan menjadi {!! getReadableStatus("ap") !!}
    </li>
    <li>
        Status iklan yang melebihi tanggal pemasangan akan menjadi {!! getReadableStatus("exp") !!}
    </li>
</ol>