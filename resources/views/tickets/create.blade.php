<x-app-layout>
    <x-slot name="header">
        <x-h2>
            {{ __('Tickets') }}
        </x-h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <form method="POST" action="{{ route('tickets.store') }}" class="mt-6 space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <x-input-label for="title" :value="__('Message')" />
                        <x-textarea id="message" name="message" class="mt-1 block w-full" :value="old('message')" required autofocus autocomplete="message" />
                        <x-input-error class="mt-2" :messages="$errors->get('message')" />
                    </div>

                    <div>
                        @forelse($labels as $label)
                            <input type="checkbox" name="labels[]" value="{{$label->id}}">{{$label->title}}
                        @empty
                            <p>No labels in system</p>
                        @endforelse
                    </div>

                    <div>
                        @forelse($categories as $category)
                            <input type="checkbox" name="categories[]" value="{{$category->id}}">{{$category->title}}
                        @empty
                            <p>No categories in system</p>
                        @endforelse
                    </div>


                    @if(count($priorities))
                    <div>
                        <select name="priority_id">
                            @foreach($priorities as $priority)
                                <option value="{{$priority->id}}">{{$priority->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>

                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
