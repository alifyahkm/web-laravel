@extends('layouts.app')
@push('styles')
    <style>
        #launchBtn {
            bottom: 100px;
            right: 80px;
            positison: fixed;
            border-radius: 100%;
        }

        .senderContainer {
            width: 100%;
            margin-bottom: 30px;

        }

        .senderText {
            background-color: #8D775F;
            color: white;
            font-size: 14px;
            border-radius: 20px;
        }

        .chatSender {
            font-weight: bold;
        }

        /*Bagian jawaban*/
        .answerContainer {
            width: 100%;

            margin-bottom: 30px;
        }

        .answerText {
            background-color: #F1F0CC;

            color: black;

            font-size: 14px;
            border-radius: 20px;
        }

        /*Bagian input pertanyaan*/


        main {
            background-color: #F1F0CC;

        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <p class="text-center">
                    Chatbot Layanan Akademik
                </p>
            </div>
            <div class="card-body p-2">
                <div id="chatbox" style="height:320px;width:100%;overflow-y:auto">
                    <div class="row answerContainer">
                        <div class="col-6 answerText ms-4">
                            <div>
                                <p>AkaBot</p>
                                <p>Selamat datang di Chatbot Layanan Akademik, disini kamu dapat bertanya informasi seputar:
                                </p>
                                <ol>
                                    <li>Jadwal Mata Kuliah dan Ruang Kelas</li>
                                    <li>Ruangan dan Jadwal Ujian Semester</li>
                                    <li>Cetak Kartu Ujian</li>
                                    <li>Kuliah Hybrid</li>
                                    <li>Nilai Akademik</li>
                                    <li>Masa Registrasi</li>
                                    <li>Pengajuan Cuti Kuliah</li>
                                    <li>SKS Mata Kuliah</li>
                                    <li>Beasiswa</li>
                                    <li>Kalender Akademik</li>
                                    <li>TAK</li>
                                    <li>Tes Bahasa</li>
                                    <li>Score Tes Bahasa</li>
                                    <li>Input Nilai Tes Bahasa dari Instansi Luar</li>
                                    <li>Program Studi</li>
                                    <li>Biaya Pendidikan</li>
                                    <li>Kelas Internasional</li>
                                    <li>Pendaftaran Mahasiswa</li>
                                    <li>Seleksi Mahasiswa</li>
                                    <li>Asrama Telkom</li>
                                    <li>Virtual Tour</li>
                                    <li>Dosen</li>
                                    <li>Ujian Susulan</li>
                                    <li>Kerja Praktek</li>
                                    <li>Kelengkapan Tugas Akhir</li>
                                    <li>Sidang Akhir</li>
                                    <li>SK TA/PA</li>
                                </ol>
                            </div>
                        </div>
                        <div class="col-6"></div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row w-100" id="inputContainer">
                    <div class="col-9">
                        <input type="text" class="form-control" id="question">
                    </div>
                    <div class="col-3">
                        <button class="btn btn-outline-warning w-100" id="send">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
        const questionBox = document.getElementById("question");
        const chatBox = document.getElementById("chatbox");

        const sendBtn = document.getElementById("send");


        const sendMessage = async () => {
            if (questionBox.value == "") {
                return
            }
            const data = {
                "question": questionBox.value
            }
            chatBox.innerHTML += `
        <div class="row senderContainer">
            <div class="col-6"></div>
            <div class="col-6 d-flex justify-content-between senderText">
                <div>
                    <p>Guest</p>
                    <p>${questionBox.value}</p>
                </div>
            </div>
        </div>`;
            const response = await fetch('http://localhost:5000/chatbot', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const jsonRes = await response.json();



            chatBox.innerHTML += `
            <div class="row answerContainer">
                <div class="col-6 answerText ms-4">
                    <div>
                        <p>AkaBot</p>
                        <p>${jsonRes.answer}</p>
                    </div>
                </div>
                <div class="col-6"></div>
            </div>`;
            questionBox.value = "";
            chatBox.lastChild.scrollIntoView(false)
        }
        sendBtn.addEventListener("click", () => {
            sendMessage();
        });

        questionBox.addEventListener("keypress", (event) => {
            if (event.keyCode === 13) { // key code of the keybord key
                sendMessage();
                // your code to Run
            }
        });
    </script>
@endsection
