<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
           <div>      @if(auth()->check())
                                 <strong>   {{ __("User Role") }} :</strong>

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
                                </tr>
                            </tbody>
                        </table>
                    @endif
                </div>

                </div>


            </div>
        </div>
    </div>
</x-app-layout>
