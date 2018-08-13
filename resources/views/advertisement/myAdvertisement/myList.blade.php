

<?php
/** @var App\Model\Advertistment[] $advertisements */
/** @var App\Model\Advertistment $advertisement */
///** @var App\Model\Photo $advertisement */

?>


<div class='description-box open' rel='1'>


    @foreach($advertisements as $advertisement)
        <div class='inner' style="">
            <div class='inner-container'>

                <div style="display:block">

                    <a class="image-link" href="{{$advertisement->getPhoto->getLarge()}}"><div style="max-width:450px;max-height:200px; overflow:hidden; float:left; padding-right: 16px;">
                            <img class="img-responsive pop-up" alt="" src="{{$advertisement->getPhoto->getSmall()}}" />

                        </div></a>
                    <h2>{{$advertisement->link}}</h2>
                    {{--@php($photo = $advertisement->getPhotos->where('isMain',true)->first())--}}
                    {{--{{$advertisement->getImagePath(Auth::user(),false)}}--}}
                    {{--@php($advertisement->setDefaultPreference())--}}
                    {{--@if($photo)--}}
                        {{--{{$photo->nameLg}}--}}
                        {{--<a href="{{$photo->getLarge()}}"><div style="max-width:450px;max-height:200px; overflow:hidden; float:left; padding-right: 16px;">--}}
                                {{--<img class="img-responsive" alt="" src="{{$photo->getSmall()}}" />--}}

                            {{--</div></a>--}}


                    {{--@endif--}}
                    <p style="margin-bottom:-2px;">Status: {!! getReadableStatus($advertisement->status) !!}</p>

                    <p style="margin-bottom:0px;">Berlaku sampai dengan: {{$advertisement->validThrough}}</p>
                    <p style="margin-bottom:0px;">Telah dilihat sebanyak: {{$advertisement->viewed}}</p>
                    <p style="margin-bottom:0px;">Berlaku sampai dengan: {{$advertisement->validThrough}}</p>

                    {{--<a href="{{route('get.myRoomDetail',[$advertisement->id])}}">Detail Ruangan</a>--}}
                    <a href="{{route('get.advertisementDetail',[$advertisement->id])}}">Atur iklan ini</a>
                    <div class='list-container'>
                        <ul class='custom-list'>
                        </ul>
                    </div>
                </div>

                <div style="display:block">
                    {{--<p>1Ut lobortis velit nec orci adipiscing id pellentesque lacus fermentum. Etiam vitae ante sapien, nec molestie nisi. Mauris purus tellus, luctus quis accumsan vel, pretium eu velit. Sed mattis, nunc et iaculis adipiscing, diam diam gravida augue, ut suscipit ipsum arcu vel metus.</p>--}}
                </div>
                {{--<blockquote>Aliquam placerat, quam eu volutpat lobortis, elit massa porttitor nisl, sed bibendum est massa in orci. Fusce odio sed nunc scelerisque lacinia.</blockquote>--}}

            </div>
        </div>

    @endforeach

    @if(sizeof($advertisements)== 0)
        <p style="padding:16px;">
            Saat ini anda belum memiliki iklan     yang dipasang
        </p>
        {{--Belum ada ruangan--}}
    @endif
</div>

