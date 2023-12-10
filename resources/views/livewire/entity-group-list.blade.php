<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Entity-Groups') }}
        </h2>
    </x-slot>

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
                                            <tr>
                                                <td
                                                    class="bg-gray-50 text-left text-xs font-medium text-gray-500 tracking-wider center-content w-0.5 center-content py-0.5 px-2">
                                                    {{ $entity->name }}
                                                </td>
                                                @foreach ($grouplist as $group)
                                                    <td class="px-1 py-1 whitespace-nowrap text-sm text-gray-900">
                                                        <input class="form-checkbox text-green-600  cursor-pointer"
                                                            wire:model="arr_entity_groups.{{ $entity->id }}.{{ $group->id }}"
                                                            name="arr_entity_groups.{{ $entity->id }}.{{ $group->id }}"
                                                            type="checkbox" value="{{ $group->group_id }}"
                                                            id="{{ $group->descr }}"
                                                            @isset($arr_entity_groups[$entity->id][$group->id]) @if ($arr_entity_groups[$entity->id][$group->id] == 'true') checked @endif @endisset>

                                                    </td>
                                                @endforeach


                                                <td
                                                    class="px-2 py-0.5 whitespace-nowrap text-sm font-medium text-center">
                                                    @if (is_null($entity?->groups?->first()?->id))
                                                    @else
                                                        <a href="{{ route('entitygroupsold.show', $entity?->groups?->first()?->id) }}"
                                                            class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a>
                                                        <a href="{{ route('entitygroupsold.edit', $entity?->groups?->first()?->id) }}"
                                                            class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Edit</a>
                                                        <form class="inline-block"
                                                            action="{{ route('entitygroupsold.destroy', $entity?->groups?->first()?->id) }}"
                                                            method="POST" onsubmit="return confirm('Are you sure?');">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}">
                                                            <input type="submit"
                                                                class="text-red-600 hover:text-red-900 mb-2 mr-2"
                                                                value="Delete">
                                                        </form>
                                                    @endif

                                                </td>
                                            </tr>
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

</div>
