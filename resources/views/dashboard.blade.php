<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        @if(auth()->check())
                            <strong>{{ __("User Role") }} :</strong>
                            @role('admin')
                                Administrator
                            @else
                                @role('manager')
                                    Manager
                                @else
                                    User
                                @endrole
                            @endrole

                            <table class="table table-bordered">
                                <tbody>
                                    <th>{{ __("Permissions") }} :</th>
                                    <td>
                                        @forelse(auth()->user()->getPermissionsViaRoles() as $permission)
                                            <span class="badge badge-success">{{ ucwords($permission->name) }},</span>
                                        @empty
                                            <span class="badge badge-warning">No permissions</span>
                                        @endforelse
                                    </td>
                                </tbody>
                            </table>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                    @role('admin')


                        <div class="flex justify-center items-center">
                            <div class="flex-center image-spacing">
                                <div class="text-center">

                   <a href="users/index">                 <img src="{{ asset('9131529.png') }}" alt="User Icon" class="mx-auto" width="300" height="300">
                                    <p class="mt-2">User</p></a>
                                </div>
                            </div>
                            @endrole
                            <div class="border-l-2 border-black-500 image-spacing"></div>

                            <div class="flex-center image-spacing">
                                <div class="text-center">
                                    <!-- Task Icon -->
                              <a href="tasks/index">     <img src="{{ asset('8028200.png') }}" alt="Task Icon" class="mx-auto" width="300" height="300">
                                    <p class="mt-2">Tasks</p></a>

                                </div>
                            </div>
                        </div>



            </div>
        </div>
    </div>



</x-app-layout>


