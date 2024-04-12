<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('object.trashed', ['object' => __('business.business')]) }}
        </h2>
    </x-slot>

    <div class="h-600px mt-4 overflow-x-scroll">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-center">
                        #
                    </th>
                    <th class="text-center">
                        {{ __('account.account') }}
                    </th>
                    <th class="text-center">
                        {{ __('business.tax_id') }}
                    </th>
                    <th class="text-center">
                        {{ __('business.name') }}
                    </th>
                    <th class="text-center">
                        {{ __('business.province') }}
                    </th>
                    <th class="text-center">
                        {{ __('business.district') }}
                    </th>
                    <th class="text-center">
                        {{ __('business.ward') }}
                    </th>
                    <th class="text-center">
                        {{ __('btn.action') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($businesses !== null)
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($businesses as $business)
                        <tr>
                            <td class="text-center">
                                {{ ++$i }}
                            </td>
                            <th class="text-center">
                                {{ $business->account->email }}
                            </th>
                            <td class="text-center">
                                {{ $business->tax_id }}
                            </td>
                            <td class="text-center">
                                {{ $business->name }}
                            </td>
                            <td class="text-center">
                                {{ $business->addr_province }}
                            </td>
                            <td class="text-center">
                                {{ $business->addr_district }}
                            </td>
                            <td class="text-center">
                                {{ $business->addr_ward }}
                            </td>
                            <td class="flex justify-center">
                                <form method="POST" action="{{ route('businesses.restore', $business->id) }}">
                                    @csrf
                                    <input type="submit" class="btn btn-success color-success"
                                        value="{{ __('btn.restore') }}"
                                        onclick="confirm('Are you sure you want to restore?')">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    @if (Session::get('success'))
        <div class="alert alert-success">
            <ul>
                <li>{{ __('message.success', ['action' => __('btn.restore')]) }}</li>
            </ul>
        </div>
    @endif
</x-app-layout>
