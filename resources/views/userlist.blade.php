<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-6">
        <div class="table-list mt-3">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 bg-gray-800 text-white border">ID</th>
                        <th class="py-2 px-4 bg-gray-800 text-white border">Name</th>
                        <th class="py-2 px-4 bg-gray-800 text-white border">Email</th>
                        <th class="py-2 px-4 bg-gray-800 text-white border">Password</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-100">
                        <td class="border px-4 py-2">{{ $user->id }}</td>
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                        <td class="border px-4 py-2">{{ $user->email }}</td>
                        <td class="border px-4 py-2">{{ $user->password }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="button flex justify-end mt-4">
            <form action="{{ route('users.download-excel' )}}" method="POST" target="_blank">
                @csrf
                <button type="submit" class="font-bold bg-green-700 text-white py-2 px-4 rounded shadow">Export Excel</button>
            </form>
        </div>
    </div>
</body>
</html>
