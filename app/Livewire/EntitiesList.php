<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Entity;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use function view;


class EntitiesList extends Component
{
    use WithPagination;

    public Entity $entity;

    public Collection $entities;

    public array $active;

    public int $editedEntityId = 0;

    public bool $showModal = false;

    protected $listeners = ['delete'];

    public function render()
    {
        $cats = Entity::orderBy('position')->paginate(10);
        $links = $cats->links();
        $this->entities = collect($cats->items());

        $this->active = $this->entities->mapWithKeys(
            fn ($item) => [$item['id'] => (bool) $item['is_active']]
        )->toArray();

        return view('livewire.entities-list', [
            'links' => $links,
        ]);
    }

    public function openModal()
    {
        $this->showModal = true;

        $this->entity = new Entity();
    }

    public function updatedEntityName()
    {
        $this->entity->slug = Str::slug($this->entity->name);
    }

    public function save()
    {
        $this->validate();

        if ($this->editedEntityId === 0) {
            $this->entity->position = Entity::max('position') + 1;
        }

        $this->entity->save();

        $this->reset('showModal', 'editedEntityId');
    }

    public function toggleIsActive($entityId)
    {
        Entity::where('id', $entityId)->update([
            'is_active' => $this->active[$entityId],
        ]);
    }

    public function editEntity($entityId)
    {
        $this->editedEntityId = $entityId;

        $this->entity = Entity::find($entityId);
    }

    public function cancelEntityEdit()
    {
        $this->reset('editedEntityId');
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
        Entity::findOrFail($id)->delete();
    }

    public function updateOrder($list)
    {
        foreach ($list as $item) {
            $cat = $this->entities->firstWhere('id', $item['value']);

            if ($cat['position'] != $item['order']) {
                Entity::where('id', $item['value'])->update(['position' => $item['order']]);
            }
        }
    }

    protected function rules(): array
    {
        return [
            'entity.name'     => ['required', 'string', 'min:3'],
            'entity.slug'     => ['nullable', 'string'],
            'entity.position' => ['nullable', 'integer'],
        ];
    }
}
