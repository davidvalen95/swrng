
{{--for signup or login--}}


{{--<div style="display:block;background:tomato;padding:25px 0;color:white;text-align: center;z-index: 9999;">--}}


{{--</div>--}}
<section id='hidden-header' style="padding-top: 0px; overflow-y:scroll;">
    <section class='container'>
        <section class='row contact-form'>

            <div class='span6' >
                <div class='login-form top-form'>
                    <h2>Contact Form</h2>

                    <p>Quisque tincidunt ornare sapien, at commodo ante tristique non. Integer id tellus nisl. Donec eget nunc eget odio malesuada egestas.</p>

                    <form action="#" class='row'>
                        <div class='span3'>
                            <input type="text" class='input-block-level' name='name' placeholder="Name"/>
                        </div>
                        <div class='span3'>
                            <input type="email" class='input-block-level' name='email' placeholder="Email"/>

                        </div>
                        <div class='span6'>
                            <textarea name="message" class='input-block-level' rows="5" placeholder="Message"></textarea>
                            <input type="submit" name='submit' value='Send' class='btn btn-primary'/>
                        </div>
                    </form>
                </div>
            </div>
            <div class='span6'>
                <div class='top-form addresses'>
                    <h2>Location & Address</h2>

                    <div class='map-container'>
                        <iframe width="100%" height="180" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                                src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;q=Rainer+Ave,+Rowland+Heights,+Los+Angeles,+California+91748&amp;aq=&amp;sll=37.0625,-95.677068&amp;sspn=42.495706,93.076172&amp;t=m&amp;ie=UTF8&amp;geocode=FcByBgIdVe34-A&amp;split=0&amp;hq=&amp;hnear=Rainer+Ave,+Rowland+Heights,+Los+Angeles,+California+91748&amp;ll=33.977033,-117.904072&amp;spn=0.024912,0.036478&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe>
                    </div>
                    <div class='row'>
                        <div class='span3'>
                            <address>
                                <strong>Head Office</strong> <br/>
                                Reiner street 5, Los Angeles, CA 48523 <br/>
                                Phone: +32 (0)2 494 01 28 <br/>
                                Email: hidentica@gmail.com <br/>
                            </address>
                        </div>
                        <div class='span3'>
                            <address>
                                <strong>Representative</strong> <br/>
                                Winsont F. st. 10, New York, 48523 <br/>
                                Phone: +32 (0)2 494 01 28 <br/>
                                Email: hidentica@gmail.com <br/>
                            </address>
                        </div>
                    </div>
                </div>
            </div>





        </section>

        @if(!Auth::check())
        <section class='row profile-form' style="padding-top: 0; overflow: hidden;">
            <div class='span6'>
                <div class='login-form top-form'>
                    <h2>Login</h2>


                    <form method="POST"action="{{route("post.login")}}"  class='row'>
                        {{csrf_field()}}
                        <div class='span3'>
                            <input type="email" class='input-block-level' name='email' placeholder="Email"/>
                        </div>
                        <div class='span3'>
                            <input type="password" class='input-block-level' name='password' placeholder="Password"/>
                            <input type="submit" name='submit' value='Login' class='btn btn-primary'/>
                        </div>
                    </form>

                    <div >

                        <div class="">
                            <h2 style="margin-top: 16px;">Lupa Password</h2>

                            <form method="POST" action="{{route("post.requestReset")}}"  class='row'>
                                {{csrf_field()}}
                                <div class='span6'>
                                    <input type="email" class='input-block-level' name='email' placeholder="Email"/>

                                </div>

                                <div class=''>
                                    <input type="submit" name='submit' value='Reset Password' class='btn btn-primary'/>

                                </div>
                            </form>
                        </div>

                        <div>
                            <h2 style="margin-top: 16px;">Kirim Ulang Verifikasi</h2>

                            <form method="POST" action="{{route("post.resendVerification")}}"  class='row'>
                                {{csrf_field()}}
                                <div class='span6'>
                                    <input type="email" class='input-block-level' name='email' placeholder="Email"/>

                                </div>
                                <div class="span3">

                                </div>
                                <div class='span3'>
                                    <input type="submit" name='submit' value='Resend Verification' class='btn btn-primary'/>

                                </div>
                            </form>
                        </div>
                    </div>






                </div>
            </div>


            <div class='span6'>
                <div class='login-form top-form'>
                    <h2>Register</h2>

                    <form method="POST"action="{{route("post.register")}}" class='row'>
                        {{csrf_field()}}
                        <div class='span3'>
                            @php
                                $cities = App\Model\City::all()->sortBy("name")
                            @endphp
                            <input value="{{old('email')}}" required type="email" class='input-block-level' name='email' placeholder="Email"/>


                            <input value="{{old('password')}}" type="password" class='input-block-level' name='password' placeholder="Password"/>
                            <input value="{{old('passowrd_confirmation')}}" required type="password" class='input-block-level' name='password_confirmation' placeholder="Confirm Password"/>

                        </div>
                        <div class='span3'>
                            <input value="{{old('name')}}" required type="text" class='input-block-level' name='name' placeholder="Name"/>

                            <input value="{{old('telephone')}}" required type="text" class='input-block-level' name='telephone' placeholder="Telephone"/>
                            {{--<select value="{{old('city')}}" required type="select" class='input-block-level' name='city' placeholder="City">--}}
                                {{--@foreach($cities as $city)--}}
                                    {{--<option value="{{$city->name}}">{{ucwords($city->name)}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                            <input placeholder="Kota" id="city" name="city" style="width: 100%;" />
                            <input style="margin-top: 12px" required type="submit" name='submit' value='Register' class='btn btn-primary'/>
                        </div>
                    </form>




                </div>
            </div>
        </section>

        @else

                @php

                $user = Auth::user();
                $user->setDefaultPreference();
                @endphp

                <section class='row profile-form'>
                    <div class='span6'>
                        <div class='login-form top-form'>
                            <h2>{{$user->name}}</h2>

                            <p></p>
                            <form method="POST" action="{{route('logout')}}">
                                {{csrf_field()}}
                                <input style="float:left;" type="submit" value="logout">
                            </form>
                        </div>
                    </div>


                    <div class='span6'>

                    </div>
                </section>

        @endif

    </section>
</section>



{{--menu--}}
<header>
    <section class='container'>
        <section class='row'>
            {{--<div class='span3'>--}}
                {{--<figure class='logo'>--}}
                    {{--<a href="index-2.html">--}}
                        {{--<img src="img/logo.png" alt=""/>--}}
                    {{--</a>--}}
                {{--</figure>--}}
            {{--</div>--}}
            <div class='span9'>
                <nav class='main-nav'>
                    <ul>
                        <li><a href="{{route('get.index')}}">Home</a></li>
                        {{--<li class=''><a href="about.html">About</a></li>--}}
                        {{--<li>--}}
                            {{--<a href="property.html">Property</a>--}}
                            {{--<ul class='dropdown-menu'>--}}
                                {{--<li class='first-element'><a href="search-location.html">For Sale</a></li>--}}
                                {{--<li class='dropdown-submenu'>--}}
                                    {{--<a href="search-list.html"></a>--}}
                                    {{--<ul class='dropdown-menu'>--}}
                                        {{--<li class='first-element'><a href="search-grid-no-form.html">Sub menu item 1</a></li>--}}
                                        {{--<li><a href="search-grid.html">Sub menu item 2</a></li>--}}
                                        {{--<li><a href="search-grid.html">Sub menu item 3</a></li>--}}
                                        {{--<li class='last-element'><a href="search-grid.html">Sub menu item 4</a></li>--}}
                                    {{--</ul>--}}
                                {{--</li>--}}
                                {{--<li class='dropdown-submenu'>--}}
                                    {{--<a href="search-location.html">Forclosures</a>--}}
                                    {{--<ul class='dropdown-menu'>--}}
                                        {{--<li class='first-element'><a href="search-grid.html">Sub menu item 1</a></li>--}}
                                        {{--<li><a href="search-grid-no-form.html">Sub menu item 2</a></li>--}}
                                        {{--<li><a href="search-grid-no-form.html">Sub menu item 3</a></li>--}}
                                        {{--<li class='last-element'><a href="search-grid.html">Sub menu item 4</a></li>--}}
                                    {{--</ul>--}}
                                {{--</li>--}}
                                {{--<li class='last-element'><a href="search-grid-no-form.html">New Homes</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="agents.html">Agents</a>--}}
                            {{--<ul class='dropdown-menu'>--}}
                                {{--<li><a href="agent.html">Single agent</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="blog.html">Blog</a>--}}
                            {{--<ul class='dropdown-menu'>--}}
                                {{--<li><a href="post.html">Single post</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="search-grid-no-form.html">Search</a>--}}
                            {{--<ul class='dropdown-menu'>--}}
                                {{--<li><a href="search-grid-no-form.html">Search grid no form</a></li>--}}
                                {{--<li><a href="search-grid.html">Search grid with form</a></li>--}}
                                {{--<li><a href="search-list.html">Search list</a></li>--}}
                                {{--<li><a href="search-location.html">Search with location</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}



                        @if(Auth::check())
                            <li>
                                <a href="{{route('get.myRoom')}}">Atur Ruangan</a>

                            </li>

                            <li>
                                <a href="{{route('get.myAdvertisement')}}">Atur Iklan</a>

                            </li>

                            <li>
                                <a href="{{route('get.advertisementPayment')}}">Konfirmasi pembayaran Iklan</a>

                            </li>
                            <li><a href="{{route('get.myProfile')}}">{{Auth::user()->name}}</a>

                            </li>
                            <span style="display:inline-block;color:rgba(255,255,255,0.5);font-weight: bold;padding: 16px 8px 0px" class="custom-tooltip"></span>

                            <form style="margin: 7px 0 0 0;display:inline-block" method="POST" action="{{route('logout')}}">
                                {{csrf_field()}}
                                <input style="background:transparent; height: 100%; border:none;shadown:none;outline: none; color: tomato;font-weight: bold;margin-top: -4px;" type="submit" value="logout">
                            </form>

                        @endif



                    </ul>
                </nav>
            </div>
            <div class='span3'>
                <div class='header-buttons'>
                    {{--<a href="#" class='' >Add</a>--}}
                    @if(!Auth::check())
                        {{--<a href="#" class='profile custom-tooltip' title="Go to My Profile">Profile</a>--}}
                        <a href="#" class='profile custom-tooltip' title="Go to My Profile">Profile</a>

                    @endif

                    {{--<a href="#" class='contact custom-tooltip' title='Got to Contact Form'>Contact</a>--}}
                </div>
            </div>
        </section>
    </section>
</header>

{{--{{json_encode(Session::get("dangerNotification"))}}--}}


@if($errors->any() || Session::has('dangerNotification') )
    <div class="alert alert-danger text-center">
        <ul>
            @if ($errors->any())

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            @endif
                {{--{{json_encode(Session::get("dangerNotification"))}}--}}

            @if(Session::has('dangerNotification'))
                    <li>{{Session::get('dangerNotification')}}</li>
            @endif
        </ul>

    </div>

@endif


@if(Session::has('successNotification'))
<div class="alert alert-success text-center">
    <ul>
        {{--{{json_encode(Session::get("dangerNotification"))}}--}}

            <li>{{Session::get('successNotification')}}</li>


    </ul>
</div>
@endif

