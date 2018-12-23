@php
    /**
        @var CForm $form;
        @var CForm[] $forms;
    */

@endphp

@extends('master.master')


@section('content')

    <div class="span8 center-block inner " style="float:none;background: white; padding: 20px; margin: 20px auto; display: block;" >
        <form enctype="multipart/form-data" action="{{route('post.advertisementPayment')}}" method="post">
            {{csrf_field()}}


            @foreach($forms as $form)
                {!! $form->getOutput() !!}
            @endforeach

            <div style="margin-bottom: 16px;" id="attachment-container">

            </div>

            <p>{!! captcha_img() !!}</p>
            <label>Captcha</label>
            <p><input required type="text" name="captcha"></p>
            <button class="btn btn-success " type="submit" value="Kumpul / Submit">Kumpul / Submit</button>

        </form>
    </div>



@endsection