<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
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
                   Forgot Password
                </h2>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 shadow-md animate-pulse rounded-2xl">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('status'))
                    <div class="mb-4 rounded-lg border border-green-300 bg-green-100 px-4 py-3 text-green-800 shadow-md animate-pulse">
                        <div class="flex items-center">
                            <svg class="mr-2 h-5 w-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.172 7.707 8.879a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>

                            <span class="font-medium">
                                {{ session('status') }}
                            </span>
                        </div>
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="post">
                    @csrf
                    <!-- Email -->
                    <div class="relative mb-6" data-twe-input-wrapper-init>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            required
                            class="peer block w-full border-0 border-b-2 border-gray-400 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none focus:border-[#2F2FE4]"
                            placeholder=" "
                        />
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
                    
                    <!-- Send button -->
                    <div class="text-center lg:text-left">
                        <button
                        type="submit"
                        class="hover:opacity-90 inline-block w-full rounded bg-[#2F2FE4] px-7 pb-2 pt-3 text-sm font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong"
                        data-twe-ripple-init
                        data-twe-ripple-color="light">
                        Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>