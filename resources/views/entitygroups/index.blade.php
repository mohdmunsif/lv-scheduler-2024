<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Entity-Groups') }}
        </h2>
    </x-slot>
    <div>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                                    <table class="min-w-full divide-y divide-gray-200 w-full">

                                        <thead>
                                            <tr>
                                                <th scope="col" width="50"
                                                    class="px-2 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Name
                                                </th>
                                                @for ($i = 0; $i < $grouplist->count(); $i++)
                                                    <th scope="col" width="50"
                                                        class="px-2 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        {{ $i + 1 }}
                                                    </th>
                                                @endfor
                                                <th scope="col" width="200" class="px-2 py-3 bg-gray-50">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($entities as $entity)
                                                @include('entitygroups/onerow', $entity)
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</x-app-layout>
Dashboard
