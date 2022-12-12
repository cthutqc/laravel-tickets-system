<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <x-h2>
                {{ __('Tickets') }}
            </x-h2>

            <a class="px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring active:bg-blue-600" href="{{ route('tickets.create') }}">
                {{ __('Create') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <table class="w-full text-left">
                    @if(count($tickets))
                    <thead>
                        <tr>
                            <th>#</th>
                            @hasanyrole('admin|agent')
                            <th>user</th>
                            @endhasanyrole
                            <th>title</th>
                            <th>label</th>
                            <th>category</th>
                            <th>priority</th>
                            <th>status</th>
                            <th>created at</th>
                            <th></th>
                        </tr>
                    </thead>
                    @endif
                    <tbody>
                    @forelse($tickets as $ticket)
                        <tr>
                            <td>
                                {{$ticket->id}}
                            </td>
                            @hasanyrole('admin|agent')
                            <td>
                                {{$ticket->user->name}}
                            </td>
                            @endhasanyrole
                            <td>
                                {{$ticket->title}}
                            </td>
                            <td>
                                @foreach($ticket->labels as $label)
                                    <p>{{$label->title}}</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach($ticket->categories as $category)
                                    <p>{{$category->title}}</p>
                                @endforeach
                            </td>
                            <td>
                                {{$ticket->priority->title}}
                            </td>
                            <td>
                                {{$ticket->status->title}}
                            </td>
                            <td>
                                {{$ticket->created_at}}
                            </td>
                            <td>
                                <a href="{{route('tickets.show', $ticket)}}">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                {{__('No tickets in this system')}}
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </x-card>
        </div>
    </div>
</x-app-layout>
