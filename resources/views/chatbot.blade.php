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
                <div class="overflow-auto" id="chatbox" style="height:320px;width:100%">
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
                    <p>Sender</p>
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
                        <p>Jawaban</p>
                        <p>${jsonRes.answer}</p>
                    </div>
                </div>
                <div class="col-6"></div>
            </div>`;
            questionBox.value = "";
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
