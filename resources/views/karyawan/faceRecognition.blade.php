@extends('templates.app')
@section('container')
    <div id="app-wrap" class="style1">
        <div class="tf-container">
            <input type="hidden" name="username" id="username" value="{{ auth()->user()->username }}">
            <div class="row mt-4">
                <video id="video" autoplay playsinline class="col-lg-12 col-md-12 col-sm-12 mx-auto" style="border-radius: 100%;"></video>
            </div>
        </div>
    </div>

    <div class="bottom-navigation-bar st2 bottom-btn-fixed" style="bottom:65px">
        <div class="tf-container">
            <div class="row">
                <div class="col-12">
                    <button  id="capture" class="tf-btn accent large">Save</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>

    @push('script')
        <script src="{{ url('/face/dist/face-api.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            let video = document.getElementById("video");
            let width = 640;
            let height = 480;

            const startStream = () => {
                navigator.mediaDevices.getUserMedia({
                    video: { facingMode: "user", width, height },
                    audio: false
                }).then((stream) => {
                    video.srcObject = stream;
                });
            }

            Promise.all([
                faceapi.nets.tinyFaceDetector.loadFromUri("{{ url('/face/weights') }}"),
                faceapi.nets.faceLandmark68Net.loadFromUri("{{ url('/face/weights') }}"),
                faceapi.nets.faceRecognitionNet.loadFromUri("{{ url('/face/weights') }}")
            ]).then(startStream);

            $(document).ready(function(){
                const descriptions = [];

                $("#capture").click(async function(){
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Detecting face, please wait.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });

                    var username = $('#username').val();
                    const label = username;

                    var canvas = document.createElement('canvas');
                    canvas.width = width;
                    canvas.height = height;
                    var context = canvas.getContext('2d');
                    context.drawImage(video, 0, 0, width, height);

                    var img = document.createElement('img');
                    img.src = canvas.toDataURL('image/png');

                    const detections = await faceapi.detectSingleFace(img, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceDescriptor();

                    if(detections) {
                        descriptions.push(detections.descriptor);
                        var descrip = descriptions;

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type : 'POST',
                            url : "{{ url('/pegawai/face/ajaxPhoto') }}",
                            data :  {image: img.src ,path: username},
                            cache : false,
                            success: function(msg){
                                console.log(msg);
                            },
                            error: function(data){
                                console.log('error:', data);
                            }
                        });

                        var postData = new faceapi.LabeledFaceDescriptors(label, descrip);
                        $.ajax({
                            type : 'POST',
                            url : "{{ url('/pegawai/face/ajaxDescrip') }}",
                            data :  { myData: JSON.stringify(postData), user_id:{{ auth()->user()->id }} },
                            datatype : 'json',
                            cache : false,
                            success: function(msg){
                                Swal.fire('Berhasil Daftar Wajah!', '', 'success');
                                setTimeout(function() {
                                    window.location.href = "{{ url('/dashboard') }}";
                                }, 2000);
                            },
                            error: function(data){
                                console.log('error:', data);
                            }
                        });
                    } else {
                        Swal.fire('Gagal Deteksi Wajah!', 'Silakan coba lagi.', 'error');
                    }
                });
            });
        </script>
    @endpush
@endsection

