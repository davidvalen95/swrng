

@php

/** @var App\Model\Room $room */

@endphp
<div class='description-box' rel='2'>
    <div class='contact-box'>
        <div class='title-bar'>
            <div class='inner'  style="border:0px !important;" >

                <h2>{{$isEdit ? "Edit $room->roomName - $room->buildingName" : "Silahkan isi form di bawah ini untuk menambahkan ruangan baru"}}</h2>
                <p>Isi data ruangan selengkap-lengkapnya agar informatif. Masukan foto terbaik agar menarik.</p>
            </div>
        </div>
        <div class='contact-box-content'>
            <div class='inner'>
                <div class=''>


                    @php

                    @endphp
                    <form id="parentForm" enctype="multipart/form-data" action="{{route('post.addRoom')}}" method="post">
                        {{csrf_field()}}
                        {{--<label for="contact-name">Your Name</label>--}}
                        {{--<input type="text" name='contact-name' placeholder="John Smith" id='contact-name' class='input-block-level'/>--}}
                        {{--<label for="contact-message">Your Message</label>--}}
                        {{--<textarea name="contact-message" id="contact-message" class='input-block-level' rows="10" placeholder="Your message"></textarea>--}}
                        {{--<label for="contact-phone">Your Phone</label>--}}
                        {{--<input type="tel" name='contact-phone' placeholder="(XXX) XXX - XX - XX" id='contact-phone' class='input-block-level'/>--}}
                        {{--<label for="contact-email">Your Email</label>--}}
                        {{--<input type="email" name='contact-email' placeholder="example@example.com" id='contact-email' class='input-block-level'/>--}}
                        {{--<label class="checkbox">--}}
                            {{--<input type="checkbox"> Keep me informed on property market updates--}}
                        {{--</label>--}}

                        @foreach($forms as $form)
                            {!! $form->getOutput() !!}
                        @endforeach


                        @if($isEdit)
                            @foreach($room->getPhotos->where('isMain',false)->all() as $currentPhoto)
                            <div id="photo{{$currentPhoto->id}}" style="margin-bottom: 12px; ">
                                <img style="max-height: 150px;" src="{{$currentPhoto->getSmall()}}"/>
                                <br/>
                                <button data-parrent="photo{{$currentPhoto->id}}" class="deletePhotoFromServer btn btn-danger" data-id="{{$currentPhoto->id}}" type="button">Hapus</button>
                            </div>
                            @endforeach
                        @endif

                        <div style="margin-bottom: 16px;" id="attachment-container">

                        </div>
                        <button style='margin-bottom:16px;display:inline-block' id="add-attachment" class="btn btn-primary" type="button" value="Tambah Gambar">Tambah Gambar</button>

                        {{--<p>{!! captcha_img() !!}</p>--}}
                        {{--<label>Captcha</label>--}}
                        {{--<p><input required type="text" name="captcha"></p>--}}

                        <br/>
                        <button class="btn btn-success " type="submit" value="Tambah ruangan">Kumpul / Submit</button>

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

            $('.deletePhotoFromServer').on('click',function(){
                var id = $(this).data('id');
                // alert(id);


                $('#parentForm').append(`<input hidden name='deletePhoto[]' value="${id}"/>`);
                $(this).parent().remove();

            })
            function deletePhotoFromServer(id){
            }

            var idAttachment = {{isset($room) ? $room->getPhotos->where('isMain',false)->count() - 1 : 0}};
            var total = 0;

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
