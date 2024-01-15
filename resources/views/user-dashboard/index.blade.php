<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />
    <title>Chat</title>
    <!-- Include Laravel Echo CDN with Babel transpilation -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.3/dist/echo.iife.js"></script>
    <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script> --}}



</head>

<body>

    <section style="background-color: #eee;">
        <div class="container py-5">

            <div class="row">
                <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">
                    <h5 class="font-weight-bold mb-3 text-center text-lg-start">Member</h5>
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                @foreach ($user as $u )
                                @if(Auth::user()->id === $u->id)
                                @else
                                <li class="p-2 border-bottom" style="background-color: #eee;">
                                    <a href="{{ url('/chat-page?id='.$u->id) }}" class="d-flex justify-content-between">
                                        <div class="d-flex flex-row">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-8.webp"
                                                alt="avatar"
                                                class="rounded-circle d-flex align-self-center me-3 shadow-1-strong"
                                                width="60">
                                            <div class="pt-1">
                                                <p class="fw-bold mb-0">{{ $u->name }}</p>
                                                <p class="small text-muted">Hello, Are you there?</p>
                                            </div>
                                        </div>
                                        <div class="pt-1">
                                            <p class="small text-muted mb-1">Just now</p>
                                            <span class="badge bg-danger float-end">1</span>
                                        </div>
                                    </a>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                         <a href="{{ url('/logout') }}">logout</a>
                        </div>
                    </div>

                </div>

                <div class="col-md-6 col-lg-7 col-xl-8">

                    <ul class="list-unstyled" id="messages">
                        <li class="d-flex justify-content-between mb-4">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar"
                                class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between p-3">
                                    <p class="fw-bold mb-0">Brad Pitt</p>
                                    <p class="text-muted small mb-0"><i class="far fa-clock"></i> 12 mins ago</p>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut
                                        labore et dolore magna aliqua.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex justify-content-between mb-4">
                            <div class="card w-100">
                                <div class="card-header d-flex justify-content-between p-3">
                                    <p class="fw-bold mb-0">Lara Croft</p>
                                    <p class="text-muted small mb-0"><i class="far fa-clock"></i> 13 mins ago</p>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">
                                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                        doloremque
                                        laudantium.
                                    </p>
                                </div>
                            </div>
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-5.webp" alt="avatar"
                                class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                        </li>
                        <li class="d-flex justify-content-between mb-4">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between p-3">
                                    <p class="fw-bold mb-0">Brad Pitt</p>
                                    <p class="text-muted small mb-0"><i class="far fa-clock"></i> 10 mins ago</p>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut
                                        labore et dolore magna aliqua.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div id="message-container"></div>
                        </li>
                        <li class="bg-white mb-3">
                            <div class="form-outline">
                                <label class="form-label" for="textAreaExample2">Message</label>
                                <input type="text" id="messageInput" name="messageInput" class="form-control">
                            </div>
                        </li>
                        <button type="button" onclick="sendMessage()"
                            class="btn btn-info btn-rounded float-end">Send</button>
                    </ul>

                </div>

            </div>

        </div>
    </section>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
    <script>
        function sendMessage() {
            var message = document.getElementById('messageInput').value;
            var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

            var data = {
                message: message
            };

            fetch('/send-message', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(responseData => {
                    console.log(responseData);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.3/dist/echo.iife.js"></script>
    <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
    <script>
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '6a4779b6347a42b898b0',
            cluster: 'ap2',
            encrypted: true,
        });
    </script>
    <script>
        window.Echo.channel('chat')
            .listen('MessageSent', (event) => {
                console.log('User:', event.user);
                console.log('Message Content:', event.message);

                if (event.success) {
                    console.log('Message successfully processed.');
                    const messageElement = displayMessage(event.user, event.message);
                    const messageContainer = document.getElementById('messages');
                    messageContainer.appendChild(messageElement);

                    messageContainer.scrollTop = messageContainer.scrollHeight;
                } else {
                    console.error('Error processing message.');
                }
            });

        function displayMessage(userName, messageContent) {
            const li = document.createElement('li');
            li.classList.add('d-flex', 'justify-content-between', 'mb-4');

            const card = document.createElement('div');
            card.classList.add('card');

            const cardHeader = document.createElement('div');
            cardHeader.classList.add('card-header', 'd-flex', 'justify-content-between', 'p-3');

            const userParagraph = document.createElement('p');
            userParagraph.classList.add('fw-bold', 'mb-0');
            userParagraph.textContent = userName;

            const cardBody = document.createElement('div');
            cardBody.classList.add('card-body');

            const contentParagraph = document.createElement('p');
            contentParagraph.classList.add('mb-0');
            contentParagraph.textContent = messageContent;

            cardHeader.appendChild(userParagraph);
            cardBody.appendChild(contentParagraph);
            card.appendChild(cardHeader);
            card.appendChild(cardBody);
            li.appendChild(card);

            return li;
        }
    </script>
</body>

</html>
