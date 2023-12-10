<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Group;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use function view;


class GroupsList extends Component
{
    use WithPagination;

    public Group $group;

    public Collection $groups;

    public array $active;

    public int $editedGroupId = 0;

    public bool $showModal = false;

    protected $listeners = ['delete'];

    public function render()
    {
        $cats = Group::orderBy('position')->paginate(10);
        $links = $cats->links();

        $this->groups = collect($cats->items());

        $this->active = $this->groups->mapWithKeys(
            fn ($item) => [$item['id'] => (bool) $item['is_active']]
        )->toArray();
        // dd($this->active);
        // dd($cats->items());
        // dd($this->groups);

        return view('livewire.groups-list', [
            'links' => $links,
        ]);
    }

    public function openModal()
    {
        $this->showModal = true;

        $this->group = new Group();
    }

    public function updatedGroupName()
    {
        $this->group->slug = Str::slug($this->group->name);
    }

    public function save()
    {
        $this->validate();

        if ($this->editedGroupId === 0) {
            $this->group->position = Group::max('position') + 1;
        }

        $this->group->save();

        $this->reset('showModal', 'editedGroupId');
    }

    public function toggleIsActive($groupId)
    {
        Group::where('id', $groupId)->update([
            'is_active' => $this->active[$groupId],
        ]);
    }

    public function editGroup($groupId)
    {
        $this->editedGroupId = $groupId;

        $this->group = Group::find($groupId);
    }

    public function cancelGroupEdit()
    {
        $this->reset('editedGroupId');
    }

    public function deleteConfirm($method, $id = null)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type'  => 'warning',
            'title' => 'Are you sure?',
            'text'  => '',
            'id'    => $id,
            'method' => $method,
        ]);
    }

    public function delete($id)
    {
        Group::findOrFail($id)->delete();
    }

    public function updateOrder($list)
    {
        foreach ($list as $item) {
            $cat = $this->groups->firstWhere('id', $item['value']);

            if ($cat['position'] != $item['order']) {
                Group::where('id', $item['value'])->update(['position' => $item['order']]);
            }
        }
    }

    protected function rules(): array
    {
        return [
            'group.name'     => ['required', 'string', 'min:3'],
            'group.slug'     => ['nullable', 'string'],
            'group.position' => ['nullable', 'integer'],
        ];
    }
}
