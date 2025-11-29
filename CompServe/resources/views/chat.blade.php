{{-- <!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token"
        content="{{ csrf_token() }}">
    <title>Chat</title>
    @vite(['resources/js/chat.js'])
</head>

<body>
    <h1>Chat</h1>

    <div id="log"></div>

    <input type="text"
        id="message">
    <button
        onclick="sendMessage(2, document.getElementById('message').value)">Send
        to User 2</button>

    <script>
        window.userId = {{ auth()->id() }};
    </script>
</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Chat with {{ $recipient->name }}</title>
    <meta name="csrf-token"
        content="{{ csrf_token() }}">
    <style>
        #chat-box {
            border: 1px solid #ccc;
            height: 400px;
            overflow-y: auto;
            padding: 10px;
        }

        .message {
            margin-bottom: 8px;
        }

        .from-me {
            text-align: right;
            color: blue;
        }

        .from-them {
            text-align: left;
            color: green;
        }
    </style>
</head>

<body>
    <h2>Chat with {{ $recipient->name }}</h2>

    <div id="chat-box">
        @foreach ($messages as $message)
            <div
                class="message {{ $message->from_id == auth()->id() ? 'from-me' : 'from-them' }}">
                <strong>{{ $message->from_id == auth()->id() ? 'Me' : $recipient->name }}:</strong>
                {{ $message->message }}
            </div>
        @endforeach
    </div>

    <input type="text"
        id="message-input"
        placeholder="Type a message..."
        style="width: 80%;">
    <button id="send-btn">Send</button>

    <script>
        window.userId = {{ auth()->id() }};
        window.recipientId = {{ $recipient->id }};
        window.recipientName = "{{ $recipient->name }}";
    </script>

    @vite(['resources/js/chat.js'])
</body>

</html>
