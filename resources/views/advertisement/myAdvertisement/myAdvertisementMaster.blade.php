@extends('master.master')


@section('content')

    <section id='page-title' class='small-height'>
        <section class='container'>
            <section class='row'>
                {{--<img src="{{publicAsset("image/framework/photos/4834826842_7483d905eb_o.jpg")}}" alt="" class='bg-image'/>--}}

                <div class='span8'>
                    <h1>Atur Iklan</h1>
                    <p>Anda dapat melihat iklan-iklan anda di sini</p>
                </div>
            </section>
        </section>
    </section>
    <section class='about-slider'>
        <section class='container'>
            <section class='row'>
                <div class='span9'>

                @if(isset($advertisements))
                        @include('advertisement.myAdvertisement.myList')
                    @endif
                        @include('advertisement.myAdvertisement.myAdvertisementForm')
                </div>
                <div class='span3'>
                    <div class='description-controls'>
                        <ul>

                            @php
                                //@
                                    $menus = [
                                        [
                                            'name'=> "Iklan ku",
                                            'isShown' => isset($advertisements),
                                        ],[
                                            'name'=> isset($advertisements) ? 'Pasang iklan baru' : "Edit iklan",
                                            'isShown' => true,
    
    
    
                                        ]
    
                                    ];
                                $i= -1;
                            @endphp

                            @foreach($menus as $key=>$menu)

                                {{--@php($getActive = ($active == $key ? "active" : ""))--}}

                                @if($menu['isShown'])
                                    @php($i++)
                                    @php($getActive = ($i == 0 ? "active" : ""))
                                    <li><a href="" rel="{{($key+1)}}" class='{{$getActive}}'>{{$menu['name']}}</a></li>
                                @endif
                            @endforeach

                        </ul>
                    </div>
                </div>
            </section>
        </section>
    </section>
    {{--<section class='full-width'>--}}
        {{--<section class='container'>--}}
            {{--<section class='row'>--}}
               {{--<div class="span12">--}}
                   {{--@include('advertisement.myAdvertisement.rule')--}}

               {{--</div>--}}
            {{--</section>--}}
        {{--</section>--}}
    {{--</section>--}}
    {{--<section id='content' class='alternate-bg'>--}}
        {{--<section class='container'>--}}
            {{--<section class='row featured-items'>--}}
                {{--<div class='span12'>--}}
                    {{--<div class='stats5'>--}}
                        {{--<div class='stats-box'>--}}
                            {{--<div class='inner'>--}}
                                {{--<span class='number'>3k</span>--}}
                                {{--<span class='text'>Items in Database</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class='stats-box'>--}}
                            {{--<div class='inner'>--}}
                                {{--<span class='number'>300</span>--}}
                                {{--<span class='text'>Happy Clients</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class='stats-box'>--}}
                            {{--<div class='inner'>--}}
                                {{--<span class='number'>60</span>--}}
                                {{--<span class='text'>Experienced Agents</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class='stats-box'>--}}
                            {{--<div class='inner'>--}}
                                {{--<span class='number'>58</span>--}}
                                {{--<span class='text'>Searches per hour</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class='stats-box'>--}}
                            {{--<div class='inner'>--}}
                                {{--<span class='number'>786</span>--}}
                                {{--<span class='text'>Months of Activity</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class='span12'>--}}
                    {{--<div class="hero-unit">--}}
                        {{--<h1>Sed tortor nulla, vehicula hendrerit pretium</h1>--}}
                        {{--<p>Maecenas accumsan libero sed <strong>nunc ultricies eget molestie</strong> purus blandit. Maecenas lobortis vulputate tortor eget cursus. Curabitur a semper orci.</p>--}}
                        {{--<p>--}}
                            {{--<a class="btn btn-primary btn-large">--}}
                                {{--Learn more--}}
                            {{--</a>--}}
                        {{--</p>--}}
                    {{--</div>--}}
                {{--</div>--}}

            {{--</section>--}}
        {{--</section>--}}
    {{--</section>--}}


@endsection

