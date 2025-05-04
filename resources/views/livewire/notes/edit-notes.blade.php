<div>
    <flux:modal name="edit-note" class="md:w-900">
        <div class="space-y-6">
            <form wire:submit.prevent="update" class="space-y-6">
                @csrf
                <div>
                    <flux:heading size="lg">Edit Note</flux:heading>
                    <flux:text class="mt-2">Make notes changes for your personal use.</flux:text>
                </div>

                <flux:input label="Title" wire:model="title" placeholder="Enter note title" />

                <flux:textarea label="Content" wire:model="content" placeholder="Enter note content"/>

                <div class="flex">
                    <flux:spacer />

                    <flux:button type="submit" variant="primary">Update</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

</div>
