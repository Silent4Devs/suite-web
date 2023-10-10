<section class="my-4">
    <h1 class="font-bold text-3xl text-gray-800 mb-2">Valoración</h1>

    @if($enrolled)
        <article>
            @if(!$review)
                <textarea wire:model="comment" class="form-control w-full" rows="3" placeholder="Ingrese una reseña del curso"></textarea>

                <div class="d-flex mt-4 mb-4">
                    <button class="btn btn-primary mr-4 " wire:click="store">Guardar</button>

                    <ul style="list-style: none;" class="d-flex pt-2">
                        <li class="mr-1 cursor-pointer" wire:click="$set('rating', 1)">
                            <i
                                class="fas fa-star" style="color: {{$rating >= 1 ? '#E3A008' : 'gray' }}; font-size: 18px;">
                            </i>
                        </li>
                        <li class="mr-1 cursor-pointer" wire:click="$set('rating', 2)">
                            <i
                                class="fas fa-star" style="color: {{$rating >= 2 ? '#E3A008' : 'gray' }}; font-size: 18px;">
                            </i>
                        </li>
                        <li class="mr-1 cursor-pointer" wire:click="$set('rating', 3)">
                            <i
                                class="fas fa-star" style="color: {{$rating >= 3 ? '#E3A008' : 'gray' }}; font-size: 18px;">
                            </i>
                        </li>
                        <li class="mr-1 cursor-pointer" wire:click="$set('rating', 4)">
                            <i
                                class="fas fa-star" style="color: {{$rating >= 4 ? '#E3A008' : 'gray' }}; font-size: 18px;">
                            </i>
                        </li>
                        <li class="mr-1 cursor-pointer" wire:click="$set('rating', 5)">
                            <i
                                class="fas fa-star" style="color: {{$rating >= 5 ? '#E3A008' : 'gray' }}; font-size: 18px;">
                            </i>
                        </li>
                    </ul>
                </div>
            @else
                <div class="py-3 d-flex align-items-center" style="color: #E3A008;" role="alert">
                    {{-- <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="20" height="20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg> --}}
                    <i class="bi bi-check-circle" style="font-size: 2rem;"></i>
                    <h6 class="ml-2 mt-2">Usted ya ha valorado este curso</h6>
                </div>
            @endif
        </article>
    @endif

    <div class="card shadow-sm">
        <div class="card-body" style="border: 1px solid #D8D8D8;">
            <h5 class="text-gray-800 text-xl">{{$course->reviews->count()}} valoraciones</h5>
            @foreach ($course->reviews as $review)
                <div class="mb-2">
                    <div class="mr-4">
                        <img class="h-12 w-12 object-cover rounded-full shadow-lg" src="{{$review->user->profile_photo_url}}" alt="">
                    </div>
                    <div class="card flex-1 shadow-none">
                        <div class="px-4"  style="background-color: #CDD7E1;">
                            <p class="mt-2">
                                <b>
                                    {{$review->user->name}}
                                </b>
                                <i class="fas fa-star" style="color: #E3A008; font-size: 18px;"></i>
                                {{$review->rating}}
                            </p>
                            <p>
                                {{$review->comment}}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
