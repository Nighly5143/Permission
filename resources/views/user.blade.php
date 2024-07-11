<x-app-layout>
    <div class="container mx-auto py-6">
        <div class="button mb-4">
            @can('create user')
            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                Add User
            </button>
            @endcan
        </div>

        <div class="table-list mt-3">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 bg-gray-800 text-white border">ID</th>
                        <th class="py-2 px-4 bg-gray-800 text-white border">Name</th>
                        <th class="py-2 px-4 bg-gray-800 text-white border">Email</th>
                        <th class="py-2 px-4 bg-gray-800 text-white border">Password</th>
                        <th class="py-2 px-4 bg-gray-800 text-white border">...</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-100">
                        <td class="border px-4 py-2">{{ $user->id }}</td>
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                        <td class="border px-4 py-2">{{ $user->email }}</td>
                        <td class="border px-4 py-2">{{ $user->password }}</td>
                        <td class="border px-4 py-2">
                            {{-- edit --}}
                            @can('edit user')
                            <a href="{{ route('users.edit', $user) }}" class="py-2 px-6 whitespace-nowrap text-sm text-gray-900 bg-green-200 rounded">
                                Edit
                            </a>
                            @endcan

                            @can('delete user')
                            <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="py-1.5 px-4 whitespace-nowrap text-sm text-gray-900 bg-red-200 rounded">
                                    Delete
                                </button>
                            </form>
                            @endcan
                        </td>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header flex justify-between">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create User</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
