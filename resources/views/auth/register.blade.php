<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Page</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <!-- Tailwind CSS config -->
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
</head>
    <body class="bg-gray-100">
        <div class="min-h-screen flex items-center justify-center">
            <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-xl font-standar text-center mb-6">
                    Welcome To Petshop Member
                </h2>

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <!-- Email -->
                    <div class="relative mb-6" data-twe-input-wrapper-init>
                        <input
                            type="name"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            required
                            class="peer block w-full border-0 border-b-2 border-gray-400 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none focus:border-[#2F2FE4]"
                            placeholder=" "
                        />
                        @error('name')
                            <div class="mt-1 text-sm text-red-500">
                                {{ $message }}
                            </div>
                        @enderror
                        <label
                            for="name"
                            class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out
                            peer-focus:-translate-y-[1.15rem]
                            peer-focus:scale-[0.8]
                            peer-focus:text-[#2F2FE4]
                            peer-placeholder-shown:translate-y-0
                            peer-placeholder-shown:scale-100
                            peer-[&:not(:placeholder-shown)]:-translate-y-[1.15rem]
                            peer-[&:not(:placeholder-shown)]:scale-[0.8]">
                            Masukan Nama
                        </label>
                    </div>
                    <div class="relative mb-6" data-twe-input-wrapper-init>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            required
                            class="peer block w-full border-0 border-b-2 border-gray-400 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none focus:border-[#2F2FE4]"
                            placeholder=" "
                        />
                        @error('email')
                            <div class="mt-1 text-sm text-red-500">
                                {{ $message }}
                            </div>
                        @enderror
                        <label
                            for="email"
                            class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out
                            peer-focus:-translate-y-[1.15rem]
                            peer-focus:scale-[0.8]
                            peer-focus:text-[#2F2FE4]
                            peer-placeholder-shown:translate-y-0
                            peer-placeholder-shown:scale-100
                            peer-[&:not(:placeholder-shown)]:-translate-y-[1.15rem]
                            peer-[&:not(:placeholder-shown)]:scale-[0.8]">
                            Email address
                        </label>
                    </div>
                    

                    <div class="relative mb-6" data-twe-input-wrapper-init>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                            class="peer block w-full border-0 border-b-2 border-gray-400 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none focus:border-[#2F2FE4]"
                            placeholder=" "
                        />
                        <label
                            for="password"
                            class="password-field pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out
                            peer-focus:-translate-y-[1.15rem]
                            peer-focus:scale-[0.8]
                            peer-focus:text-[#2F2FE4]
                            peer-placeholder-shown:translate-y-0
                            peer-placeholder-shown:scale-100
                            peer-[&:not(:placeholder-shown)]:-translate-y-[1.15rem]
                            peer-[&:not(:placeholder-shown)]:scale-[0.8]">
                            Password
                        </label>
                        @error('password')
                            <div class="text-red-500 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="relative mb-6" data-twe-input-wrapper-init>
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            required
                            class="peer block w-full border-0 border-b-2 border-gray-400 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none focus:border-[#2F2FE4]"
                            placeholder=" "
                        />
                        <label
                            for="password_confirmation"
                            class="password-field pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out
                            peer-focus:-translate-y-[1.15rem]
                            peer-focus:scale-[0.8]
                            peer-focus:text-[#2F2FE4]
                            peer-placeholder-shown:translate-y-0
                            peer-placeholder-shown:scale-100
                            peer-[&:not(:placeholder-shown)]:-translate-y-[1.15rem]
                            peer-[&:not(:placeholder-shown)]:scale-[0.8]">
                            Password Confirmation
                        </label>
                       @error('password_confirmation')
                        <div class="mt-1 text-sm text-red-500">
                            {{ $message }}
                        </div>
                        @enderror

                        <div class="mt-4 text-end">
                            <input type="checkbox" id="showPassword">
                            <label for="showPassword">Show Password</label>
                        </div>
                    </div>
                    
                        <script>
                        document.getElementById('showPassword').addEventListener('change', function () {
                            const password = document.getElementById('password');
                            const confirm = document.getElementById('password_confirmation');

                            password.type = this.checked ? 'text' : 'password';
                            confirm.type = this.checked ? 'text' : 'password';
                        });
                        </script>

                    <!-- Login button -->
                    <div class="text-center lg:text-left">
                        <button
                        type="submit"
                        class="hover:opacity-90 inline-block w-full rounded bg-[#2F2FE4] px-7 pb-2 pt-3 text-sm font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong"
                        data-twe-ripple-init
                        data-twe-ripple-color="light"
                        id="submitBtn">
                        Register
                        </button>
                    </div>
                </form>
                <div class="mb-6 mt-1 text-center">
                    <p>
                        Sudah Memiliki Akun?
                        <a href="{{ route('auth.login') }}"
                        class="font-semibold text-[#2F2FE4] hover:underline">
                            Login
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>