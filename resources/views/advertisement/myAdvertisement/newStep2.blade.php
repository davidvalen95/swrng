@php
/**
* @var \App\Model\Advertistment $advertisement
* @var \App\Model\AdvertistmentHistoryDescription $advertisementHistory
*/

@endphp
@extends('master.master')


@section('content')


    <section class='full-width'>
        <section class='container'>
            <section class='row'>
                <h5 class="text-center">Iklan berhasil di buat!</h5>
                <div class='span12'>
                    <p><b>Ikuti petunjuk di bawah ini untuk pembayaran</b></p>
                    <ol style="color:black;">
                        <li>
                          <div class='text'>Transfer menggunakan rekening BCA XXXX a/n Ferry Lung</div>
                        </li>
                        <li>
                           <div class='text'>Untuk iklan sesuai dengan durasi maka transfer sejumlah <b>Rp. {{number_format($advertisementHistory->price)}}</b></div>
                        </li>
                        <li>
                            <div class='text'>Isi berita acara <b>{{$advertisementHistory->invoice}}</b></div>
                        </li>
                        <li>
                            <div class='text'>Lakukan konfirmasi di halaman atur iklan</b></div>
                        </li>
                    </ol>

                    <p>
                        <a href="{{route('get.advertisementDetail',[$advertisement->id])}}">Klik di sini untuk mengatur iklan ini</a>

                    </p>

                </div>

            </section>
        </section>
    </section>



@endsection