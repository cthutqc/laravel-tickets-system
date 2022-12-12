<x-app-layout>
    <x-slot name="header">
        <x-h2>
            {{ __('Tickets') }}
        </x-h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @hasanyrole('admin|agent')

            <x-card>

                <form action="{{route('tickets.change_status', $ticket)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div>
                        <x-input-label for="status" :value="__('Status')" />
                        <select name="status">
                            @foreach($statuses as $status)
                                <option value="{{$status->id}}" @selected(old('status_id', $ticket->status_id) == $status->id)>{{$status->title}}</option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('status_id')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>
                </form>

            </x-card>

            @endhasanyrole

            <x-card>

                <div>
                    <p>{{__('Status')}}</p>
                    <p>{{$ticket->status->title}}</p>
                </div>

                <div>
                    <p>{{__('Title')}}</p>
                    <p>{{$ticket->title}}</p>
                </div>

                <div>
                    <p>{{__('Message')}}</p>
                    <p>{{$ticket->message}}</p>
                </div>

                @forelse($ticket->messages as $message)
                    <div class="my-2">
                        <p class="text-xs">{{__('user')}} {{$message->user->name}} {{__('write')}}:</p>
                        <p class="pl-4">{{$message->message}}</p>
                    </div>
                @empty
                @endforelse

                <div>
                    <p>{{__('Label')}}</p>
                    @foreach($ticket->labels as $label)
                        <p>{{$label->title}}</p>
                    @endforeach
                </div>

                <div>
                    <p>{{__('Category')}}</p>
                    @foreach($ticket->categories as $category)
                        <p>{{$category->title}}</p>
                    @endforeach
                </div>

            </x-card>

            <x-card>
                <form action="{{route('tickets.add_message', $ticket)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-input-label for="title" :value="__('Message')" />
                        <x-textarea id="message" name="message" class="mt-1 block w-full" :value="old('message')" required autofocus autocomplete="message" />
                        <x-input-error class="mt-2" :messages="$errors->get('message')" />
                    </div>
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Add message') }}</x-primary-button>
                    </div>
                </form>
            </x-card>

        </div>
    </div>
</x-app-layout>
