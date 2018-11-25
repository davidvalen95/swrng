@php

    /** @var App\Model\Room[] $rooms */
    /** @var App\Model\Room $room */



@endphp

@extends('master.master')

@section('content')


    <section id='homepage-slider'>

        <div class='controls-wrapper'>
            <section class='container'>
                <section class='row'>

                    <div class='controls hidden-phone'>
                        @php
                            $listPage = pagination($rooms);
                        @endphp
                        {!! $listPage !!}


                    </div>
                </section>
            </section>
        </div>
        <section class='slider-wrapper'>
            <div class='homepage-slider hidden-phone'>
                <ul class='slides'>
                    <li>
                        <img src="{{publicAsset("image/framework/photos/4834201449_2801d96045_o-1.jpg")}}" alt="" class='bg-image'/>
                        <div class='container'>
                            <div class='row'>
                                <div class='span12'>
                                    <div class='text-box span6'>
                                        <h1><a href="#">Sewa ruang</a></h1>
                                        <p>Tempat terbaik mencari ruang</p>
                                    </div>
                                    {{--<div class='description'>--}}
                                        {{--<div class='left'>--}}
                                            {{--<div class='title'>--}}
                                                {{--<div class='big'>Seaway house</div>--}}
                                                {{--<div class='small'>Los Angeles, CA</div>--}}
                                            {{--</div>--}}
                                            {{--<div class='rooms'> 3 bedrooms - 2 bathrooms</div>--}}
                                        {{--</div>--}}
                                        {{--<div class='right'>--}}
                                            {{--<div class='price'>--}}
                                                {{--<div class='number'> $1200</div>--}}
                                                {{--<div class='rate'> per month</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        </div>
                    </li>
                    {{--<li>--}}
                        {{--<img src="{{publicAsset("image/framework/photos/4834826842_7483d905eb_o.jpg")}}" alt="" class='bg-image'/>--}}
                        {{--<div class='container'>--}}
                            {{--<div class='row'>--}}
                                {{--<div class='span12'>--}}
                                    {{--<div class='text-box span6'>--}}
                                        {{--<h1><a href="property.html">4 bedrooms apartment for sale!</a></h1>--}}
                                        {{--<p>Pellentesque viverra lacus quis lacus viverra mattis. Sed sed nisi erat, sed--}}
                                            {{--consectetur metus.</p>--}}
                                    {{--</div>--}}
                                    {{--<div class='description'>--}}
                                        {{--<div class='left'>--}}
                                            {{--<div class='title'>--}}
                                                {{--<div class='big'>Seaway house</div>--}}
                                                {{--<div class='small'>Los Angeles, CA</div>--}}
                                            {{--</div>--}}
                                            {{--<div class='rooms'> 4 bedrooms - 5 bathrooms</div>--}}
                                        {{--</div>--}}
                                        {{--<div class='right'>--}}
                                            {{--<div class='price'>--}}
                                                {{--<div class='number'> $32000</div>--}}
                                                {{--<div class='rate'> per year</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                </ul>
            </div>
        </section>
    </section>

    <section id='main' role='main'>
        <section class='container'>
            <section class='row tab-finder'>
                <div class='span12'>
                    <div class="tabbable">
                        {{--<ul class="nav nav-tabs">--}}
                            {{--<li class="active first-tab"><a href="#tab1" data-toggle="tab">For Sale</a></li>--}}
                           {{----}}
                        {{--</ul>--}}
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <div class='inner'>

                                    @php


                                    $function = new CForm("Fungsi","search[roomFunction]");
                                    $function->value =  Illuminate\Support\Facades\Input::get('search')["roomFunction"];

                                    $function->isButton = true;
                                    $function->placeholder = "Filter fungsi ruang";

                                    $function->setInputTypeSelect([],\App\Model\FungsiRuang::all());
                                    $city = new CForm("Filter Kota","search[city]");
                                    $city->value =  Illuminate\Support\Facades\Input::get('search')['city'];
                                    $city->isButton = true;
                                    $city->placeholder = "Kota";
                                    $city->setInputTypeSelect(["surabaya","jakarta","medan"]);





                                    $forms = [$function,$city];
                                    @endphp
                                    <form action="" method="GET">
                                        {{--<input type="text" name='search-string' class='search-string'--}}
                                               {{--placeholder="eg. 'Miami', 'Los Angeles'"/>--}}
                                        {{--<input type="text" name='search-year' class='search-year' placeholder="Year"/>--}}


                                        @foreach($forms as $form)
                                            <div style="display: inline-block;">{!! $form->getOutput() !!}</div>
                                        @endforeach
                                        {{--<input type="text" name='search-min-price' class='span2 search-price no-margin'--}}
                                               {{--placeholder="Min. Price"/>--}}
                                        {{--<span class='line-divider'>&ndash;</span>--}}
                                        {{--<input type="text" name='search-max-price' class='span2 search-price'--}}
                                               {{--placeholder="Max. Price"/>--}}
                                        <div>

                                            <button syle='display:block;' type="submit" class='btn btn-primary search-property'> Cari Ruang
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2">
                                <div class='inner'>
                                    <form action="#">
                                        <input type="text" name='search-string' class='search-string'
                                               placeholder="eg. 'Miami', 'Los Angeles'"/>
                                        <input type="text" name='search-year' class='search-year' placeholder="Year"/>
                                        <select name="search-bedrooms" class='span2 selectpicker search-select'>
                                            <option>Bedrooms</option>
                                            <option>1</option>
                                            <option>2</option>
                                        </select>
                                        <select name="search-bathrooms" class='span2 selectpicker search-select'>
                                            <option>Bathrooms</option>
                                            <option>1</option>
                                            <option>2</option>
                                        </select>
                                        <input type="text" name='search-min-price' class='span2 search-price no-margin'
                                               placeholder="Min. Price"/>
                                        <span class='line-divider'>&ndash;</span>
                                        <input type="text" name='search-max-price' class='span2 search-price'
                                               placeholder="Max. Price"/>
                                        <button type="submit" class='btn btn-primary search-property'><i
                                                    class="icon-search icon-white"></i> Search Property
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab3">
                                <div class='inner'>
                                    <form action="#">
                                        <input type="text" name='search-string' class='search-string'
                                               placeholder="eg. 'Miami', 'Los Angeles'"/>
                                        <input type="text" name='search-year' class='search-year' placeholder="Year"/>
                                        <select name="search-bedrooms" class='span2 selectpicker search-select'>
                                            <option>Bedrooms</option>
                                            <option>1</option>
                                            <option>2</option>
                                        </select>
                                        <select name="search-bathrooms" class='span2 selectpicker search-select'>
                                            <option>Bathrooms</option>
                                            <option>1</option>
                                            <option>2</option>
                                        </select>
                                        <input type="text" name='search-min-price' class='span2 search-price no-margin'
                                               placeholder="Min. Price"/>
                                        <span class='line-divider'>&ndash;</span>
                                        <input type="text" name='search-max-price' class='span2 search-price'
                                               placeholder="Max. Price"/>
                                        <button type="submit" class='btn btn-primary search-property'><i
                                                    class="icon-search icon-white"></i> Search Property
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab4">
                                <div class='inner'>
                                    <form action="#">
                                        <input type="text" name='search-string' class='search-string'
                                               placeholder="eg. 'Miami', 'Los Angeles'"/>
                                        <input type="text" name='search-year' class='search-year' placeholder="Year"/>
                                        <select name="search-bedrooms" class='span2 selectpicker search-select'>
                                            <option>Bedrooms</option>
                                            <option>1</option>
                                            <option>2</option>
                                        </select>
                                        <select name="search-bathrooms" class='span2 selectpicker search-select'>
                                            <option>Bathrooms</option>
                                            <option>1</option>
                                            <option>2</option>
                                        </select>
                                        <input type="text" name='search-min-price' class='span2 search-price no-margin'
                                               placeholder="Min. Price"/>
                                        <span class='line-divider'>&ndash;</span>
                                        <input type="text" name='search-max-price' class='span2 search-price'
                                               placeholder="Max. Price"/>
                                        <button type="submit" class='btn btn-primary search-property'><i
                                                    class="icon-search icon-white"></i> Search Property
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class='row featured-items'>
                <div class='span12'>
                    @php
                    $search = \Illuminate\Support\Facades\Input::get("search");
                    @endphp
                    @if($search)
                        <h2>Hasil pencarian
                        @if($search['roomFunction'])
                            ruang {{$search['roomFunction']}}
                        @endIf

                        @if($search['city'])
                            di Kota {{$search['city']}}
                        @endIf
                        </h2>
                    @endif

                    <div class='controls'>
                        @php
                            $listPage = pagination($rooms);
                        @endphp
                        {!! $listPage !!}
                    </div>


                    {{--theRooms--}}


                    @if(sizeof($rooms) == 0)
                        <p>Hasil pencarian tidak ditemukan</p>
                    @endif

                    @if($search)
                        @include('home.searchResult')

                    @else
                        @include('home.homeResult')

                    @endif
                </div>

                <i class='content-bubble'></i>
            </section>
        </section>
    </section>
   

@endsection
