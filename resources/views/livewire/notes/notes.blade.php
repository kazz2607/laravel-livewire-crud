<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Notes') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage your notes') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <livewire:notes.create-notes />
    <livewire:notes.edit-notes />


    @session('message')
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="fixed top-5 right-5 z-50 bg-green-500 text-white text-sm p-4 rounded-lg shadow-lg" role="alert">
            {{ session('message') }}
        </div>
    @endsession

    <div>
        <table class="w-full mt-5">
            <thead>
                <tr>
                    <th class="text-left text-sm font-medium text-gray-500 dark:text-gray-400">Title</th>
                    <th class="text-left text-sm font-medium text-gray-500 dark:text-gray-400">Content</th>
                    <th class="text-left text-sm font-medium text-gray-500 dark:text-gray-400">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notes as $note)
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="py-4 text-sm font-medium text-gray-900 dark:text-white">{{ $note->title }}</td>
                        <td class="py-4 text-sm text-gray-700 dark:text-gray-300">{{ $note->content }}</td>
                        <td class="py-4 text-sm text-gray-700 dark:text-gray-300">
                            <flux:button.group>
                                <flux:button icon="eye" wire:click="view({{ $note->id }})" />
                                <flux:button icon="pencil" wire:click="edit({{ $note->id }})" />
                                <flux:button icon="trash" wire:click="delete({{ $note->id }})" />
                            </flux:button.group>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        <div class="mt-4">
            {{ $notes->links() }}
        </div>

        {{-- Delete Modal --}}

        <flux:modal name="delete-note" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Delete note?</flux:heading>
                    <flux:text class="mt-2">
                        <p>You're about to delete this note.</p>
                        <p>This action cannot be reversed.</p>
                    </flux:text>
                </div>
                <div class="flex gap-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" wire:click="confirmDelete({{ $note->id }})" variant="danger">Delete note</flux:button>
                </div>
            </div>
        </flux:modal>
    </div>
</div>
