<tr>
    <td
        class="bg-gray-50 text-left text-xs font-medium text-gray-500 tracking-wider center-content w-0.5 center-content py-0.5 px-2">
        {{ $entity->name }}
    </td>
    @foreach ($grouplist as $group)
        <td class="px-1 py-1 whitespace-nowrap text-sm text-gray-900">
            <input class="form-checkbox text-green-600  cursor-pointer" name="groups[]" type="checkbox"
                value="{{ $group->group_id }}  id="{{ $group->descr }}"
                @isset($entity) @if (in_array($group->id, $entity?->groups?->pluck('id')?->toArray())) checked @endif @endisset>
        </td>
    @endforeach

    <td class="px-2 py-0.5 whitespace-nowrap text-sm font-medium text-center">

        @if (is_null($entity?->groups?->first()?->id))
        @else
            <a href="{{ route('entitygroupsold.show', $entity?->groups?->first()?->id) }}"
                class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a>
            <a href="{{ route('entitygroupsold.edit', $entity?->groups?->first()?->id) }}"
                class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Edit</a>
            <form class="inline-block" action="{{ route('entitygroupsold.destroy', $entity?->groups?->first()?->id) }}"
                method="POST" onsubmit="return confirm('Are you sure?');">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="Delete">
            </form>
        @endif

    </td>
</tr>
