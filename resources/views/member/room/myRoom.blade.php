

<?php
/** @var App\Model\Room[] $rooms */
/** @var App\Model\Photo $photo */

?>


    <div class='description-box open' rel='1'>


            @foreach($rooms as $room)
            <div class='inner' style="">
                <div class='inner-container'>
                    <div style="display:block">

                        {{--<img alt="" src="img/photos/4947806065_f932310392_b.jpg" />--}}

                        <h2>{{$room->roomName}}</h2>
                        @php($photo = $room->getPhotos->where('isMain',true)->first())
                        {{--{{$room->getImagePath(Auth::user(),false)}}--}}
                        @php($room->setDefaultPreference())
                        @if($photo)
                            {{--{{$photo->nameLg}}--}}

                        <a class="image-link" href="{{$photo->getLarge()}}"><div style="max-width:450px;max-height:200px; overflow:hidden; float:left; padding-right: 16px;">
                            <img class="img-responsive" alt="" src="{{$photo->getSmall()}}" />

                            </div></a>


                        @endif
                        <p style="margin-bottom:-2px;">{{$room->buildingName}}, {{$room->city}}</p>
                        <p style="margin-bottom:0px;">Harga Per Jam: Rp.{{$room->mainPrice}}</p>
                        {{--<a href="{{route('get.myRoomDetail',[$room->id])}}">Detail Ruangan</a>--}}
                        <a href="{{route('get.roomDetail',[$room->id])}}">Detail Ruangan</a>
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

        @if(sizeof($rooms)== 0)
            <p style="padding:16px;">
                Saat ini anda belum memiliki ruangan yang dipasang
            </p>
            {{--Belum ada ruangan--}}
        @endif
    </div>

