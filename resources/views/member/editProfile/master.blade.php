@extends('master.master')


@section('content')


    <section id='page-title' class='small-height'>
    <section class='container'>
        <section class='row'>
            {{--<img src="{{publicAsset("image/framework/photos/4834826842_7483d905eb_o.jpg")}}" alt="" class='bg-image'/>--}}

            <div class='span8'>
                <h1>Atur Profile</h1>

            </div>
        </section>
    </section>
</section>
<section class='about-slider'>
    <section class='container'>
        <section class='row'>
            <div class='span9'>

                @include('member.editProfile.form')
            </div>
            <div class='span3'>
                <div class='description-controls'>
                    <ul>

                        @php
                            //@
                                $menus = [
                               [
                                        'name'=> "Edit Profile",
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

@endsection