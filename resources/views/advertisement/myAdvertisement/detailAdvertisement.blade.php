

<?php

/** @var App\Model\Advertistment $advertisement */
/** @var App\Model\AdvertistmentHistoryDescription $history $lastUnpaid */
/** @var App\Model\AdvertistmentPayment $paymentHistory */

///** @var App\Model\Photo $photo */
?>
@extends('master.master')



@section('content')


    <section id='page-title'>
        <section class='container'>
            <section class='row'>
                <div class='span6'>
                    <h1>Atur iklan</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{route('get.index')}}">Home</a> <span class="divider">&ndash;</span></li>
                        <li><a href="">Iklan</a> <span class="divider">&ndash;</span></li>
                        {{--<li class="active">{{$advertisement->targetCity}}</li>--}}
                    </ul>
                </div>
            </section>
        </section>
    </section>
    <section id='content' class='alternate-bg'>
        <section class='container'>
            <section class='row featured-items'>
                <section class='span9'>
                    <div class='property-box'>
                        <div class='top'>
                            <div class='row'>
                                <div class='left'>
                                    <h1>{{$advertisement->description}}</h1>

                                    <figure>
                                        <a class="image-link" href="{{$advertisement->getPhoto->getLarge()}}">

                                            <div style="max-height: 450px">
                                                <img class='img-responsive' src="{{$advertisement->getPhoto->getSmall()}}" alt="" />
                                            </div>
                                        </a>

                                        <div class='banner'></div>
                                    </figure>
                                    <div class='title-line'>
                                        <div class='pull-left'>
                                            @php
                                                $lastUnpaid = $advertisement->getLastUnpaidInvoice();
                                            @endphp

                                            {{--@if($lastUnpaid)--}}
                                                {{--<div>Nomer Invoice yang harus dibayarkan--}}
                                                    {{--<b style="color:tomato;font-size: 24px">--}}

                                                        {{--{{$lastUnpaid ? $lastUnpaid->invoice : ""}}--}}
                                                    {{--</b>--}}
                                                    {{--<a href="{{route('get.advertisementPayment',['invoice'=>$lastUnpaid->invoice])}}">Klik untuk konfirmasi pembayaran</a>--}}

                                                {{--</div><br/>--}}
                                            {{--@endif--}}

                                            {{--<h2>{{$advertisement->roomName}}</h2> <br />--}}
                                            {{--<h2>{{$advertisement->buildingName}}</h2> <br />--}}
                                            {{--<h2>{{$advertisement->roomFunction}}</h2> <br />--}}
                                            {{--<p>{{$advertisement->address}}, {{$advertisement->city}}</p><br />--}}
                                            <p>Link iklan: <b>{{$advertisement->link}}</b></p><br />
                                            <p>Target kota: <b>{{$advertisement->targetCity}}</b></p><br />
                                            <p>Status iklan: {!! getReadableStatus($advertisement->status) !!}</p><br />
                                            <p>Berlaku sampai: <b>{{$advertisement->validUntil ? $advertisement->validUntil : "Belum ada keterangan"}}</b></p><br />
                                            <p>Deskripsi: <span>{{$advertisement->description}}</span></p><br />
                                            {{--<p>No. Telephone pemilik akun <b>{{$advertisement->getUser->telephone}}</b></p>--}}


                                        </div>

                                    </div>


                                    <table class='table table-hover table-bordered'>
                                        @php
                                            //debug();
                                        @endphp
                                        @foreach($advertisement->getHistories->all() as $history)
                                            @php
                                                $history->setDefaultPreference();
                                            @endphp

                                            <a class="btn btn-primary" href="{{route('get.editAdvertisement',[$advertisement->id])}}">Edit iklan ini</a>
                                            <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                                <th>Keterangan</th>
                                                <th>Nomer Invoice</th>
                                                <th>Harga</th>
                                                <th>Bukti pembayaran</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>

                                            <tr>
                                                <td>{{$history->created_at}}</td>
                                                <td>{!! getReadableStatus($history->status)!!}</td>
                                                <td>{{$history->description}}</td>
                                                <td>{{$history->invoice}}</td>
                                                <td>{{$history->price}}</td>
{{--                                                <td> {!! $keyValue->value !!}</td>--}}
                                                <td>
                                                    @php($i=1)
                                                    @foreach($history->getPayment() as $paymentHistory)
                                                        <a class="image-link" href="{{asset($paymentHistory->getPhoto->getLarge())}}">Bukti-{{$i++}}</a><br/>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @if($history->status == 'pa')
                                                        <a href="{{route('get.advertisementPayment',['invoice'=>$lastUnpaid->invoice])}}">Klik untuk konfirmasi pembayaran</a>
                                                    @endif
                                                </td>
                                            </tr>

                                        @endforeach



                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>

                 
                </section>
             
            </section>
        </section>
    </section>

@endsection