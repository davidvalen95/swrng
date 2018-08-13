@extends('master.master')


@section('content')
    <div class='contact-box-content'>
        <div class='inner'>
            <div class="span3">

            </div>
            <div class='span6'>
                <div class="text-center">
                    <p>Hallo {{$user->name}}</p>
                    <h3>Ubah password</h3>

                </div>

                @php

                        @endphp
                <form enctype="multipart/form-data" action="{{route('post.resetPassword')}}" method="post">
                    {{csrf_field()}}


                    @foreach($forms as $form)
                        {!! $form->getOutput() !!}
                    @endforeach

                    <div style="margin-bottom: 16px;" id="attachment-container">

                    </div>

                    <button class="btn btn-success " type="submit" value="Kumpul / Submit">Kumpul / Submit</button>

                </form>


            </div>

        </div>
    </div>

@endsection