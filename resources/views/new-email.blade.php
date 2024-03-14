<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Send New Email') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="email-form-container mx-auto sm:px-6 lg:px-8" style="max-width: 600px;"> <!-- Added max-width -->
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('new-email.send') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="recipients" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Recipients</label>
                            <input type="text" name="recipients" id="recipients" class="mt-1 p-2 w-full border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 text-gray-100" required>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Enter multiple email addresses separated by commas.</p>
                        </div>
                        <div class="mb-4">
                            <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subject</label>
                            <input type="text" name="subject" id="subject" class="mt-1 p-2 w-full border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 text-gray-100">
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
                            <textarea name="message" id="message" rows="10" class="mt-1 p-2 w-full border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 text-gray-100"></textarea>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
