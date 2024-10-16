<div class="mt-8">
  <h3 class="text-lg font-medium text-gray-900">Change fallback subdomain</h3>
  <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
    <div class="grid grid-cols-1 gap-6">
      <div class="col-span-12 sm:col-span-4">
        <label for="fallback_domain" class="">Domain</label>
        <div class="mt-1 flex rounded-md shadow-sm">
          <div class="relative flex flex-grow items-stretch focus-within:z-10">
            <x-form.input-addon addon_text=".{{ config('tenancy.central_domains')[0] }}" wire:model="domain" type="text" name="fallback_domain" id="fallback_domain"/>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="px-4 sm:px-6 py-2 bg-gray-50 flex justify-end">
    <x-button wire:click="save">Save</x-button>
  </div>
</div>
