<div class="mt-8">
    <h3 class="text-lg font-medium text-gray-900">Change payment method</h3>
    <div class="mt-2 shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
            <div>
                <h4 class="font-medium text-gray-900">Current payment method</h4>
                @if(tenant()->hasDefaultPaymentMethod())
                    <p class="mt-2 text-sm text-gray-600">
                        {{ ucfirst(tenant()->defaultPaymentMethod()->asStripePaymentMethod()->card->brand) }} ending in
                        {{ tenant()->defaultPaymentMethod()->asStripePaymentMethod()->card->last4 }}
                    </p>
                @else
                    <p class="mt-2 text-sm text-gray-600">
                        No payment method set yet. Please add one below.
                    </p>
                @endif
            </div>
            <div class="hidden sm:block">
                <div class="py-4">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>
            <x-form.label for="card-holder-name" value="Card holder name"/>

            <div class="mt-1 relative rounded-md shadow-sm">
                <x-form.input id="card-holder-name" type="text" placeholder="Taylor Otwell"/>
            </div>

            <!-- Stripe Elements Placeholder -->
            <div class="mt-2 relative rounded-md shadow-sm" wire:ignore>
                <div id="card-element" class="form-input py-3 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 placeholder-gray-400 rounded-md shadow-sm mt-1 block w-full"></div>
            </div>
            <p id="payment-method-message" class="text-sm"></p>
        </div>
        <div class="px-4 sm:px-6 py-2 bg-gray-50 flex justify-end">
            <x-button id="card-button" data-secret="{{ $intent->client_secret }}">Update payment method</x-button>
        </div>
    </div>
</div>

@push('body')
<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('{{ config('saas.stripe_key') }}');

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    function paymentMethodMessage(message, success) {
        document.getElementById('payment-method-message').innerHTML = message;
        document.getElementById('payment-method-message').classList = 'text-sm mt-4 ' + (success ? 'text-green-500' : 'text-red-500');
    }

    cardButton.addEventListener('click', async (e) => {
        const { setupIntent, error } = await stripe.confirmCardSetup(
        clientSecret, {
            payment_method: {
                card: cardElement,
                billing_details: { name: cardHolderName.value }
            }
        }
        );

        if (error) {
            paymentMethodMessage(error.message, false);
        } else {
            @this.set('paymentMethod', setupIntent.payment_method);
            @this.call('save');

            paymentMethodMessage('Payment method updated successfuly.', true);
        }
    });
</script>
@endpush
