@php

    /** @var App\Model\Room[] $rooms */
    /** @var App\Model\Room $room */
@endphp

<div class='span9 featured-item-wrapper featured-item-list'>
    @foreach($rooms as $room)
    @php

        $room->setDefaultPreference();
    @endphp

    <div class='featured-item featured-list'>
        <div class='top'>
            <div class='inner-border'>
                <div class='inner-padding'>
                    <figure >
                        <img   class="img-responsive" src="{{$room->getPhotos->where('isMain',true)->first()->getSmall()}}" alt="" />
                        <div class='banner'></div>
                        <a href="#" class='figure-hover'>Zoom</a>
                    </figure>
                    <div class='right'>
                        <h3><a  href="{{route("get.roomDetail",[$room->id])}}">{{$room->roomFunction}}</a></h3>
                        <p>{{$room->buildingName}} - {{$room->roomName}}, {{$room->city}}</p>
                        <p><b>Deskripsi</b></p>
                        <div class='description'>
                            <p>{{$room->description}}</p>
                        </div>
                        <div class='price-wrapper'>
                            <div class='price'>Rp. {{$room->mainPrice}}</div>
                            <div class='rate'>/jam</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{--<div class='bottom'>--}}
            {{--<div class='inner-border'>--}}
                {{--<div class='inner-padding'>--}}
                    {{--<p>4 beds  +  2 baths  +  245 sqft</p>--}}
                    {{--<div class='star-rating'>--}}
                        {{--<button class='star active'>1 Star</button>--}}
                        {{--<button class='star active'>2 Star</button>--}}
                        {{--<button class='star active'>3 Star</button>--}}
                        {{--<button class='star active'>4 Star</button>--}}
                        {{--<button class='star active'>5 Star</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>

    @endforeach

</div>