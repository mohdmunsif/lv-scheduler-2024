<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Group;
use App\Models\Entity;
use App\Models\EntityGroup;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use function view;
use Illuminate\Support\Facades\Log;


class EntityGroupList extends Component
{
    use WithPagination;

    public Entity $entity;

    public array $active;

    public int $editedEntityGroupId = 0;

    public bool $showModal = false;

    protected $listeners = ['delete'];

    public array $arr_entity_groups = [];

    public $entities;
    public $grouplist;
    public $entityGroups;
    public $group;

    public function mount(Entity $entity)
    {
        $this->entity = $entity;
        $this->entities = Entity::all();
        $this->grouplist = Group::all();
        $this->entityGroups = EntityGroup::all()->sortBy([['group_id', 'asc'], ['entity_id', 'asc']]);
        $setOfEntityIds = $this->entities->pluck('id')->toArray();
        $setOfGroupIds = $this->grouplist->pluck('id')->toArray();

        $this->arr_entity_groups = array_fill_keys($setOfEntityIds, array_fill_keys($setOfGroupIds, false));


        foreach ($this->entityGroups as $singleEntityGroup) {
            $this->arr_entity_groups[$singleEntityGroup->entity_id][$singleEntityGroup->group_id] = true;
        };
    }

    public function render()
    {

        return view('livewire.entity-group-list', [
            'entities' => $this->entities,  'grouplist' => $this->grouplist, 'entityGroups' => $this->entityGroups,  'arr_entity_groups' => $this->arr_entity_groups,
        ]);
    }


    public function dehydrate()
    {
        // dd($this->arr_entity_groups);
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

        if ($this->editedEntityGroupId === 0) {
            $this->group->position = Group::max('position') + 1;
        }

        $this->group->save();

        $this->reset('showModal', 'editedEntityGroupId');
    }

    public function toggleIsActive($entityGroupId)
    {
        Group::where('id', $entityGroupId)->update([
            'is_active' => $this->active[$entityGroupId],
        ]);
    }

    public function editGroup($entityGroupId)
    {
        $this->editedEntityGroupId = $entityGroupId;

        $this->group = Group::find($entityGroupId);
    }

    public function cancelGroupEdit()
    {
        $this->reset('editedEntityGroupId');
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

    public function updatedArrEntityGroups($value)
    {
        $arrGroups = [];

        $setOfEntityIds = $this->entities->pluck('id')->toArray();
        $setOfGroupIds = $this->grouplist->pluck('id')->toArray();

        foreach ($setOfEntityIds as $singleEntityId) {
            foreach ($setOfGroupIds as $singleGroupId) {

                if ($this->arr_entity_groups[$singleEntityId][$singleGroupId]) {
                    array_push($arrGroups, $singleGroupId);
                };
            }

            $tempEntity = Entity::find($singleEntityId);
            $tempEntity->groups()->sync($arrGroups);
            $arrGroups = [];
        }
    }
}
