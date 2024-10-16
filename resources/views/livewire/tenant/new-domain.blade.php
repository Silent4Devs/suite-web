<div class="mt-8">
  <h3 class="text-lg font-medium text-gray-900 px-3 md:px-0">Add a custom domain</h3>
  <div class="mt-2">
    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
      <div class="grid grid-cols-1 gap-6">
        <div class="col-span-12 sm:col-span-4">
          <x-form.label for="name" value="Name"/>

          <x-form.input id="domain" autocomplete="off" wire:model="domain" type="text" value="" placeholder="mydomain.com"/>

          <x-form.input-error for="domain" />
        </div>
      </div>
    </div>
    <div class="px-4 sm:px-6 py-2 bg-gray-50 flex justify-end">
      <x-button  wire:click="save">Save</x-button>
    </div>
  </div>
</div>
