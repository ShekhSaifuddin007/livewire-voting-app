
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

@auth
    <livewire:edit-comment-modal />
@endauth

@auth
    <livewire:delete-comment-modal />
@endauth

@auth
    <livewire:mark-spam-comment-modal />
@endauth

@isadmin
    <livewire:mark-not-spam-comment-modal />
@endisadmin

