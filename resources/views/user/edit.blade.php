<x-app-layout>
    <div class="container pt-0">
        <h2 class="text-center mb-4">Edit Profile</h2>


        <!-- Form -->
        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Avatar Upload with Preview -->
            <div class="form-group mb-3">
                <!-- Avatar Preview Frame -->
                <div class="mt-3 d-flex justify-content-center align-items-center">
                    <img id="avatar-preview" src="{{ $profile && $profile->avatar ? asset('storage/' . $profile->avatar) : 'https://via.placeholder.com/200' }}" alt="Avatar Preview" class="img-thumbnail" style="width: 200px; height: 200px; border-radius: 50%;">
                </div>
                <input type="file" id="avatar" name="avatar" class="form-control mt-2 {{ $errors->has('avatar') ? 'is-invalid' : '' }}" onchange="previewImage(event)">
                @if($errors->has('avatar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('avatar') }}
                    </div>
                @endif
            </div>

            <!-- Bio -->
            <div class="form-group mb-3">
                <label for="bio">Bio</label>
                <textarea id="bio" name="bio" class="form-control {{ $errors->has('bio') ? 'is-invalid' : '' }}" rows="4">{{ old('bio', $profile->bio ?? '') }}</textarea>
                @if($errors->has('bio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bio') }}
                    </div>
                @endif
            </div>

            <!-- Phone -->
            <div class="form-group mb-3">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" value="{{ old('phone', $profile->phone ?? '') }}">
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
            </div>

            <!-- Address -->
            <div class="form-group mb-4">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" value="{{ old('address', $profile->address ?? '') }}">
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
            </div>

            <!-- Buttons -->
            <div class="d-flex">
                <button type="submit" class="btn btn-success">Update Profile</button>
                &nbsp;&nbsp;
                <a href="{{ route('user.profile') }}" class="btn btn-danger">Cancel</a>
            </div>
        </br>
        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-message">
                {{ session('success') }}
            </div>

            <!-- JavaScript for Delayed Redirect -->
            @if(session('delay_redirect'))
                <script>
                    setTimeout(function() {
                        window.location.href = "{{ route('user.profile') }}";
                    }, 2000); // 2-second delay
                </script>
            @endif
        @endif

        </form>
    </div>

    <!-- JavaScript for Avatar Preview -->
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const preview = document.getElementById('avatar-preview');
            reader.onload = function() {
                preview.src = reader.result; // Update the image source
            };
            reader.readAsDataURL(event.target.files[0]); // Read the uploaded file
        }
    </script>
</x-app-layout>