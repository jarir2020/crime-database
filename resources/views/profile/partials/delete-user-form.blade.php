<section x-data="{ openModal: false }">
    <!-- Delete Account Button -->
    <button
        class="bg-red-600 text-white px-6 py-3 rounded-md shadow-md text-lg font-medium hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-200"
        @click="openModal = !openModal"
    >
        <span x-text="openModal ? '{{ __('Close Delete Section') }}' : '{{ __('Delete Account') }}'"></span>
    </button>

    <!-- Modal Popup -->
    <div x-show="openModal" x-transition class="fixed inset-0 bg-gray-800 bg-opacity-50 z-50 flex justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg p-6 space-y-6 w-full max-w-lg">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <!-- Password Input Field -->
                <div class="mt-6">
                    <label for="password" class="sr-only">{{ __('Password') }}</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="{{ __('Password') }}"
                    >

                    @error('password')
                        <div class="text-red-500 mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" @click="openModal = false" class="px-6 py-3 bg-green-600 text-white rounded-md text-sm font-medium hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-200">
                        {{ __('Cancel') }}
                    </button>

                    <button type="submit" class="px-6 py-3 bg-red-600 text-white rounded-md text-sm font-medium hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-200">
                        {{ __('Delete Account') }}
                    </button>

                </div>
            </form>
        </div>
    </div>
</section>
