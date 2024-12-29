<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Create Your Account</h2>

        <form wire:submit.prevent="register">
            {{ $this->form }}

            <button type="submit" class="w-full p-3 mt-6 text-white rounded-md bg-blue-600 hover:bg-blue-700">
                Register
            </button>
        </form>

        <!-- Login Link -->
        <p class="text-sm text-gray-500 text-center mt-4">
            Already have an account? 
            <a href="{{ route('filament.admin.auth.login') }}" class="text-blue-600 hover:underline">Login</a>
        </p>
    </div>
</div>