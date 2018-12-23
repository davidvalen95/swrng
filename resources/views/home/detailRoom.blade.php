

<?php

    /** @var App\Model\Room $room */
    /** @var App\Model\Photo $photo */
    /** @var App\Model\Advertistment[] $advertisements */
?>
@extends('master.master')



@section('content')


    <section id='page-title'>
        <section class='container'>
            <section class='row'>
                <div class='span6'>
                    <h1>Property</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{route('get.index')}}">Home</a> <span class="divider">&ndash;</span></li>
                        <li><a href="">Ruang</a> <span class="divider">&ndash;</span></li>
                        <li class="active">{{$room->roomName}}</li>
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

                                    <figure>
                                        {{--<a class="image-link" rel="prettyPhoto[gallery]" href="{{$room->getPhotos->where('isMain',true)->first()->getLarge()}}">--}}

                                            {{--<div style="max-height: 450px">--}}
                                                {{--<img class='img-responsive' src="{{$room->getPhotos->where('isMain',true)->first()->getSmall()}}" alt="" />--}}
                                            {{--</div>--}}
                                        {{--</a>--}}

                                        <a rel="prettyPhoto[gallery]" href="{{$room->getPhotos->where('isMain',true)->first()->getLarge()}}">
                                            <img src="{{$room->getPhotos->where('isMain',true)->first()->getSmall()}}" alt="" />
                                        </a>

                                        <div class='banner'></div>
                                    </figure>
                                    <div class='title-line'>
                                        <div class='pull-left'>
                                            @if($room->status != 'ap')
                                            <p style="color: tomato">*Ruangan belum disetujui oleh admin sehingga tidak muncul dalam halaman utama</p><br/>
                                            @endif
                                            <h2>{{$room->roomName}}</h2> <br />
                                            <h2>{{$room->buildingName}}</h2> <br />
                                            <h2>{{$room->roomFunction}}</h2> <br />
                                            <p>{{$room->address}}, {{$room->city}}</p><br />
                                            <p>No. Telephone ruangan <b>{{$room->providerTelephone}}</b></p><br />
                                            <p>No. Telephone pemilik akun <b>{{$room->getUser->telephone}}</b></p>


                                        </div>
                                        <div class='pull-right'>
                                            <span class='price'>Rp. {{$room->mainPrice}} per {{$room->mainPriceUnit}}</span>

                                            {{--@foreach($room->getPrices->all() as $price)--}}
                                                {{--<p style="display: block;text-align: right; margin: 0" class=''>Per {{$price->unit}}: Rp. {{number_format($price->price)}}</p>--}}

                                            {{--@endforeach--}}


                                            @if($isMyRoom)

                                                <a href="{{route('get.editMyRoom',[$room->id])}}" style='display:block; margin-top: 12px;' class="btn btn-primary">Edit Ruangan</a>

                                            @endif
                                        </div>
                                    </div>
                                    <div class='description'>
                                        <p>{{$room->description}}</p>
                                    </div>
                                    <table class='table table-hover table-bordered'>
                                        @php
                                        $keyValueContainer = [
                                            [
                                                "key"=>"kapasitas kelas",
                                                "value" => "$room->capacityClass orang",
                                                "initialValue" => $room->capacityClass,
                                            ],[
                                                "key"=>"kapasitas U-Shape",
                                                "value" => "$room->capacityUShape orang",
                                                "initialValue" => $room->capacityUShape,
                                            ],[
                                                "key"=>"kapasitas Teater",
                                                "value" => "$room->capacityTheatre orang",
                                                "initialValue" => $room->capacityTheatre,
                                            ],[
                                                "key"=>"luas",
                                                "value" => "$room->area m<sup>2</sup>",
                                                "initialValue" => $room->area,
                                            ],[
                                                "key"=>"Slot Parkir",
                                                "value" => "$room->parking",
                                                "initialValue" => $room->parking,
                                            ],[
                                                "key"=>"Fasilitas",
                                                "value" => "$room->facility",
                                                "initialValue" => $room->facility,
                                            ],[
                                                "key"=>"Katering",
                                                "value" => "$room->caterings",
                                                "initialValue" => $room->caterings,
                                            ],[
                                                "key"=>"Jumlah ruang",
                                                "value" => "$room->totalRoom",
                                                "initialValue" => $room->totalRoom,
                                            ]
                                        ]
                                        @endphp
                                        @foreach($keyValueContainer as $keyValue)
                                            @php($keyValue = (object)$keyValue)

                                            @php($keyValue->value = $keyValue->initialValue? $keyValue->value : "Belum ada info")
                                            <tr>
                                                <td>{{getNameFormat($keyValue->key)}}</td>
                                                <td> {!! $keyValue->value !!}</td>
                                            </tr>

                                        @endforeach



                                    </table>

                                    @if($room->latitude && $room->longitude)
                                        halo
                                        <iframe src="https://www.google.com/maps/embed?q=-37.866963,144.980615" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

                                    @endif
                                </div>
                                <div class='right'>
                                    <h3>Gallery <span>({{$room->getPhotos->where('isPrimary','false')->count()}} photos)</span></h3>
                                    <div class='gallery'>

                                        @php($counter = 1)
                                        @foreach($room->getPhotos->where('isMain',false)->all() as $photo)

                                            <div class='line'>
                                                <figure>
                                                    <a rel="prettyPhoto[gallery]" href="{{$photo->getLarge()}}">

                                                    <div style="max-height: 90px; overflow: hidden;">
                                                        <img class="img-responsive" src="{{$photo->getSmall()}}" alt="" />

                                                    </div>
                                                    </a>
                                                </figure>



                                                {{--<figure>--}}
                                                    {{--<a class="image-link"  rel="prettyPhoto[gallery]" href="{{$photo->getLarge()}}">--}}
                                                        {{--<img src="{{$photo->getSmall()}}" alt="">--}}
                                                    {{--</a>--}}
                                                {{--</figure>--}}

                                            </div>
                                        @endforeach


                                        {{--<div class='line'>--}}
                                            {{--<figure>--}}
                                                {{--<a rel="prettyPhoto[gallery]" href="img/photos/4834203945_3e56a09048_b.jpg">--}}
                                                    {{--<img src="img/photos/4834203945_3e56a09048_b.jpg" alt="" />--}}
                                                {{--</a>--}}
                                            {{--</figure>--}}
                                            {{--<figure>--}}
                                                {{--<a rel="prettyPhoto[gallery]" href="img/photos/4834790926_0228ed6cde_b.jpg">--}}
                                                    {{--<img src="img/photos/4834790926_0228ed6cde_b.jpg" alt="" />--}}
                                                {{--</a>--}}
                                            {{--</figure>--}}
                                        {{--</div>--}}
                                        {{--<a rel="prettyPhoto[gallery]" class='more'>View all photos</a>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='bottom'>
                            <div class='inner'>
                                <div class='row'>
                                    <div class='pull-left update-box'>
                                        <p>Update terakhir <a >{{$room->updated_at}}</a> by <a>{{$room->getUser->name}}</a>.</p>
                                    </div>
                                    <div class='pull-right'>
                                        {{--<p><a href="#">Login</a> untuk review</p>--}}
                                        {{--<div class='star-rating'>--}}
                                            {{--<button class='star blue'>1 Star</button>--}}
                                            {{--<button class='star active'>2 Star</button>--}}
                                            {{--<button class='star active'>3 Star</button>--}}
                                            {{--<button class='star'>4 Star</button>--}}
                                            {{--<button class='star'>5 Star</button>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--#Komensection--}}
                    {{--<div class='author-section big-margins'>--}}
                        {{--<div class='left'>--}}
                            {{--<div class='inner'>--}}
                                {{--<div class='row'>--}}
                                    {{--<figure>--}}

                                    {{--</figure>--}}
                                    {{--<div class='text'>--}}
                                        {{--<h2>Martin J. Doe</h2> <br />--}}
                                        {{--<span class='job-title'>Agent & Real Estate Specialist</span>--}}
                                        {{--<p>In porttitor augue vel velit luctus at scelerisque nisi dictum. Ut tempus dignissim mi, at gravida leo porta ut.</p>--}}
                                        {{--<a href="#" class='follow btn btn-primary'><i class='icon-white icon-plus'></i> Follow</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class='right'>--}}
                            {{--<div class='listings'>--}}
                                {{--<span class='number'>25</span> <br />--}}
                                {{--<span>listings</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </section>

                <aside class="span3">
                    @foreach($advertisements as $advertisement)

                        <section class="widget">
                            <a target="_blank" href="//{{$advertisement->link}}"><img class="img-responsive" src="{{asset($advertisement->getPhoto->path.$advertisement->getPhoto->nameSm)}}" /></a>

                        </section>

                    @endforeach

                </aside>
                {{--<aside class='span3'>--}}
                    {{--<section class='widget'>--}}
                        {{--<section class='widget-title uppercase'>--}}
                            {{--<div class='inner'>--}}
                                {{--<h2>Refine Search</h2>--}}
                            {{--</div>--}}
                        {{--</section>--}}
                        {{--<section class='widget-content'>--}}
                            {{--<form action="#">--}}
                                {{--<div class='widget-section'>--}}
                                    {{--<div class='inner'>--}}
                                        {{--<label for="location">Location</label>--}}
                                        {{--<input type="text" name='location' id='location' class='input-block-level' value='Oxford'/>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class='widget-section'>--}}
                                    {{--<div class='inner'>--}}
                                        {{--<label for="propertyType">Property Type</label>--}}
                                        {{--<select name="propertyType" id="propertyType" class='btn-block selectpicker'>--}}
                                            {{--<option value="all">All</option>--}}
                                            {{--<option value="all">Mansion</option>--}}
                                            {{--<option value="all">Apartment</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class='widget-section'>--}}
                                    {{--<div class='inner'>--}}
                                        {{--<label for="category">Category</label>--}}
                                        {{--<select name="propertyType" id="category" class='btn-block selectpicker'>--}}
                                            {{--<option value="all">For Sale</option>--}}
                                            {{--<option value="all"></option>--}}
                                            {{--<option value="all">Forclosures</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class='widget-section first-half'>--}}
                                    {{--<div class='inner'>--}}
                                        {{--<label for="minPrice">Min. Price</label>--}}
                                        {{--<select name="propertyType" id="minPrice" class='btn-block selectpicker'>--}}
                                            {{--<option value="all">$17K</option>--}}
                                            {{--<option value="all">$27K</option>--}}
                                            {{--<option value="all">$37K</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class='widget-section second-half'>--}}
                                    {{--<div class='inner'>--}}
                                        {{--<label for="maxPrice">Max. Price</label>--}}
                                        {{--<select name="propertyType" id="maxPrice" class='btn-block selectpicker'>--}}
                                            {{--<option value="all">$999K</option>--}}
                                            {{--<option value="all">$899K</option>--}}
                                            {{--<option value="all">$799K</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class='widget-section'>--}}
                                    {{--<div class='inner'>--}}
                                        {{--<label for="bedrooms">Bedrooms</label>--}}
                                        {{--<select name="propertyType" id="bedrooms" class='btn-block selectpicker'>--}}
                                            {{--<option value="all">3</option>--}}
                                            {{--<option value="all">2</option>--}}
                                            {{--<option value="all">4</option>--}}
                                            {{--<option value="all">5</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class='widget-section'>--}}
                                    {{--<div class='inner' style='position: relative;'>--}}
                                        {{--<label for="size">Size</label>--}}
                                        {{--<input type="text" name='size' id='size' class='input-block-level' value='500'/>--}}
                                        {{--<span class='measure-type'>sqft</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class='widget-section'>--}}
                                    {{--<div class='inner'>--}}
                                        {{--<label for='range'>Slide Example</label>--}}
                                        {{--<input type="text" name='size' id='range' class='input-block-level range-example'/>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<section class='widget-buttons'>--}}
                                    {{--<div class='inner'>--}}
                                        {{--<a href="#" class='more-options'>More Options</a> <br />--}}
                                        {{--<a href='#' class='btn btn-primary btn-large btn-block'>Update</a>--}}
                                    {{--</div>--}}
                                {{--</section>--}}
                            {{--</form>--}}
                        {{--</section>--}}
                    {{--</section>--}}
                {{--</aside>--}}
            </section>
        </section>
    </section>

@endsection