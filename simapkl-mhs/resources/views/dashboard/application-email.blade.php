<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lamaran Baru</title>
</head>
<body>
    <h1>Lamaran Baru</h1>
    
    @if(session('success'))
        <div style="color: green; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="color: red; margin-bottom: 20px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('send.email') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 15px;">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="{{ $email }}" readonly required>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" value="{{ $subject }}" readonly required>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="content">Content:</label>
            <textarea name="email_message" id="content" placeholder="Enter Content" rows="6" cols="50" required></textarea>
        </div>

        <button type="submit" style="background-color: #2563eb; color: white; padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer;">
            Kirim Lamaran
        </button>
        
        <a href="{{ url()->previous() }}" style="background-color: #6b7280; color: white; padding: 12px 24px; text-decoration: none; border-radius: 8px; margin-left: 10px;">
            Kembali
        </a>
    </form>
</body>
</html>