

@php

    /** @var App\Model\Advertistment $advertisement */

@endphp

<div class='description-box' rel='2'>
    <div class='contact-box'>
        <div class='title-bar'>
            <div class='inner'  style="border:0px !important;" >

                <h2>{{$isEdit ? "Edit iklan untuk $advertisement->link"  : "Silahkan isi form di bawah ini untuk menambahkan iklan baru"}}</h2>
                <p></p>
            </div>
        </div>
        <div class='contact-box-content'>
            <div class='inner'>
                <div class=''>


                    @include('advertisement.myAdvertisement.rule')
                    @php

                            @endphp
                    <form enctype="multipart/form-data" action="{{route('post.advertisementForm')}}" method="post">
                        {{csrf_field()}}


                        @foreach($forms as $form)
                            {!! $form->getOutput() !!}
                        @endforeach

                        <div style="margin-bottom: 16px;" id="attachment-container">

                        </div>

                        {{--<p>{!! captcha_img() !!}</p>--}}
                        {{--<label>Captcha</label>--}}
                        {{--<p><input required type="text" name="captcha"></p>--}}

                        @if($isEdit && $advertisement->getIsActive())
                            <p style="color:tomato;">*Iklan saat ini sedang status aktif, tidak dapat diedit</p>

                        @else
                            <button class="btn btn-success " type="submit" value="Kumpul / Submit">Kumpul / Submit</button>

                        @endif

                    </form>


                </div>
                {{--<div class='half'>--}}
                {{--<div class='custom-multiple-select-filters'>--}}
                {{--<span>Select: </span>--}}
                {{--<ul>--}}
                {{--<li><a href="#" class='all'>All</a></li>--}}
                {{--<li>|</li>--}}
                {{--<li><a href="#" class='featured'>Featured</a></li>--}}
                {{--<li>|</li>--}}
                {{--<li><a href="#" class='none'>None</a></li>--}}
                {{--</ul>--}}
                {{--</div>--}}
                {{--<div class='custom-multiple-select'>--}}
                {{--<select multiple='multiple'>--}}
                {{--<option rel='1' value="1">Hello 1</option>--}}
                {{--<option rel='2' value="2">Hello 2</option>--}}
                {{--<option rel='3' value="3">Hello 3</option>--}}
                {{--<option rel='4' value="4">Hello 4</option>--}}
                {{--<option rel='5' value="5">Hello 5</option>--}}
                {{--<option rel='6' value="6">Hello 6</option>--}}
                {{--<option rel='7' value="7">Hello 7</option>--}}
                {{--<option rel='8' value="8">Hello 8</option>--}}
                {{--</select>--}}
                {{--<ul>--}}
                {{--<li rel='1' class='featured'>--}}
                {{--<div class='inner-list'>--}}
                {{--<strong>Andrews - Cowley, OX4</strong> <br />--}}
                {{--<span>01865 360070</span>--}}
                {{--</div>--}}
                {{--</li>--}}
                {{--<li rel='2'>--}}
                {{--<div class='inner-list'>--}}
                {{--<strong>Andrews - Cowley, OX4</strong> <br />--}}
                {{--<span>01865 360070</span>--}}
                {{--</div>--}}
                {{--</li>--}}
                {{--<li rel='3' class='featured'>--}}
                {{--<div class='inner-list'>--}}
                {{--<strong>Andrews - Cowley, OX4</strong> <br />--}}
                {{--<span>01865 360070</span>--}}
                {{--</div>--}}
                {{--</li>--}}
                {{--<li rel='4'>--}}
                {{--<div class='inner-list'>--}}
                {{--<strong>Andrews - Cowley, OX4</strong> <br />--}}
                {{--<span>01865 360070</span>--}}
                {{--</div>--}}
                {{--</li>--}}
                {{--<li rel='5' class='featured'>--}}
                {{--<div class='inner-list'>--}}
                {{--<strong>Andrews - Cowley, OX4</strong> <br />--}}
                {{--<span>01865 360070</span>--}}
                {{--</div>--}}
                {{--</li>--}}
                {{--<li rel='6' class='featured'>--}}
                {{--<div class='inner-list'>--}}
                {{--<strong>Andrews - Cowley, OX4</strong> <br />--}}
                {{--<span>01865 360070</span>--}}
                {{--</div>--}}
                {{--</li>--}}
                {{--<li rel='7'>--}}
                {{--<div class='inner-list'>--}}
                {{--<strong>Andrews - Cowley, OX4</strong> <br />--}}
                {{--<span>01865 360070</span>--}}
                {{--</div>--}}
                {{--</li>--}}
                {{--<li rel='8'>--}}
                {{--<div class='inner-list'>--}}
                {{--<strong>Andrews - Cowley, OX4</strong> <br />--}}
                {{--<span>01865 360070</span>--}}
                {{--</div>--}}
                {{--</li>--}}
                {{--</ul>--}}
                {{--</div>--}}
                {{--<input type="submit" class='btn btn-primary btn-large pull-right' value='Send Message'/>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</div>



@section('js')
    <script>
        $(document).ready(function(){
            var idAttachment = {{isset($advertisement) ? $advertisement->getPhoto->count() - 1 : 0}};
            var total = {{isset($advertisement) ? $advertisement->getPhoto->count() - 1 : 0}};

            if(total >= 2){
                $('#add-attachment').hide();
            }

            $("#add-attachment").on('click',function(){
                $("#attachment-container").append("<div id='attachment-"+idAttachment +"'>" +
                    "<label>Upload Gambar (Max 5000KB)</label>" +
                    "<input type='file' name='photo[]'/>" +

                    "<button type='button' class='btnErase btn btn-danger' data-idtarget='attachment-"+idAttachment++ +"' >Hapus</button>" +
                    "</div>" +
                    "")
                total++;
                if(total > 2){
                    $(this).hide();
                }
            })

            $(document).on('click','.btnErase',function(){
                var target = $(this).data('idtarget');
                // alert(target);
                total--;
                if(total <=2){
                    $('#add-attachment').show();
                }
                $('#'+target).remove();
            })
        })

    </script>
@endsection
