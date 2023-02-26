<x-cube.auth.layout title="Dashboard">

    <div class="grid grid-col-1 md:grid-cols-3 lg:grid-cols-1 xl:grid-cols-3 gap-7">

        <x-cube.card title="This month's income" titleClass="normal-case">
            <div class="flex items-center gap-2 -mt-4 mb-3">
                <i class="uil uil-angle-down text-3xl"></i>
                <span class="text-xl font-semibold">IDR 1.562.500</span>
            </div>
            <div class="flex items-center gap-5">
                <div class="w-full bg-gray-100 rounded-full h-2.5">
                    <div class="bg-blue-500 h-2.5 rounded-full" style="width: 15%"></div>
                </div>
                <span class="text-sm text-right text-gray-400 font-medium whitespace-nowrap">15 %</span>
            </div>
        </x-cube.card>

        <x-cube.card title="Total Income" titleClass="normal-case">
            <div class="flex items-center gap-2 -mt-4 mb-3">
                <i class="uil uil-angle-double-down text-3xl"></i>
                <span class="text-xl font-semibold">IDR 15.316.500</span>
            </div>
            <div class="flex items-center gap-5">
                <div class="w-full bg-gray-100 rounded-full h-2.5">
                    <div class="bg-blue-500 h-2.5 rounded-full" style="width: 32%"></div>
                </div>
                <span class="text-sm text-right text-gray-400 font-medium whitespace-nowrap">32 %</span>
            </div>
        </x-cube.card>

        <x-cube.card title="Total Expenses" titleClass="normal-case">
            <div class="flex items-center gap-2 -mt-4 mb-3">
                <i class="uil uil-angle-double-up text-3xl"></i>
                <span class="text-xl font-semibold">IDR 6.273.500</span>
            </div>
            <div class="flex items-center gap-5">
                <div class="w-full bg-gray-100 rounded-full h-2.5">
                    <div class="bg-blue-500 h-2.5 rounded-full" style="width: 25%"></div>
                </div>
                <span class="text-sm text-right text-gray-400 font-medium whitespace-nowrap">25 %</span>
            </div>
        </x-cube.card>

    </div>

</x-cube.auth.layout>
