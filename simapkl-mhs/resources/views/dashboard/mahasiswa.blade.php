<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>


    <form action="{{ route('logout.mahasiswa') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
</html>