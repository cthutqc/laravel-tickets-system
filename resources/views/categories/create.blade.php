<x-app-layout>
    <x-slot name="header">
        <x-h2>
            {{ __('Categories') }}
        </x-h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <form method="POST" action="{{ route('categories.store') }}" class="mt-6 space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>

                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
