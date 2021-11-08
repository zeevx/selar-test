<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ url('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div class="m-6 bg-gray-100 rounded-xl p-2">
        <img src="{{ url('selar-logo-small.png') }}" width="100px" alt="logo" class="mx-auto">
        <div align="center" class="container md:w-4/5 xl:w-3/5  mx-auto px-2">
            <form action="" method="get">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            Start Date
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="date" name="from" placeholder="yyyy-mm-dd" value="{{ $from }}">
                    </div>
                    <div class="w-full px-3 pt-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                            End Date
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="date" name="to" placeholder="yyyy-mm-dd" value="{{ $to }}">
                    </div>
                    <div class="w-full px-3">
                        <br>
                        <button
                            class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-900 border border-transparent rounded-lg active:bg-purple-900 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                        >
                            Filter Selar Data Now
                        </button>
                    </div>
                </div>
            </form>
            <div class="text-xl">
                <b>FILTER: </b>{{ $from }} <b>TO</b> {{ $to }} ({{ $diffHumans }})
            </div>

            <div class="my-5 rounded-xl bg-purple-900 text-white text-left divide-y-2 divide-solid divide-white">
                <h2 class="p-2 font-bold">How to use?</h2>
                <p class="p-2">
                    1. KPIs can be filtered using the date filter above.
                </p>
                <p class="p-2">
                    2. The KPI: Merchant's sales average is calculated in naira,
                    other currencies are converted to naira using the
                    free conversion APIs: <b>https://free.currencyconverterapi.com/</b>, this require internet
                    so as to be calculated correctly.
                </p>
            </div>

            <hr class="border-2 my-4 border-purple-900"/>

            <div class="grid gap-10 my-8">
                <div>
                    <div class="flex justify-start">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold p-2">
                            Purchases volume
                        </div>
                    </div>
                    <div class="text-left">
                        <dl class="duration-1500 delay-500 flex flex-wrap divide-y divide-gray-200 border-b border-gray-200">
                            <div class="w-full flex-none flex items-baseline px-4 sm:px-6 py-4">
                                <dt class="w-2/5 sm:w-1/3 flex-none uppercase text-xs sm:text-sm font-semibold tracking-wide">Currency</dt>
                                <dt class="w-2/5 sm:w-1/3 flex-none uppercase text-xs sm:text-sm font-semibold tracking-wide">Sales</dt>
                                <dd class="uppercase text-xs sm:text-sm font-semibold tracking-wide">Profit</dd>
                            </div>
                            @forelse($purchases as $purchase)
                                <div class="w-full flex-none flex items-baseline px-4 sm:px-6 py-4">
                                    <dt class="w-2/5 sm:w-1/3 flex-none uppercase text-xs sm:text-sm font-semibold tracking-wide">{{ $purchase->cur }}</dt>
                                    <dt class="w-2/5 sm:w-1/3 text-black text-sm sm:text-base">{{ number_format($purchase->total_amount, 2) }} </dt>
                                    <dd class="text-black text-sm sm:text-base"><b>{{ number_format($purchase->profit,2) }}</b></dd>
                                </div>
                            @empty
                                No Data
                            @endforelse
                        </dl>
                    </div>
                </div>

                <div>
                    <div class="flex justify-start">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold p-2">
                            New users
                        </div>
                    </div>
                    <div class="text-left">
                        <dl class="duration-1500 delay-500 flex flex-wrap divide-y divide-gray-200 border-b border-gray-200">
                            <div class="w-full flex-none flex items-baseline px-4 sm:px-6 py-4">
                                <dt class="w-2/5 sm:w-1/3 flex-none uppercase text-xs sm:text-sm font-semibold tracking-wide">Total Number: </dt>
                                <dd class="uppercase text-xs sm:text-sm font-semibold tracking-wide">{{ $users->count() }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div>
                    <div class="flex justify-start">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold p-2">
                            New Products
                        </div>
                    </div>
                    <div class="text-left">
                        <dl class="duration-1500 delay-500 flex flex-wrap divide-y divide-gray-200 border-b border-gray-200">
                            <div class="w-full flex-none flex items-baseline px-4 sm:px-6 py-4">
                                <dt class="w-2/5 sm:w-1/3 flex-none uppercase text-xs sm:text-sm font-semibold tracking-wide">Total Number: </dt>
                                <dd class="uppercase text-xs sm:text-sm font-semibold tracking-wide">{{ $products->count() }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div>
                    <div class="flex justify-start">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold p-2">
                            New Merchants
                        </div>
                    </div>
                    <div class="text-left">
                        <dl class="duration-1500 delay-500 flex flex-wrap divide-y divide-gray-200 border-b border-gray-200">
                            <div class="w-full flex-none flex items-baseline px-4 sm:px-6 py-4">
                                <dt class="w-2/5 sm:w-1/3 flex-none uppercase text-xs sm:text-sm font-semibold tracking-wide">Total Number: </dt>
                                <dd class="uppercase text-xs sm:text-sm font-semibold tracking-wide">{{ $new_merchants->count() }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div>
                    <div class="flex justify-start">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold p-2">
                            Unique Merchants
                        </div>
                    </div>
                    <div class="text-left">
                        <dl class="duration-1500 delay-500 flex flex-wrap divide-y divide-gray-200 border-b border-gray-200">
                            <div class="w-full flex-none flex items-baseline px-4 sm:px-6 py-4">
                                <dt class="w-2/5 sm:w-1/3 flex-none uppercase text-xs sm:text-sm font-semibold tracking-wide">Total Number: </dt>
                                <dd class="uppercase text-xs sm:text-sm font-semibold tracking-wide">{{ $unique_merchants->count() }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div>
                    <div class="flex justify-start">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold p-2">
                            New Sellers
                        </div>
                    </div>
                    <div class="text-left">
                        <dl class="duration-1500 delay-500 flex flex-wrap divide-y divide-gray-200 border-b border-gray-200">
                            <div class="w-full flex-none flex items-baseline px-4 sm:px-6 py-4">
                                <dt class="w-2/5 sm:w-1/3 flex-none uppercase text-xs sm:text-sm font-semibold tracking-wide">Total Number: </dt>
                                <dd class="uppercase text-xs sm:text-sm font-semibold tracking-wide">{{ $new_sellers->count() }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div>
                    <div class="flex justify-start">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold p-2">
                            Unique Sellers
                        </div>
                    </div>
                    <div class="text-left">
                        <dl class="duration-1500 delay-500 flex flex-wrap divide-y divide-gray-200 border-b border-gray-200">
                            <div class="w-full flex-none flex items-baseline px-4 sm:px-6 py-4">
                                <dt class="w-2/5 sm:w-1/3 flex-none uppercase text-xs sm:text-sm font-semibold tracking-wide">Total Number: </dt>
                                <dd class="uppercase text-xs sm:text-sm font-semibold tracking-wide">{{ $unique_merchants->count() }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div>
                    <div class="flex justify-start">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold p-2">
                            Merchant's sales average (Naira)
                        </div>
                    </div>
                    <div class="text-left">
                        <dl class="duration-1500 delay-500 flex flex-wrap divide-y divide-gray-200 border-b border-gray-200">
                            <div class="w-full flex-none flex items-baseline px-4 sm:px-6 py-4">
                                <dt class="w-2/5 sm:w-1/3 flex-none uppercase text-xs sm:text-sm font-semibold tracking-wide">Average: </dt>
                                <dd class="uppercase text-xs sm:text-sm font-semibold tracking-wide">{{ number_format($average, 2) }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
