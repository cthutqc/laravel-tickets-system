<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <x-h2>
                {{ __('Priorities') }}
            </x-h2>

            <a class="px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring active:bg-blue-600" href="{{ route('priorities.create') }}">
                {{ __('Create') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <table class="w-full">
                    <thead>
                    <tr>
                        <th class="text-left">{{__('name')}}</th>
                        <th class="text-left">{{__('action')}}</th>
                    </tr>
                    </thead>
                    @forelse($priorities as $priority)
                        <tr>
                            <td>
                                {{$priority->title}}
                            </td>
                            <td class="flex items-center flex-end space-x-2">
                                <a href="{{route('priorities.edit', $priority)}}">{{__('Edit')}}</a>
                                <form action="{{route('priorities.destroy', $priority)}}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">{{__('Delete')}}</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">
                                {{__('No priorities in this system')}}
                            </td>
                        </tr>
                    @endforelse
                </table>
            </x-card>
        </div>
    </div>
</x-app-layout>
