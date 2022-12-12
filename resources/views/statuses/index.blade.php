<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <x-h2>
                {{ __('Statuses') }}
            </x-h2>

            <a class="px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring active:bg-blue-600" href="{{ route('statuses.create') }}">
                {{ __('Create') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <table>
                    @forelse($statuses as $status)
                        <tr>
                            <td>
                                {{$status->title}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>
                                {{__('No statuses in this system')}}
                            </td>
                        </tr>
                    @endforelse
                </table>
            </x-card>
        </div>
    </div>
</x-app-layout>
