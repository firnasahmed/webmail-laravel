<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Send New Email') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="email-form-container mx-auto sm:px-6 lg:px-8" style="max-width: 600px;">
            <div class="p-6">
                <a href="{{ url()->previous() }}" style="display: inline-block; padding: 10px 20px; background-color: #008CBA; color: #FFFFFF; border-radius: 8px;">
                    Back
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="emailForm" action="{{ route('new-email.send') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="recipients" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Recipients</label>
                            <input type="text" name="recipients" id="recipients" class="mt-1 p-2 w-full border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 text-gray-100" required>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Enter multiple email addresses separated by commas.</p>
                        </div>
                        <div class="mb-4">
                            <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subject</label>
                            <input type="text" name="subject" id="subject" class="mt-1 p-2 w-full border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 text-gray-100" required>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
                            <textarea name="message" id="message" rows="10" class="mt-1 p-2 w-full border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 text-gray-100" required></textarea>
                        </div>
                        <div>
                            <button type="button" onclick="validateForm()" class="btn btn-primary" style="display: inline-block; padding: 10px 20px; background-color: #04AA6D; color: #FFFFFF; border-radius: 8px;">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function validateForm() {
        var recipientsInput = document.getElementById('recipients');
        var recipients = recipientsInput.value.trim().split(',');

        // Regular expression to validate email addresses
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Validate each email address
        for (var i = 0; i < recipients.length; i++) {
            var email = recipients[i].trim();

            // Check if the email format is valid
            if (!emailRegex.test(email)) {
                alert('Invalid email address format: ' + email);
                recipientsInput.focus();
                return;
            }

            // Check if the email contains any invalid characters
            var invalidCharsRegex = /[^a-zA-Z0-9!#$%&'*+-/=?^_`{|}~.@]/;
            if (invalidCharsRegex.test(email)) {
                alert('Invalid character found in email address: ' + email);
                recipientsInput.focus();
                return;
            }
        }

        // Check if other fields are filled
        var subject = document.getElementById('subject').value.trim();
        var message = document.getElementById('message').value.trim();

        if (subject === '' || message === '') {
            alert('Please fill in all fields.');
            return;
        }

        // Submit the form if all validations pass
        document.getElementById('emailForm').submit();
    }
</script>
