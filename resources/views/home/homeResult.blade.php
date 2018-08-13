@php

    /** @var App\Model\Room[] $rooms */
    /** @var App\Model\Room $room */
@endphp


<div class='featured-items-slider'>
    <ul class='slides'>
        <li>
            <div class='row'>

                @foreach($rooms as $room)
                    @php

                        $room->setDefaultPreference();
                    @endphp
                    <a href="{{route("get.roomDetail",[$room->id])}}">
                        <div class='span3 featured-item-wrapper'>
                            <div class='featured-item'>
                                <div class='top'>
                                    <div class='inner-border'>
                                        <div class='inner-padding'>
                                            <figure>
                                                <div>
                                                    <img class="img-responsive" src="{{$room->getPhotos->where('isMain',true)->first()->getSmall()}}" alt=""/>

                                                </div>
                                                <div class='banner'></div>

                                            </figure>
                                            <h3>{{$room->roomFunction}}</h3>
                                            <p>{{$room->buildingName}} - {{$room->roomName}}, {{$room->city}}</p>
                                            {{--<p>Kapasit}</p>--}}

                                        </div>
                                    </div>
                                    <i class='bubble'></i>
                                </div>
                                <div class='bottom'>
                                    <div class='inner-border'>
                                        <div class='inner-padding'>
                                            <p>{{$room->address}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class='price-wrapper'>
                                <div class='price'>Rp. {{($room->mainPrice)}}</div>
                                <div class='rate'>/jam</div>
                            </div>
                        </div>
                    </a>
                @endforeach


            </div>
        </li>

    </ul>
</div>