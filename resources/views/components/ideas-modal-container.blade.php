
@can('update', $idea)
    <livewire:edit-idea-modal
        :idea="$idea"
    />
@endcan

@can('delete', $idea)
    <livewire:delete-idea-modal
        :idea="$idea"
    />
@endcan

    <livewire:mark-as-spam-modal
    :idea="$idea"
    />

@isadmin
    <livewire:mark-as-not-spam-modal
        :idea="$idea"
    />
@endisadmin
