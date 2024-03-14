<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Sent Emails') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="p-6">
                <a href="{{ route('new-email.create') }}" style="display: inline-block; padding: 10px 20px; background-color: #04AA6D; color: #FFFFFF; border-radius: 8px;">
                    Send New Email
                </a>
            </div>
            

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($emails->isEmpty())
                        <div>No emails have been sent yet.</div>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        NO
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Recipient
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subject
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Message
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800">
                                  @php
                                        $currentPage = $emails->currentPage();
                                        $perPage = $emails->perPage();
                                        $index = ($currentPage - 1) * $perPage + 1;
                                    @endphp
                                @foreach ($emails as $email)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $index++ }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $email->created_at }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $email->recipient }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $email->subject }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $email->message }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $email->status }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $emails->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
