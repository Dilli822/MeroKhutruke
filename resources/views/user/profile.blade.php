<x-app-layout>
    <div class="container py-5">
        <h2 class="text-center mb-4"> Profile</h2>

        <div class="card shadow-lg mx-auto" style="max-width: 500px;">
            <div class="card-body p-4">
                <!-- Avatar Section -->
                <div class="text-center mb-4">
                    @if($profile && $profile->avatar)
                        <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" class="rounded-circle img-thumbnail" style="width: 120px; height: 120px;">
                    @else
                        <div class="bg-secondary rounded-circle d-inline-flex justify-content-center align-items-center" style="width: 120px; height: 120px;">
                            <i class="fas fa-user text-white fa-3x"></i>
                        </div>
                    @endif
                </div>

                <!-- User Info -->
                <h4 class="card-title text-center m-0">{{ Auth::user()->name }}</h4>
                <p class="text-center text-muted m-0">{{ Auth::user()->email }}</p>
                <p class=" text-center text-muted m-0"> Date Joined: {{ Auth::user()->created_at->format('F j, Y') }} </p>
                <!-- Profile Details -->
                @if($profile)
                    <div class="mb-4">
                    <hr>
                        <p class="mb-2"><strong>Bio:</strong> {{ $profile->bio }}</p>
                        <p class="mb-2"><strong>Phone:</strong> {{ $profile->phone }}</p>
                        <p class="mb-0"><strong>Address:</strong> {{ $profile->address }}</p>
                    </div>
                @else
                    <p class="text-center text-muted mb-4">You have not set up a profile yet.</p>
                @endif

                <!-- Edit Profile Button -->
                <div class="text-center">
                    <a href="{{ route('user.profile.edit') }}" class="btn btn-primary btn-lg px-4">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>