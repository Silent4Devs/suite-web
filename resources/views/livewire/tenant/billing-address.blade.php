<div class="mt-8">
    <h3 class="text-lg font-medium text-gray-900">Billing address</h3>
    <div class="mt-2 shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6 flex flex-row flex-wrap">
            <div class="w-1/2 p-2">
                <x-form.label for="line1" value="Line 1"/>

                <div class="mt-1 relative rounded-md shadow-sm">
                    <x-form.input id="line1" wire:model="line1" type="text" placeholder="123 Laravel Street" />
                </div>

                <x-form.input-error for="line1" />
            </div>
            <div class="w-1/2 p-2">
                <x-form.label for="line2" value="Line 2"/>

                <div class="mt-1 relative rounded-md shadow-sm">
                    <x-form.input id="line2" wire:model="line2" type="text" placeholder="Apartment B" />
                </div>

                <x-form.input-error for="line2" />
            </div>
            <div class="mt-4 w-1/2 p-2">
                <x-form.label for="city" value="city"/>

                <div class="mt-1 relative rounded-md shadow-sm">
                    <x-form.input id="city" wire:model="city" type="text" placeholder="San Francisco" />
                </div>

                <x-form.input-error for="city" />
            </div>
            <div class="mt-4 w-1/2 p-2">
                <x-form.label for="postal_code" value="Postal Code"/>

                <div class="mt-1 relative rounded-md shadow-sm">
                    <x-form.input id="postal_code" wire:model="postal_code" type="text" placeholder="12345" />
                </div>

                <x-form.input-error for="postal_code" />
            </div>
            <div class="mt-4 w-1/2 p-2">
                <x-form.label for="country" value="Country"/>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <select id="country" wire:model="country" type="text" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 placeholder-gray-400 rounded-md shadow-sm mt-1 block w-full">
                        @include('partials.countries')
                    </select>
                </div>
                <x-form.input-error for="country" />
            </div>
            <div class="mt-4 w-1/2 p-2">
                <x-form.label for="state" value="state 1"/>

                <div class="mt-1 relative rounded-md shadow-sm">
                    <x-form.input id="state" wire:model="state" type="text" placeholder="California" />
                </div>

                <x-form.input-error for="state" />
            </div>
            @if($success)
            <p class="text-sm mt-4 text-green-500">
                {{ $success }}
            </p>
            @endif
        </div>
        <div class="px-4 sm:px-6 py-2 bg-gray-50 flex justify-end">
            <x-button wire:click="save">Save billing address</x-button>
        </div>
    </div>
</div>