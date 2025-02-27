<h2 class="font-semibold text-2xl text-gray-900 leading-tight" style="text-align: center;">
    {{ __('Profile') }}
</h2>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="py-12 bg-gray-100">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- Profile Information Section -->
        <div class="p-6 sm:p-8 bg-white shadow rounded-lg" style="display:flex;">
            <div class="max-w-xl mx-auto">
                @include('profile.partials.update-profile-information-form')
            </div>
            <div class="max-w-xl mx-auto">
                @include('profile.partials.update-password-form')
            </div>
            <div class="max-w-xl mx-auto">
                <!-- Account Deletion Section with Alpine.js -->
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-6 sm:p-8 bg-white shadow rounded-lg flex justify-between items-center">
            <div class="max-w-xl mx-auto">
                <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800 font-medium text-lg">
                    Back To Dashboard
                </a>
            </div>
        </div>
    </div>


</div>

<!-- Include Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
