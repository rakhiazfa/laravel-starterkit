<x-cube.auth.layout title="Dashboard">

    <section>

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

    </section>

    <section>

        <div class="grid grid-cols-1 xl:grid-cols-[500px,1fr] gap-7">

            <x-cube.card title="Customers">

                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Customer</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <th>
                                <div class="flex items-center gap-5">
                                    <img class="w-[35px] h-[35px] rounded-full"
                                        src="{{ url('assets/images/avatars/default.jpg') }}" alt="Avatar">
                                    <span class="font-medium">Rakhi Azfa Rifansya</span>
                                </div>
                            </th>
                            <td>
                                <div class="table-actions">
                                    <a href="#">
                                        <i class="uil uil-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <th>
                                <div class="flex items-center gap-5">
                                    <img class="w-[35px] h-[35px] rounded-full"
                                        src="{{ url('assets/images/avatars/default.jpg') }}" alt="Avatar">
                                    <span class="font-medium">Reyhan Maulana</span>
                                </div>
                            </th>
                            <td>
                                <div class="table-actions">
                                    <a href="#">
                                        <i class="uil uil-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <th>
                                <div class="flex items-center gap-5">
                                    <img class="w-[35px] h-[35px] rounded-full"
                                        src="{{ url('assets/images/avatars/default.jpg') }}" alt="Avatar">
                                    <span class="font-medium">Ragil Anugraha</span>
                                </div>
                            </th>
                            <td>
                                <div class="table-actions">
                                    <a href="#">
                                        <i class="uil uil-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </x-cube.card>

            <x-cube.card title="Form">

                <form action="#" method="POST">

                    <div class="grid gap-7 mb-7">

                        <div class="form-group">
                            <label class="label">Text Field</label>
                            <input type="text" class="field" placeholder="Text field">
                        </div>

                        <div class="form-group" data-te-datepicker-init data-te-input-wrapper-init>
                            <label class="label">Date</label>
                            <div class="relative">
                                <input type="text" class="field" name="date" placeholder="Select a date"
                                    data-te-datepicker-toggle-ref data-te-datepicker-toggle-button-ref />
                            </div>
                        </div>

                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>

                </form>

            </x-cube.card>

        </div>

    </section>

</x-cube.auth.layout>
